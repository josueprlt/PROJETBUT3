<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LegalsmentionsController extends AbstractController
{
    #[Route('/legalsmentions', name: 'app_legalsmentions')]
    public function index(): Response
    {
        return $this->render('legalsmentions/index.html.twig', [
            'controller_name' => 'LegalsmentionsController',
        ]);
    }
}
