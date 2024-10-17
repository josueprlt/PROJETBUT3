<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

use App\Form\AddEventFormType;
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

        return $this->render('gestion/index.html.twig', [
            'events' => $events,
            'controller_name' => 'EventController',
        ]);
    }

    #[Route('/event/add', name: 'app_event_add')]
    public function addEvent(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $form = $this->createForm(AddEventFormType::class, $event);
        $form->handleRequest($request);
        $error = "";

        if ($form->isSubmitted() && $form->isValid()) {
            
            if ($event->getDatetimeStart() >= $event->getDatetimeEnd()) {
                $error = "la date de début ne peut pas être supérieur à la date de fin !";
            } else {
                $entityManager->persist($event);
                $entityManager->flush();
    
                return $this->redirectToRoute('app_event');
            }
        }

        return $this->render('event/index.html.addevent.twig', [
            'error' => $error,
            'addEventForm' => $form,
        ]);
    }

    #[Route('/event/saisie/{id}', name: 'app_event_modification')]
    public function userModification(Event $event, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Créez le formulaire
        $form = $this->createForm(AddEventFormType::class, $event);
        $form->handleRequest($request);
        $error = "";

        if ($form->isSubmitted() && $form->isValid()) {
            
            if ($event->getDatetimeStart() >= $event->getDatetimeEnd()) {
                $error = "la date de début ne peut pas être supérieur à la date de fin !";
            } else {
                $entityManager->persist($event);
                $entityManager->flush();
    
                return $this->redirectToRoute('app_event');
            }
        }

        return $this->render('event/index.html.modifevent.twig', [
            'error' => $error,
            'form' => $form->createView(),
            'event' => $event,
            'controller_name' => 'EventController',
        ]);
    }
}
