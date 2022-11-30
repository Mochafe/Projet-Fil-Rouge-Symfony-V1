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

        foreach($products as $product) {
            if(strpos($product->getName() ,$request->query->get("search"))) {
                $productBuff = `{
                    "name" => ` . $product->getName() . `
                },`;              
                $productResponse[] = $productBuff;
            }
        }


        return new Response(\json_encode($productResponse));
    }
}
