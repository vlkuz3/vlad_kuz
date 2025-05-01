<?php

namespace App\Controller;

use App\Entity\Payment;
use App\Form\PaymentTypeForm;
use App\Repository\PaymentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PaymentController extends AbstractController
{
    #[Route('car/payment', name: 'payment_index')]
    public function index(
        Request $request,
        PaymentRepository $paymentRepository,
        PaginatorInterface $paginator
    ): Response {
        $filters = $request->query->all();

        $queryBuilder = $paymentRepository->filter($filters);

        $itemsPerPage = $request->query->getInt('itemsPerPage', 5);
        $page = $request->query->getInt('page', 1);

        $pagination = $paginator->paginate(
            $queryBuilder,
            $page,
            $itemsPerPage
        );

        return $this->render('payment/index.html.twig', [
            'payments' => $pagination,
            'filters' => $filters,
        ]);
    }

    #[Route('car/payment/new', name: 'payment_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $payment = new Payment();
        $form = $this->createForm(PaymentTypeForm::class, $payment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($payment);
            $em->flush();

            return $this->redirectToRoute('payment_index');
        }

        return $this->render('payment/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('car/payment/{id}/edit', name: 'payment_edit')]
    public function edit(Request $request, Payment $payment, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PaymentTypeForm::class, $payment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('payment_index');
        }

        return $this->render('payment/edit.html.twig', [
            'form' => $form->createView(),
            'payment' => $payment,
        ]);
    }

    #[Route('car/payment/{id}/delete', name: 'payment_delete')]
    public function delete(Payment $payment, EntityManagerInterface $em): Response
    {
        $em->remove($payment);
        $em->flush();

        return $this->redirectToRoute('payment_index');
    }
}
