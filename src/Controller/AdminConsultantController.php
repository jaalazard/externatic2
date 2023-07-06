<?php

namespace App\Controller;

use App\Entity\JobOffer;
use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/consultant', name: 'admin_consultant_')]
class AdminConsultantController extends AbstractController
{
    #[Route('/{id}', name: 'index', methods: ['GET'])]
    public function index(?JobOffer $jobOffer = null, JobOfferRepository $jobOfferRepository): Response
    {
        return $this->render('admin_consultant/index.html.twig', [
            'jobOffers' => $jobOfferRepository->findAll(),
            'jobOffer' => $jobOffer,
        ]);
    }
}
