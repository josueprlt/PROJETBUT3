<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\User; // Pour manipuler des objets "User"
use Symfony\Component\HttpFoundation\Request; // Permet d'accéder aux données postées
use Doctrine\ORM\EntityManagerInterface; // Permet d'enregistrer les objets dans la base de données
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface; // Pour hacher les mots de passe

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(UserRepository $usrRepo): Response
    {
        $users = $usrRepo->findAll();

        return $this->render('admin/index.html.twig', [
            'users' => $users,
            'controller_name' => 'AdminController',
        ]);
    }


    #[Route('/admin/user/saisie/{id}', name: 'app_admin_modification')]
    public function userModification(User $user): Response
    {
        return $this->render('admin/user/index.html.twig', [
            'user' => $user,
            'controller_name' => 'AdminController',
        ]);
    }
}
