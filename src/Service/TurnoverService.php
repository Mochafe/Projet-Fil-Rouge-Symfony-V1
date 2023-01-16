<?php

namespace App\Service;

use App\Repository\OrderRepository;
use Doctrine\DBAL\Driver\PDO\Exception;



class TurnoverService
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }

    public function turnover($year)
    {
        $orders = $this->orderRepository->findAll();
        $ordersResult = [];


        foreach ($orders as $order) {
            if ($order->getCreateAt()->format("Y") != $year)
                continue;

            $ordersResult[] = $order;
        }


        $turnover = [
            "january" => 0,
            "february" => 0,
            "march" => 0,
            "april" => 0,
            "may" => 0,
            "june" => 0,
            "july" => 0,
            "august" => 0,
            "september" => 0,
            "octobre" => 0,
            "november" => 0,
            "december" => 0,
        ];


        foreach ($ordersResult as $order) {
            foreach ($order->getOrderDetails() as $orderDetail) {

                switch ($order->getCreateAt()->format("m")) {
                    case "01":
                        $turnover["january"] += $orderDetail->getProduct()->getPrice() * $orderDetail->getQuantity();
                        break;
                    case "02":
                        $turnover["february"] += $orderDetail->getProduct()->getPrice() * $orderDetail->getQuantity();
                        break;
                    case "03":
                        $turnover["march"] += $orderDetail->getProduct()->getPrice() * $orderDetail->getQuantity();                        
                        break;
                    case "04":
                        $turnover["april"] += $orderDetail->getProduct()->getPrice() * $orderDetail->getQuantity();                        
                        break;
                    case "05":
                        $turnover["may"] += $orderDetail->getProduct()->getPrice() * $orderDetail->getQuantity();                        
                        break;
                    case "06":
                        $turnover["june"] += $orderDetail->getProduct()->getPrice() * $orderDetail->getQuantity();                        
                        break;
                    case "07":
                        $turnover["july"] += $orderDetail->getProduct()->getPrice() * $orderDetail->getQuantity();                        
                        break;
                    case "08":
                        $turnover["august"] += $orderDetail->getProduct()->getPrice() * $orderDetail->getQuantity();                        
                        break;
                    case "09":
                        $turnover["september"] += $orderDetail->getProduct()->getPrice() * $orderDetail->getQuantity();                        
                        break;
                    case "10":
                        $turnover["octobre"] += $orderDetail->getProduct()->getPrice() * $orderDetail->getQuantity();                        
                        break;
                    case "11":
                        $turnover["november"] += $orderDetail->getProduct()->getPrice() * $orderDetail->getQuantity();                        
                        break;
                    case "12":
                        $turnover["december"] += $orderDetail->getProduct()->getPrice() * $orderDetail->getQuantity();                        
                        break;

                    default:
                        throw new Exception("month not found");
                }
            }
        }


        return $turnover;
    }

}