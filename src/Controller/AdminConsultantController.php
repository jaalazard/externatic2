<?php

namespace App\Controller;

use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminConsultantController extends AbstractController
{
    #[Route('/admin/consultant', name: 'admin_consultant')]
    public function index(JobOfferRepository $jobOfferRepository): Response
    {
        return $this->render('admin_consultant/index.html.twig', [
            'jobOffers' => $jobOfferRepository->findAll(),
        ]);
    }
}
