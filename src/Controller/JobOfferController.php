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
use Doctrine\ORM\EntityManagerInterface;
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
        PostulationRepository $postulationRepository,
        CandidateRepository $candidateRepository,
    ): Response {
        $jobOffer = $jobOfferRepository->find($id);
        $businessCard = $businessRepository->find($id);
        $postulation = $postulationRepository->find($id);
        $candidate = $candidateRepository->find($id);
        return $this->render('/jobOffer/show.html.twig', [
            'jobOffer' => $jobOffer,
            'businessCard' => $businessCard,
            'postulation' => $postulation,
            'candidate' => $candidate,
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
        PostulationRepository $postulationRepository,
    ): Response {
        /** @var User */
        $user = $this->getUser();
        $candidate = $user->getCandidate();

        $jobOffer = $jobOfferRepository->find($id);

        $postulation = $postulationRepository->findOneByCandidateAndJoboffer($candidate, $jobOffer);

        if ($this->isCsrfTokenValid('apply' . $jobOffer->getId(), $request->request->get('_token'))) {
            if ($postulation == null) {
                $postulation = new Postulation();
                $postulation->setCandidate($candidate);
                $postulation->setJobOffer($jobOffer);
                $postulationRepository->save($postulation);
                $candidate->addPostulation($postulation);
                $candidateRepository->save($candidate, true);
                $jobOffer->addCandidate($candidate);
                $jobOfferRepository->save($jobOffer);
            } elseif($postulation !== null) {
                $postulationRepository->remove($postulation);
                $candidate->removePostulation($postulation);
                $candidateRepository->save($candidate, true);
                $jobOffer->removeCandidate($candidate);
                $jobOfferRepository->save($jobOffer);
            }
        }
        return $this->redirectToRoute('jobOffer_index', ['jobOffer' => $jobOffer, 'postulation' => $postulation], Response::HTTP_SEE_OTHER);
    }
}
