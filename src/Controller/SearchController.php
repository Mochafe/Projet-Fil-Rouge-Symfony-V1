<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function search(Request $request, ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        $productResponse = array();

        //dd(strtolower($request->query->get("search")));


        foreach($products as $index => $product) {
            if(count($productResponse) >= 5) break;
            if(strpos(strtolower($product->getName()), strtolower($request->query->get("search"))) !== false) {             
                $productResponse[] = [
                    "id" => $product->getId(),
                    "name" => $product->getName()
                ];
            }
        }

        return new Response(\json_encode($productResponse));
    }
}
