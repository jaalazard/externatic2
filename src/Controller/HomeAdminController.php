<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin')]
class HomeAdminController extends AbstractController
{
    #[Route('/', name: 'accueil_admin')]
    public function index(): Response
    {
        return $this->render('/components/admin/home.html.twig');
    }
}
