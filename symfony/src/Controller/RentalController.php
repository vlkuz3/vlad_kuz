<?php

namespace App\Controller;

use App\Entity\Rental;
use App\Form\RentalTypeForm;
use App\Repository\RentalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RentalController extends AbstractController
{
    #[Route('car/rental', name: 'rental_index')]
    public function index(
        Request $request,
        RentalRepository $rentalRepository,
        PaginatorInterface $paginator
    ): Response {
        $filters = $request->query->all();

        $queryBuilder = $rentalRepository->filter($filters);

        $itemsPerPage = $request->query->getInt('itemsPerPage', 5);
        $page = $request->query->getInt('page', 1);

        $pagination = $paginator->paginate(
            $queryBuilder,
            $page,
            $itemsPerPage
        );

        return $this->render('rental/index.html.twig', [
            'rentals' => $pagination,
            'filters' => $filters,
        ]);
    }

    #[Route('car/rental/new', name: 'rental_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $rental = new Rental();
        $form = $this->createForm(RentalTypeForm::class, $rental);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($rental);
            $em->flush();

            return $this->redirectToRoute('rental_index');
        }

        return $this->render('rental/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('car/rental/{id}/edit', name: 'rental_edit')]
    public function edit(Request $request, Rental $rental, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(RentalTypeForm::class, $rental);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('rental_index');
        }

        return $this->render('rental/edit.html.twig', [
            'form' => $form->createView(),
            'rental' => $rental,
        ]);
    }

    #[Route('car/rental/{id}/delete', name: 'rental_delete')]
    public function delete(Rental $rental, EntityManagerInterface $em): Response
    {
        $em->remove($rental);
        $em->flush();

        return $this->redirectToRoute('rental_index');
    }
}
