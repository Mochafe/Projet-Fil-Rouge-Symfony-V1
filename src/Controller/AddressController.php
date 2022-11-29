<?php

namespace App\Controller;

use App\Entity\Address;
use App\Repository\AddressRepository;
use Nette\Utils\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/address', name: 'address')]
class AddressController extends AbstractController
{
    #[Route('/add', name: 'Add', methods: ["POST"])]
    public function add(Request $request, AddressRepository $addressRepository): Response
    {
        $user = $this->getUser();

        if(!$user) {
            return new Response('', 401);
        }

        $json = json_decode($request->getContent(), true);

        $number = trim($json["number"]);
        $street = trim($json["street"]);
        $zipcode = trim($json["zipcode"]);
        $city = trim($json["city"]);
        $country = trim($json["country"]);


        if($number == "" || $street == "" || $zipcode == "" || $city == "" || $country == "") {
            return new Response("", 206);
        }

        $address = new Address();

        $address->setNumber($number);
        $address->setStreet($street);
        $address->setZipcode($zipcode);
        $address->setCity($city);
        $address->setCountry($country);
        $address->setUser($user);
        $address->setUpdatedAt(new DateTime());

        $addressRepository->save($address, true);

        return new Response('', 202);
    }
    #[Route('/delete/{address}', name: 'Delete')]
    public function delete($address, AddressRepository $addressRepository): Response
    {
        $user = $this->getUser();

        if(!$user) {
            $this->addFlash("error", "Vous n'êtes pas connecté");
            $this->redirectToRoute("login");
        }

        $address = $user->getAddresses()[$address];

        if(!$address) {
            $this->addFlash("error", "Une erreur est survenue");
            $this->redirectToRoute("userProfileUpdateForm");
        }

        $addressRepository->remove($address, true);

       return $this->redirectToRoute("userProfileUpdateForm");
    }

}
