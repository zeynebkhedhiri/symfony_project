<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SomeController extends AbstractController
{
    #[Route('/some')]
    public function index(): Response
    {
        return $this->render('some/index.html.twig');
    }
    public function someAction(): Response
    {
        $user = $this->getUser(); // Get the current logged-in newUser

        if ($user instanceof App\Entity\User) {
            $role = $user->getRole();
            return new Response("User role: " . $role);
        }

        return new Response("No logged-in newUser.");
    }
}
