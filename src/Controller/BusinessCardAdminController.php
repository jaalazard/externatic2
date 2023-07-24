<?php

namespace App\Controller;

use App\Entity\BusinessCard;
use App\Form\BusinessCardType;
use App\Repository\BusinessRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/business/card/admin')]
class BusinessCardAdminController extends AbstractController
{
    #[Route('/', name: 'app_business_card_admin_index', methods: ['GET'])]
    public function index(BusinessRepository $businessRepository): Response
    {
        return $this->render('business_card_admin/index.html.twig', [
            'business_cards' => $businessRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_business_card_admin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BusinessRepository $businessRepository): Response
    {
        $businessCard = new BusinessCard();
        $form = $this->createForm(BusinessCardType::class, $businessCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $businessRepository->save($businessCard, true);

            return $this->redirectToRoute('app_business_card_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('business_card_admin/new.html.twig', [
            'business_card' => $businessCard,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_business_card_admin_show', methods: ['GET'])]
    public function show(BusinessCard $businessCard): Response
    {
        return $this->render('business_card_admin/show.html.twig', [
            'business_card' => $businessCard,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_business_card_admin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BusinessCard $businessCard, BusinessRepository $businessRepository): Response
    {
        $form = $this->createForm(BusinessCardType::class, $businessCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $businessRepository->save($businessCard, true);

            return $this->redirectToRoute('app_business_card_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('business_card_admin/edit.html.twig', [
            'business_card' => $businessCard,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_business_card_admin_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        BusinessCard $businessCard,
        BusinessRepository $businessRepository
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $businessCard->getId(), $request->request->get('_token'))) {
            $businessRepository->remove($businessCard, true);
        }

        return $this->redirectToRoute('app_business_card_admin_index', [], Response::HTTP_SEE_OTHER);
    }
}
