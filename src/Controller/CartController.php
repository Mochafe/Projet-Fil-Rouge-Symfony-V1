<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Product;
use App\Entity\CartDetail;
use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use App\Repository\CartDetailRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

#[Route('/cart', name: 'cart')]
class CartController extends AbstractController
{
    #[Route('/view', name: 'View')]
    public function view(): Response
    {
        if(!$this->getUser()) {
            $this->addFlash("error", "Vous n'êtes pas connecté");
            return $this->redirectToRoute("login");
        }
        return $this->render('cart/view.html.twig');
    }

    #[Route('/delete', name: 'Delete')]
    public function delete(Request $request, CartDetailRepository $cartDetailRepository): Response
    {
        $user = $this->getUser();

        if(!$user) {
            $this->addFlash("error", "Vous n'êtes pas connecté");
            return $this->redirectToRoute("login");
        }

        $cartDetailId = intval($request->request->get("cartDetail"));

        if(!$cartDetailId) {
            $this->addFlash("error", "Une erreur est survenu");
            return $this->redirectToRoute("cartView");
        } 

        $cartDetail = belongToUser($user, $cartDetailId);

        if(!$cartDetail) {
            $this->addFlash("error", "Une erreur est survenu");
            return $this->redirectToRoute("cartView");
        }

        $cartDetailRepository->remove($cartDetail, true);

        return $this->redirectToRoute("cartView");
    }

    #[Route('/add/{product}', name: 'Add', methods: ["POST"])]
    public function add(Request $request, ProductRepository $productRepository, CartDetailRepository $cartDetailRepository, CartRepository $cartRepository, Product $product): Response
    {
        if (!isset($product)) {
            $this->addFlash("error", "Le produit n'existe pas");
            return $this->redirect($request->headers->get("referer"));
        }

        $user = $this->getUser();

        if (!isset($user)) {
            $this->addFlash("warning", "Vous n'êtes pas connecté");
            return $this->redirectToRoute("login");
        }

        $quantity = $request->request->get("quantity");


        if (!isset($quantity) || !$quantity > 0) {
            $this->addFlash("error", "Erreur le produit ou la quantité est incorrecte");
            return $this->redirect($request->headers->get("referer"));
        }



        if (!$product->getQuantity() > 0) {
            $this->addFlash("error", "Le produit n'est plus disponible");
            return $this->redirectToRoute("productView", ["product" => $product->getId()]);
        }

        $cart = $user->getCart();

        $cartDetail = productExist($cart, $product);

        if (isset($cartDetail)) {
            $cartDetail->setQuantity($cartDetail->getQuantity() + $quantity);

            $cartDetailRepository->save($cartDetail, true);
        } else {
            $cartDetail = new CartDetail();

            $cart->addCartDetail($cartDetail);
            $cartRepository->save($cart);

            $cartDetail->setProduct($product);
            $cartDetail->setQuantity($quantity);

            $cartDetailRepository->save($cartDetail, true);
        }


        $this->addFlash("success", "Produit ajouté");
        return $this->redirectToRoute("productView", ["product" => $product->getId()]);
    }
}

function productExist(Cart $cart, Product $product): CartDetail | null
{
    foreach ($cart->getCartDetails() as $cd) {
        if ($cd->getProduct()->getId() === $product->getId()) {
            return $cd;
        }
    }

    return null;
}

function belongToUser(UserInterface $user, $id): CartDetail | null {
    foreach($user->getCart()->getCartDetails() as $cartDetail) {
        if($cartDetail->getId() === $id) return $cartDetail;
    }

    return null;
}
