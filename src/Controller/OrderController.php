<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Address;
use App\Entity\OrderDetail;
use App\Repository\AddressRepository;
use App\Repository\CartDetailRepository;
use App\Repository\OrderDetailRepository;use App\Repository\OrderRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route('/view', name: 'View')]
    public function view(): Response
    {
        $user = $this->getUser();

        if(!$user) {
            $this->addFlash("error", "Vous n'êtes pas connecté");
            return $this->redirectToRoute("login");
        }

        

        return $this->render("order/orderView.html.twig");
    }

    #[Route('/process', name: 'Process', methods: ["POST"])]
    public function process(Request $request, AddressRepository $addressRepository, OrderRepository $orderRepository, OrderDetailRepository $orderDetailRepository, CartDetailRepository $cartDetailRepository): Response
    {
        $user = $this->getUser();

        if(!$user) {
            $this->addFlash("error", "Vous n'êtes pas connecté");
            return $this->redirectToRoute("login");
        }


        $billingnumber = $request->request->get("billing-number");
        $billingstreet = $request->request->get("billing-street");
        $billingzipcode = $request->request->get("billing-zipcode");
        $billingcity = $request->request->get("billing-city");
        $billingcountry = $request->request->get("billing-country");

        $deliverynumber = $request->request->get("delivery-number");
        $deliverystreet = $request->request->get("delivery-street");
        $deliveryzipcode = $request->request->get("delivery-zipcode");
        $deliverycity = $request->request->get("delivery-city");
        $deliverycountry = $request->request->get("delivery-country");

        $paymentMethod = $request->request->get("payment");
        $cardOwner = $request->request->get("cardOwner");
        $cardNumber= $request->request->get("cardNumber");
        $cardCvv= $request->request->get("cardCvv");
        $cardDate= $request->request->get("cardDate");

        if(!$deliverynumber 
        || !$deliverystreet 
        || !$deliveryzipcode 
        || !$deliverycity
        || !$deliverycountry
        || !$billingnumber 
        || !$billingstreet 
        || !$billingzipcode 
        || !$billingcity
        || !$billingcountry
        || !$paymentMethod
        || !$cardOwner
        || !$cardNumber
        || !$cardCvv
        || !$cardDate
        ) {
            $this->addFlash("error", "Veuillez compléter tous les champs.");
            return $this->redirectToRoute("orderPass");
        }

        $deliveryAddress = new Address();
        $deliveryAddress->setNumber($deliverynumber);
        $deliveryAddress->setStreet($deliverystreet);
        $deliveryAddress->setZipcode($deliveryzipcode);
        $deliveryAddress->setCity($deliverycity);
        $deliveryAddress->setCountry($deliverycountry);
        $addressRepository->save($deliveryAddress);

        $billingAddress = new Address();
        $billingAddress->setNumber($billingnumber);
        $billingAddress->setStreet($billingstreet);
        $billingAddress->setZipcode($billingzipcode);
        $billingAddress->setCity($billingcity);
        $billingAddress->setCountry($billingcountry);
        $addressRepository->save($billingAddress);

        

        



        $order = new Order();
        $order->setUser($user);
        $order->setBillingAddress($billingAddress);
        $order->setDeliveryAddress($deliveryAddress);
        $order->setPaymentMethod([
            $paymentMethod,
            $cardOwner,
            $cardNumber,
            $cardCvv,
            $cardDate
        ]);

        $cartDetails = $user->getCart()->getCartDetails();

        foreach($cartDetails as $cartDetail) {
            $orderDetail = new OrderDetail();
            $orderDetail->setProduct($cartDetail->getProduct());
            $orderDetail->setQuantity($cartDetail->getQuantity());
            $orderDetail->setOrderUser($order);
            $orderDetailRepository->save($orderDetail);
            $cartDetailRepository->remove($cartDetail);
        }

        $orderRepository->save($order, true);

        
        $this->addFlash("success", "Votre commande a était confirmé");
        return $this->redirectToRoute("orderView");
    }
}
