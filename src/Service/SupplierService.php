<?php

namespace App\Service;

use App\Entity\Supplier;
use App\Repository\SupplierRepository;



class SupplierService
{

    private $supplierRepository;

    public function __construct(SupplierRepository $supplierRepo)
    {
        $this->supplierRepository = $supplierRepo;
    }

    public function turnover($supplier)
    {
        $supplier = $this->supplierRepository->find($supplier);

        $turnover = 0;

        foreach ($supplier->getProducts() as $product) {
            foreach ($product->getOrderDetails() as $orderDetail) {
                $turnover += $product->getPrice() * $orderDetail->getQuantity();
            }
        }

        return $turnover;
    }

}