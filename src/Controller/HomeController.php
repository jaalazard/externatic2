<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Consultant;
use App\Repository\ConsultantRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ConsultantRepository $consultantRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'consultants' => $consultantRepository->findBy([], [
                'firstname' => 'ASC',
            ]),
        ]);
    }

    #[Route('/mentionslegales', name: 'mentionslegales')]
    public function mentionsLegales(): Response
    {
        return $this->render('mentionsLegales.html.twig');
    }
}
