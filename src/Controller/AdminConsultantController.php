<?php

namespace App\Controller;

use App\Entity\JobOffer;
use App\Form\ConsultantSearchJobType;
use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/consultant', name: 'admin_consultant_')]
class AdminConsultantController extends AbstractController
{
    #[Route('/{jobOffer}', name: 'index', methods: ['GET'])]
    public function index(JobOfferRepository $jobOfferRepository, Request $request, JobOffer $jobOffer = null): Response
    {
        $jobOffers = $jobOfferRepository->findAll();
        $form = $this->createForm(ConsultantSearchJobType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'] ?? '';
            $towns = $form->getData()['towns'] ?? '';
            $jobOffers = $jobOfferRepository->findLikeName($search, $towns);
        } else {
            $jobOffers = $jobOfferRepository->findAll();
        }

        return $this->render('admin_consultant/index.html.twig', [
            'jobOffers' => $jobOffers,
            'jobOffer' => $jobOffer,
            'form' => $form,
        ]);
    }
}
