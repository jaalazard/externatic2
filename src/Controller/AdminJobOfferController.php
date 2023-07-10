<?php

namespace App\Controller;

use App\Entity\JobOffer;
use App\Form\JobOfferType;
use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Locator;

#[Route('/admin/offres', name: 'admin_jobOffer_')]
class AdminJobOfferController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(JobOfferRepository $jobOfferRepository): Response
    {
        return $this->render('admin_jobOffer/index.html.twig', [
            'jobOffers' => $jobOfferRepository->findBy([], ['createdAt' => 'DESC']),
        ]);
    }

    #[Route('/nouveau', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, JobOfferRepository $jobOfferRepository, Locator $locator): Response
    {
        $jobOffer = new JobOffer();
        $form = $this->createForm(JobOfferType::class, $jobOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $coordinates = $locator->getCoordinates($jobOffer);
            $jobOffer->setLongitude($coordinates[0]);
            $jobOffer->setLatitude($coordinates[1]);
            $jobOfferRepository->save($jobOffer, true);

            return $this->redirectToRoute('admin_jobOffer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_jobOffer/new.html.twig', [
            'jobOffer' => $jobOffer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(JobOffer $jobOffer): Response
    {
        return $this->render('admin_jobOffer/show.html.twig', [
            'jobOffer' => $jobOffer,
        ]);
    }

    #[Route('/{id}/editer', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Locator $locator,
        JobOffer $jobOffer,
        JobOfferRepository $jobOfferRepository
    ): Response {
        $form = $this->createForm(JobOfferType::class, $jobOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $coordinates = $locator->getCoordinates($jobOffer);
            $jobOffer->setLongitude($coordinates[0]);
            $jobOffer->setLatitude($coordinates[1]);
            $jobOfferRepository->save($jobOffer, true);

            return $this->redirectToRoute('admin_jobOffer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_jobOffer/edit.html.twig', [
            'jobOffer' => $jobOffer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, JobOffer $jobOffer, JobOfferRepository $jobOfferRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $jobOffer->getId(), $request->request->get('_token'))) {
            $jobOfferRepository->remove($jobOffer, true);
        }

        return $this->redirectToRoute('admin_jobOffer_index', [], Response::HTTP_SEE_OTHER);
    }
}
