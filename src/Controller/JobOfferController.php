<?php

namespace App\Controller;

use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/jobOffer', name: 'jobOffer_')]
class JobOfferController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(JobOfferRepository $jobOfferRepository): Response
    {
        return $this->render('jobOffer/index.html.twig', [
            'jobOffers' => $jobOfferRepository->findAll(),
        ]);
    }
}
