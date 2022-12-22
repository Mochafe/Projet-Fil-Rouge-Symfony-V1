<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/product', name: 'product')]
class ProductController extends AbstractController
{
    #[Route('/view/{product}', name: 'View')]
    public function view(Product $product): Response
    {
        return $this->render('product/product.html.twig', [
            "product" => $product
        ]);
    }

    #[Route('/view', name: 'ViewAll')]
    public function viewAll(ProductRepository $productRepository): Response
    {
        
        return $this->render('product/products.html.twig', [
            "products" => $productRepository->findAll()
        ]);
    }

    #[Route('/new', methods:["POST"])]
    public function new(Request $request): Response {

        var_dump($request);
        return new Response("");
    }
}
