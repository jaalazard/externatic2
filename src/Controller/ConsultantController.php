<?php

namespace App\Controller;

use App\Entity\Consultant;
use App\Form\ConsultantType;
use App\Repository\ConsultantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/consultants')]
class ConsultantsController extends AbstractController
{
    #[Route('/', name: 'app_consultants_index', methods: ['GET'])]
    public function index(ConsultantRepository $consultantRepository): Response
    {
        return $this->render('consultants/index.html.twig', [
            'consultants' => $consultantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_consultants_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ConsultantRepository $consultantRepository): Response
    {
        $consultant = new Consultant();
        $form = $this->createForm(ConsultantType::class, $consultant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $consultantRepository->save($consultant, true);

            return $this->redirectToRoute('app_consultants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('consultants/new.html.twig', [
            'consultant' => $consultant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_consultants_show', methods: ['GET'])]
    public function show(Consultant $consultant): Response
    {
        return $this->render('consultants/show.html.twig', [
            'consultant' => $consultant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_consultants_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Consultant $consultant, ConsultantRepository $consultantRepository): Response
    {
        $form = $this->createForm(ConsultantType::class, $consultant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $consultantRepository->save($consultant, true);

            return $this->redirectToRoute('app_consultants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('consultants/edit.html.twig', [
            'consultant' => $consultant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_consultant_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        Consultant $consultant,
        ConsultantRepository $consultantRepository
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $consultant->getId(), $request->request->get('_token'))) {
            $consultantRepository->remove($consultant, true);
        }

        return $this->redirectToRoute('app_consultant_index', [], Response::HTTP_SEE_OTHER);
    }
}
