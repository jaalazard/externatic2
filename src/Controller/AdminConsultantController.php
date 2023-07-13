<?php

namespace App\Controller;

use App\Entity\JobOffer;
use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin/consultant', name: 'admin_consultant_')]
class AdminConsultantController extends AbstractController
{
    #[Route('/{jobOffer}', name: 'index', methods: ['GET'])]
    public function index(JobOfferRepository $jobOfferRepository, JobOffer $jobOffer = null): Response
    {
        return $this->render('admin_consultant/index.html.twig', [
            'jobOffers' => $jobOfferRepository->findAll(),
            'jobOffer' => $jobOffer,
        ]);
    }
}
