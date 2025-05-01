<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerTypeForm;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Knp\Component\Pager\PaginatorInterface;

final class CustomerController extends AbstractController
{
    #[Route('car/customer', name: 'customer_index')]
    public function index(
        Request $request,
        CustomerRepository $customerRepository,
        PaginatorInterface $paginator
    ): Response {
        $filters = $request->query->all();

        $queryBuilder = $customerRepository->filter($filters);

        $itemsPerPage = $request->query->getInt('itemsPerPage', 5);
        $page = $request->query->getInt('page', 1);

        $pagination = $paginator->paginate(
            $queryBuilder,
            $page,
            $itemsPerPage
        );

        return $this->render('customer/index.html.twig', [
            'customers' => $pagination,
            'filters' => $filters,
        ]);
    }

    #[Route('car/customer/new', name: 'customer_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerTypeForm::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($customer);
            $em->flush();

            return $this->redirectToRoute('customer_index');
        }

        return $this->render('customer/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('car/customer/{id}/edit', name: 'customer_edit')]
    public function edit(Request $request, Customer $customer, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CustomerTypeForm::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('customer_index');
        }

        return $this->render('customer/edit.html.twig', [
            'form' => $form->createView(),
            'customer' => $customer,
        ]);
    }

    #[Route('car/customer/{id}/delete', name: 'customer_delete')]
    public function delete(Customer $customer, EntityManagerInterface $em): Response
    {
        $em->remove($customer);
        $em->flush();

        return $this->redirectToRoute('customer_index');
    }
}
