<?php

namespace App\Controller;

use Exception;
use App\Entity\JobOffer;
use App\Service\Locator;
use App\Form\JobOfferType;
use App\Entity\Postulation;
use App\Repository\JobOfferRepository;
use App\Repository\PostulationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/postulation', name: 'admin_postulation_')]
class PostulationController extends AbstractController
{
    #[Route('/{id}/valider', name: 'validate', methods: ['GET', 'POST'])]
    public function validatePostulation(
        Postulation $postulation,
        PostulationRepository $postulationRepo
    ): Response {
        $postulation->setIsValidate(true);
        $postulationRepo->save($postulation, true);

        $this->addFlash('success', 'Vous avez validé la cadidature de ce candidat.');
        return $this->redirectToRoute('admin_consultant_index', ['id' => $postulation->getJobOffer()->getId()]);
    }

    #[Route('/{id}/rejeter', name: 'reject', methods: ['GET', 'POST'])]
    public function rejectPostulation(Postulation $postulation, PostulationRepository $postulationRepo): Response
    {
        $postulation->setIsValidate(false);
        $postulationRepo->save($postulation, true);

        $this->addFlash('info', 'Vous avez décliné la candidature de ce candidat.');
        return $this->redirectToRoute('admin_consultant_index', ['id' => $postulation->getJobOffer()->getId()]);
    }
}
