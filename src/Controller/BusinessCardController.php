<?php

namespace App\Controller;

use App\Repository\BusinessCardCategoryRepository;
use App\Repository\BusinessRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/business/card', name: 'business-card')]
class BusinessCardController extends AbstractController
{
    #[Route('/', name: '_index', methods: ['GET'])]
    public function index(BusinessCardCategoryRepository $businessCategory): Response
    {
        return $this->render('business-card/index.html.twig', [
            'categories' => $businessCategory->findBy([], [
                'name' => 'ASC',
            ]),
        ]);
    }
}
