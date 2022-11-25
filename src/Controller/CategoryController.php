<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/category', name: 'category')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'Main')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findBy([
            "parent" => null
        ]);

        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/{category}', name: 'Sub')]
    public function sub(Category $category): Response
    {

        return $this->render('category/sub.html.twig', [
            'parentCategory' => $category,
            'categories' => $category->getChilds()
        ]);
    }

    #[Route('/products/{category}', name: 'Products')]
    public function products(Category $category): Response
    {
        return $this->render('category/products.html.twig', [
            'category' => $category,
            'products' => $category->getProducts()
        ]);
    }
}
