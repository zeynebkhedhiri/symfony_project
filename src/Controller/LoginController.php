<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login/index', name: 'app_login_index')]
    public function index(): Response
    {
        return $this->render('security/login.html.twig');
    }

    #[Route('/login', name: 'app_login_login', methods: ['POST'])]
    public function login(Request $request, newUserRepository $userRepository, $jwt): JsonResponse
    {
        try {
            $data = $request->toArray();

            $email = $data['email'] ?? '';
            $password = $data['password'] ?? '';

            if (empty($email) || empty($password)) {
                return new JsonResponse(['error' => 'Email or password is missing.'], Response::HTTP_BAD_REQUEST);
            }

            $user = $userRepository->findByEmail($email);

            if (!$user || $user->getPassword() !== $password) {
                return new JsonResponse(['error' => 'Invalid credentials.'], Response::HTTP_UNAUTHORIZED);
            }

            $role = $user->getRoles();

            // Redirect logic based on the role
            $redirectUrl = match ($role) {
                'ROLE_ADMIN' => $this->generateUrl('app_admin_dashboard'),
                'ROLE_USER' => $this->generateUrl('app_user_dashboard'),
                default => $this->generateUrl('app_home'),
            };

            return new JsonResponse([
                'token' => $jwt,
                'redirect' => $redirectUrl,
            ]);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Invalid request format.'], Response::HTTP_BAD_REQUEST);
        }
    }





}
