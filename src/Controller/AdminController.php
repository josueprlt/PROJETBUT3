<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityManagerInterface;

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
    public function userModification(User $user, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Créez le formulaire
        $form = $this->createFormBuilder($user)
            ->add(
                'firstname', TextType::class,
                [
                    'required' => true,
                    'label' => 'Prénom',
                    'attr' => [
                        'placeholder' => 'Prénom'
                    ]
                ]
            )
            ->add(
                'name', TextType::class,
                [
                    'required' => true,
                    'label' => 'Nom',
                    'attr' => [
                        'placeholder' => 'Nom'
                    ]
                ]
            )
            ->add('password', PasswordType::class, [
                'hash_property_path' => 'password',
                'mapped' => false,
                'empty_data' => '',
                'required' => false
            ])
            ->add(
                'email', TextType::class,
                [
                    'required' => true,
                    'label' => 'Email',
                    'attr' => [
                        'placeholder' => 'Email'
                    ]
                ]
            )
            ->add('actif', CheckboxType::class, [
                'label'    => 'Actif',
                'required' => false,
            ])
            ->add('roles', ChoiceType::class, [
                'choices'  => [
                    'Utilisateur' => 'ROLE_USER',
                    'Organisateur' => 'ROLE_ORGANISATEUR',
                    'Admin' => 'ROLE_ADMIN',
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('valider', SubmitType::class, [
                'label' => 'Valider',
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/user/index.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
            'controller_name' => 'AdminController',
        ]);
    }
}
