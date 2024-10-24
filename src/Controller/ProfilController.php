<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security as SecurityBundleSecurity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfilController extends AbstractController
{

    #[Route('/profil', name: 'app_profil')]
    public function index(SecurityBundleSecurity $security): Response
    {
        $user = $security->getUser();

        return $this->render('profil/index.html.twig', [
            'user' => $user,
        ]);
    }
}
