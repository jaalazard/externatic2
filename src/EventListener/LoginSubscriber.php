<?php

// src/EventListener/LoginSubscriber.php
namespace App\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginSubscriber extends AbstractController implements EventSubscriberInterface
{
    public function __construct(
        private UrlGeneratorInterface $urlGenerator
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [LoginSuccessEvent::class => 'onLogin'];
    }

    public function onLogin(LoginSuccessEvent $event): void
    {

        // get the current response, if it is already set by another listener
        $response = $event->getResponse();

        /** @var \App\Entity\User */
        $user = $this->getUser();
        $this->addFlash('success', 'Bienvenue ! Vous êtes connecté(e) à Externatic');

        if ($user->getCandidate() !== null) {
            $response = new RedirectResponse(
                $this->urlGenerator->generate('app_home'),
                RedirectResponse::HTTP_SEE_OTHER
            );
        } elseif ($this->isGranted('ROLE_ADMIN', $user) == true) {
            $response = new RedirectResponse(
                $this->urlGenerator->generate('accueil_admin'),
                RedirectResponse::HTTP_SEE_OTHER
            );
            $event->setResponse($response);
        }
    }
}
