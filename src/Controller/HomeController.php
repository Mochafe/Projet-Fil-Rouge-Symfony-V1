<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('home/index.html.twig', [
            "categories" => $categoryRepository->findBy(["parent" => null])
        ]);
    }
}
