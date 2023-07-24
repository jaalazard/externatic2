<?php

namespace App\Controller;

use App\Entity\JobOffer;
use App\Entity\Candidate;
use App\Form\SearchJobType;
use App\Entity\JobOfferSearch;
use App\Repository\JobOfferRepository;
use App\Repository\PostulationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/consultant', name: 'admin_consultant_')]
class AdminConsultantController extends AbstractController
{
    #[Route('/{jobOffer}', name: 'index', methods: ['GET'])]
    public function index(JobOfferRepository $jobOfferRepository, Request $request, JobOffer $jobOffer = null): Response
    {
        $jobOfferSearch = new JobOfferSearch();
        $form = $this->createForm(SearchJobType::class, $jobOfferSearch);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $jobOffers = $jobOfferRepository->findLikeName($jobOfferSearch);
        } else {
            $jobOffers = $jobOfferRepository->findAll();
        }

        return $this->render('admin_consultant/index.html.twig', [
            'jobOffers' => $jobOffers,
            'jobOffer' => $jobOffer,
            'form' => $form,
        ]);
    }

    #[Route('/{jobOffer}/candidats/{candidate}', name: 'show', methods: ['GET'])]
    public function showCandidate(JobOffer $jobOffer, Candidate $candidate = null): Response
    {
        return $this->render('admin_consultant/show.html.twig', [
            'candidate' => $candidate,
            'jobOffer' => $jobOffer,
            'postulations' => $jobOffer->getPostulations()
        ]);
    }
}
