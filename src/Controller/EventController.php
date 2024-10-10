<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

use App\Form\RegistrationFormType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityManagerInterface;

class EventController extends AbstractController
{
    #[Route('/event', name: 'app_event')]
    public function index(EventRepository $eventRepo): Response
    {
        $events = $eventRepo->findAll();

        return $this->render('event/index.html.twig', [
            'events' => $events,
            'controller_name' => 'EventController',
        ]);
    }

    #[Route('/event/add', name: 'app_event_add')]
    public function addEvent(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $form = $this->createForm(RegistrationFormType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('app_event');
        }

        return $this->render('event/index.html.addevent.twig', [
            'addEventForm' => $form,
        ]);
    }

    #[Route('/event/saisie/{id}', name: 'app_event_modification')]
    public function userModification(Event $event, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Créez le formulaire
        $form = $this->createFormBuilder($event)
            ->add('datetimeStart', DateTimeType::class, [
                'date_label' => 'Start On',
            ])
            ->add('datetimeEnd', DateTimeType::class, [
                'date_label' => 'End On',
            ])
            ->add(
                'titre', TextType::class,
                [
                    'required' => true,
                    'label' => 'Titre',
                    'attr' => [
                        'placeholder' => 'Titre'
                    ]
                ]
            )
            ->add(
                'description', TextType::class,
                [
                    'required' => true,
                    'label' => 'Description',
                    'attr' => [
                        'placeholder' => 'Description'
                    ]
                ]
            )
            ->add('visibility', CheckboxType::class, [
                'label'    => 'Visibilité',
                'required' => false,
            ])
            ->add('valider', SubmitType::class, [
                'label' => 'Valider',
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('app_event');
        }

        return $this->render('event/index.html.modifevent.twig', [
            'form' => $form->createView(),
            'event' => $event,
            'controller_name' => 'EventController',
        ]);
    }
}
