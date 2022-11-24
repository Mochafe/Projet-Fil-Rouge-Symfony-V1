<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user', name: 'user')]
class UserController extends AbstractController
{
    #[Route('/profil', name: 'Profile')]
    public function profile(): Response
    {
        return $this->render('user/profile.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }


    #[Route('/profil/update', name: 'ProfileUpdate', methods: ['GET'])]
    public function updateForm(): Response
    {
        return $this->render('user/profileForm.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
