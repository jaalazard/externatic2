<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoriteController extends AbstractController
{
    #[Route('/favoris', name: 'app_favorite')]
    public function index(): Response
    {
        return $this->render('favourite/index.html.twig');
    }
}
