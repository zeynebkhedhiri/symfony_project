<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class newUser extends abstractController
{
    /**
     * @Route("/newuser/create", name="newuser_create")
     */
    public function create(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        // Create a new NewUser object
        $newUser = new NewUser();

        // Create the form and handle the request
        $form = $this->createForm(NewUserType::class, $newUser);
        $form->handleRequest($request);

        // If the form is submitted and valid, persist the newUser data
        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the password (ensure you're using your password encoder service)
            $encodedPassword = $passwordEncoder->encodePassword($newUser, $newUser->getPassword());
            $newUser->setPassword($encodedPassword);

            // Persist the NewUser to the database
            $em->persist($newUser);
            $em->flush();

            // Redirect to the newUser list page or show a success message
            $this->addFlash('success', 'New newUser created successfully!');
            return $this->redirectToRoute('newuser_list');
        }

        // Render the form
        return $this->render('newUser/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/newuser/list", name="newuser_list")
     */
    public function list(EntityManagerInterface $em): Response
    {
        // Get all NewUsers from the database
        $newUsers = $em->getRepository(NewUser::class)->findAll();

        return $this->render('newuser/list.html.twig', [
            'newUsers' => $newUsers,
        ]);
    }

    /**
     * @Route("/newuser/{id}", name="newuser_show")
     */
    public function show(NewUser $newUser): Response
    {
        // Show a specific NewUser
        return $this->render('newuser/show.html.twig', [
            'newUser' => $newUser,
        ]);
    }
}