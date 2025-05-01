<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\CarCategory;
use App\Form\CarTypeForm;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CarController extends AbstractController
{
    #[Route('/car', name: 'car_index')]
    public function index(Request $request, CarRepository $carRepository, EntityManagerInterface $em, PaginatorInterface $paginator): Response
    {
        $filters = $request->query->all();
        $queryBuilder = $carRepository->filter($filters);
        $itemsPerPage = $request->query->getInt('itemsPerPage', 5);
        $page = $request->query->getInt('page', 1);

        $pagination = $paginator->paginate(
            $queryBuilder,
            $page,
            $itemsPerPage
        );

        $carCategories = $em->getRepository(CarCategory::class)->findAll();

        return $this->render('car/index.html.twig', [
            'cars' => $pagination,
            'filters' => $filters,
            'carCategories' => $carCategories,
        ]);
    }

    #[Route('/car/new', name: 'car_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $car = new Car();
        $form = $this->createForm(CarTypeForm::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($car);
            $em->flush();

            return $this->redirectToRoute('car_index');
        }

        return $this->render('car/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/car/{id}/edit', name: 'car_edit')]
    public function edit(Request $request, Car $car, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CarTypeForm::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('car_index');
        }

        return $this->render('car/edit.html.twig', [
            'form' => $form->createView(),
            'car' => $car,
        ]);
    }

    #[Route('/car/{id}/delete', name: 'car_delete')]
    public function delete(Car $car, EntityManagerInterface $em): Response
    {
        $em->remove($car);
        $em->flush();

        return $this->redirectToRoute('car_index');
    }
}
