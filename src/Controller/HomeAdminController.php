<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class HomeAdminController extends AbstractController
{
    #[Route('/', name: 'accueil_admin')]
    public function index(): Response
    {
        return $this->render('/components/admin/home.html.twig');
    }
}
