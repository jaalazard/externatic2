<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_CANDIDATE')]
class CandidateController extends AbstractController
{
    #[Route('candidat/{id}', name: 'app_candidate_show', methods: ['GET'])]
    public function show(Candidate $candidate): Response
    {
        return $this->render('candidate/show.html.twig', [
            'candidate' => $candidate,
        ]);
    }

    #[Route('candidat/{id}/formation', name: 'app_candidate_edit')]
    public function newFormation(
        Request $request,
        FormationRepository $formationRepository,
        Candidate $candidate
    ): Response {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formationRepository->save($formation, true);
            return $this->render(
                'candidate/show.html.twig',
                ['candidate' => $candidate,]
            );
        }
        return $this->render('candidate/edit.html.twig', [
            'form' => $form,
        ]);
    }
}
