<?php

namespace App\Controller;

use App\Service\CategoryService;
use App\Service\SupplierService;
use App\Repository\OrderRepository;
use App\Service\TurnoverService;
use DateTime;
use Proxies\__CG__\App\Entity\Supplier;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    #[Route('/api/categories/{id}', name: 'app_api', methods: ["DELETE"])]
    public function deleteCategory($id, CategoryService $categoryService): Response
    {
        $categoryService->delete($id);
        return new Response(status: 202);
    }

    #[Route('/api/supplier_turnover/{id}')]
    public function turnover($id, SupplierService $supplierService) {
        return new Response(\json_encode(["turnover" => $supplierService->turnover($id)]), 200);
    }

    #[Route('/api/turnover_months/{year}')]
    public function turnoverMonths($year, OrderRepository $orderRepository, TurnoverService $turnoverService) {
        return new Response(\json_encode($turnoverService->turnover($year)), 200, ["Content-Type" => "application/json"]);
    }
}
