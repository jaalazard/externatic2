<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\JobOffer;
use App\Service\Locator;
use App\Entity\JobOfferSearch;
use App\Entity\Postulation;
use App\Form\SearchJobType;
use App\Service\DistanceCalculator;
use App\Repository\BusinessRepository;
use App\Repository\JobOfferRepository;
use App\Repository\CandidateRepository;
use App\Repository\PostulationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Exception;

#[Route('/offres', name: 'jobOffer_')]
class JobOfferController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(
        Request $request,
        JobOfferRepository $jobOfferRepository,
        Locator $locator,
        DistanceCalculator $distanceCalculator
    ): Response {
        $jobOfferSearch = new JobOfferSearch();
        $form = $this->createForm(SearchJobType::class, $jobOfferSearch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jobOffers = $jobOfferRepository->findLikeName($jobOfferSearch);
            if ($jobOfferSearch->getLocalization()) {
                [$longitude, $latitude] = $locator->getCoordinates($jobOfferSearch);
                $jobOfferSearch->setLongitude($longitude)->setLatitude($latitude);
            }

            try {
                /** @var \App\Entity\User */
                $user = $this->getUser();
                $jobOffers = array_filter(
                    $jobOffers,
                    fn ($jobOffer) => $distanceCalculator->isClose(
                        $jobOfferSearch->getLocalization() ? $jobOfferSearch : $user->getCandidate(),
                        $jobOffer,
                        $jobOfferSearch->getRadius()
                    )
                );
            } catch (Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
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
        PostulationRepository $postulationRepository
    ): Response {
        $jobOffer = $jobOfferRepository->find($id);
        $businessCard = $businessRepository->find($id);
        $postulation = $postulationRepository->find($id);
        return $this->render('/jobOffer/show.html.twig', [
            'jobOffer' => $jobOffer,
            'businessCard' => $businessCard,
            'postulation' => $postulation,
        ]);
    }

    #[IsGranted('ROLE_CANDIDATE')]
    #[Route('/{id}/postuler', name: 'apply', methods: ['POST', 'GET'])]
    public function apply(
        int $id,
        Request $request,
        JobOffer $jobOffer,
        CandidateRepository $candidateRepository,
        JobOfferRepository $jobOfferRepository,
        PostulationRepository $postulationRepository
    ): Response {
        /** @var User */
        $user = $this->getUser();
        $candidate = $user->getCandidate();
        $jobOffer = $jobOfferRepository->find($id);
        $postulations = $candidate->getPostulations();
        $postulation = new Postulation();
        $postulation->setCandidate($candidate);
        $postulation->setJobOffer($jobOffer);
        $postulation->setIsValidate(false);

        $postulationRepository->save($postulation);
        if ($this->isCsrfTokenValid('apply' . $jobOffer->getId(), $request->request->get('_token'))) {
            dd($postulation);
            if (in_array($postulation, $postulations->toArray())) {
                $candidate->removePostulation($postulation);
                $postulationRepository->remove($postulation);
            } else {
                $candidate->addPostulation($postulation);
                $candidate->isPostulated($postulation) == true;
            }
            $candidateRepository->save($candidate, true);
            $postulationRepository->save($postulation, true);


        }
        return $this->redirectToRoute('jobOffer_index', ['jobOffer' => $jobOffer, 'postulation' => $postulation], Response::HTTP_SEE_OTHER);
    }
    
}
