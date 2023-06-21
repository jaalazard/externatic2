<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Consultant;
use App\Repository\CompanyRepository;
use App\Repository\ConsultantRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ConsultantRepository $consultantRepository, CompanyRepository $companyRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'consultants' => $consultantRepository->findBy([], [
                'firstname' => 'ASC']),
            'companies' => $companyRepository->findBy([], [
                'name' => 'ASC'], 10)
        ]);
    }



    #[Route('/mentionslegales', name: 'mentionslegales')]
    public function mentionsLegales(): Response
    {
        return $this->render('mentionsLegales.html.twig');
    }
}
