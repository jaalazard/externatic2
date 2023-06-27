<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Entity\Formation;
use App\Form\CandidateType;
use App\Form\FormationType;
use App\Repository\CandidateRepository;
use App\Repository\FormationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_CANDIDATE')]
class CandidateController extends AbstractController
{
    #[Route('candidat/{id}/edit', name: 'app_candidate_edit_profile', methods: ['GET', 'POST'])]
    public function edit(Request $request, Candidate $candidate, CandidateRepository $candidateRepository): Response
    {
        // Create the form, linked with $candidate

        $form = $this->createForm(CandidateType::class, $candidate);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $candidateRepository->save($candidate, true);
            return $this->redirectToRoute('app_candidate_show', ['id' => $candidate->getId()]);
        }
        // Render the form

        return $this->render('candidate/edit.html.twig', [
            'candidate' => $candidate, 'form' => $form,
        ]);
    }

    #[Route('candidat/{id}', name: 'app_candidate_show', methods: ['GET', 'POST'])]
    public function show(Candidate $candidate): Response
    {

        return $this->render('candidate/show.html.twig', [
            'candidate' => $candidate,
        ]);
    }

    #[Route('candidat/{id}/formation', name: 'app_candidate_edit_formation')]
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
            $candidate->addFormation($formation);
            return $this->render(
                'candidate/show.html.twig',
                ['candidate' => $candidate,]
            );
        }
        return $this->render('formation/edit.html.twig', [
            'form' => $form,
        ]);
    }
}
