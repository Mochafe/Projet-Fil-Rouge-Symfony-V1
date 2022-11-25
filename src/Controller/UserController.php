<?php

namespace App\Controller;

use DateTime;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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


    #[Route('/profil/update', name: 'ProfileUpdateForm', methods: ['GET'])]
    public function updateForm(): Response
    {
        return $this->render('user/profileForm.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/profil/update', name: 'ProfileUpdate', methods: ['POST'])]
    public function update(Request $request, UserRepository $userRepository): Response
    {
        $email = $request->request->get("email");
        $birthDate = $request->request->get("birthDate");
        $firstName = $request->request->get("firstName");
        $lastName = $request->request->get("lastName");
        $phone = $request->request->get("phone");

        //dd($email, $birthDate, $firstName, $lastName, $phone);

        if(!isset($email) || $email == "" || 
        !isset($birthDate) || $birthDate == "" ||
        !isset($firstName) || $firstName == "" ||
        !isset($lastName) || $lastName == "" ||
        !isset($phone) || $phone == "" 
        ) {
            $this->addFlash("error", "Veuillez remplir tous les champs");

            return $this->redirectToRoute("userProfileUpdateForm");
        }

        $birthDate = DateTime::createFromFormat("Y-m-d", $birthDate);

        $user = $this->getUser();

        if(!$user) {
            $this->addFlash("error", "Vous n'êtes pas connecté");

            return $this->redirectToRoute("login");
        }

        $user->setEmail($email);
        $user->setBirthDate($birthDate);
        $user->setfirstName($firstName);
        $user->setLastName($lastName);
        $user->setPhoneNumber($phone);

        $userRepository->save($user, true);

        $this->addFlash("success", "Les modifications ont bien été prises en compte");

        return $this->redirectToRoute("userProfile");
    }
}
