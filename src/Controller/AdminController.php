<?php

namespace App\Controller;

use App\Repository\EventRepository;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'app_admin_dashboard')]
    public function dashboard(
        UserRepository $userRepository,
        EventRepository $eventRepository,
        ReservationRepository $reservationRepository
    ): Response
    {
        // Fetch data from repositories
        $users = $userRepository->findAll();
        $events = $eventRepository->findAll();
        $reservations = $reservationRepository->findAll();

        // Return the admin dashboard view with data
        return $this->render('admin/dashboard.html.twig', [
            'users' => $users,
            'events' => $events,
            'reservations' => $reservations,
        ]);
    }
}
