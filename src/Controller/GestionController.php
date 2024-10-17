<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GestionController extends AbstractController
{
    #[Route('/gestion', name: 'app_gestion')]
    public function index(EventRepository $eventRepo): Response
    {
        $events = $eventRepo->findAll();

        return $this->render('gestion/index.html.twig', [
            'events' => $events,
            'controller_name' => 'GestionController',
        ]);
    }
}
