<?php

namespace App\Controller;

use App\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/categories/{id}', name: 'app_api', methods: ["DELETE"])]
    public function index($id, CategoryService $categoryService): Response
    {
        $categoryService->delete($id);
        return new Response(status: 202);
    }
}
