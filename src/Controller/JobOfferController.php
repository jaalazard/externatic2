<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\JobOffer;
use App\Entity\Candidate;
use App\Repository\CandidateRepository;
use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SearchJobType;
use App\Repository\BusinessCardCategoryRepository;
use App\Repository\BusinessRepository;

#[Route('/offres', name: 'jobOffer_')]
class JobOfferController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(Request $request, JobOfferRepository $jobOfferRepository): Response
    {

        $form = $this->createForm(SearchJobType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'] ?? '';
            $contract = $form->getData()['contract'] ?? '';

            $jobOffers = $jobOfferRepository->findLikeName($search, $contract);
        } else {
            $jobOffers = $jobOfferRepository->findAll();
        }

        return $this->render('jobOffer/index.html.twig', [
            'jobOffers' => $jobOffers,
            'form' => $form,
            'candidate' =>  $this->getUser(),
        ]);
    }

    #[IsGranted('ROLE_CANDIDATE')]
    #[Route('/{id}/favoris', name: 'favorites', methods: ['POST', 'GET'])]
    public function addToFavorites(
        int $id,
        Request $request,
        JobOffer $jobOffer,
        CandidateRepository $candidateRepository,
        JobOfferRepository $jobOfferRepository
    ): Response {
        /** @var User */
        $user = $this->getUser();
        $candidate = $user->getCandidate();
        $jobOffer = $jobOfferRepository->find($id);
        if ($this->isCsrfTokenValid('favorite' . $jobOffer->getId(), $request->request->get('_token'))) {
            if ($candidate->isFavorite($jobOffer)) {
                $candidate->removeFromFavorites($jobOffer);
            } else {
                $candidate->addToFavorites($jobOffer);
            }
            $candidateRepository->save($candidate, true);
        }
        return $this->redirectToRoute('jobOffer_index', ['jobOffer' => $jobOffer], Response::HTTP_SEE_OTHER);
    }

    #[Route('/details-offre/{id}/', name: 'show')]
    public function show(
        int $id,
        JobOfferRepository $jobOfferRepository,
        BusinessRepository $businessRepository,
    ): Response {
        $jobOffer = $jobOfferRepository->find($id);
        $businessCard = $businessRepository->find($id);
        return $this->render('/jobOffer/show.html.twig', [
        'jobOffer' => $jobOffer,
        'businessCard' => $businessCard,
        ]);
    }
}
