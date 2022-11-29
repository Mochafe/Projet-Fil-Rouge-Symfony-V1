<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/order', name: 'order')]
class OrderController extends AbstractController
{
    #[Route('/validate', name: 'Validate')]
    public function validate(): Response
    {
        $user = $this->getUser();

        if(!$user) {
            $this->addFlash("error", "Vous n'êtes pas connecté");
            return $this->redirectToRoute("login");
        }

        $subtotal = 0;

        foreach($user->getCart()->getCartDetails() as $cartDetail) {
            $subtotal += $cartDetail->getQuantity() * $cartDetail->getProduct()->getPrice();
        }

        return $this->render('order/orderValidate.html.twig', [
            "subtotal" => $subtotal
        ]);
    }

    #[Route('/pass', name: 'Pass')]
    public function pass(): Response
    {
        $user = $this->getUser();

        if(!$user) {
            $this->addFlash("error", "Vous n'êtes pas connecté");
            return $this->redirectToRoute("login");
        }

        $subtotal = 0;

        foreach($user->getCart()->getCartDetails() as $cartDetail) {
            $subtotal += $cartDetail->getQuantity() * $cartDetail->getProduct()->getPrice();
        }

        return $this->render('order/orderPass.html.twig', [
            "subtotal" => $subtotal
        ]);
    }
}
