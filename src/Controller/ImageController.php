<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ImageController extends AbstractController
{
    #[Route('/api/category_image', name: 'addCategoryImage', methods: ["POST"])]
    public function addCategoryImage(Request $request): Response
    {
        $categoryImgPath = $this->getParameter('kernel.project_dir') . '/public/img/category/';

        $image = $request->files->get("image");

        if($image->getError() || !$image->isValid()) {
            return new Response(\json_encode(["message" => "an error occurred"]), 409);
        }

        $image->move($categoryImgPath . "/",  $request->request->get("name") . "." . $image->getClientOriginalExtension());


        return new Response(\json_encode(["message" => "Images uploaded"], 201));
    }

    #[Route('/api/product_images', name: 'addProductImages', methods: ["POST"])]
    public function addProductImages(Request $request): Response
    {
        $productImgPath = $this->getParameter('kernel.project_dir') . '/public/img/product/';

        $path = $productImgPath . $request->request->get("productName");
        
        //check if already exist
        if(!mkdir($path)) {
            return new Response(json_encode(["message" => "product folder already exist"]), 409);
        }


        foreach($request->files->get("images") as $key => $image) {
            //check if an error occured when uploading
            if($image->getError() || !$image->isValid()) {
                return new Response(\json_encode(["message" => "an error occurred"]), 409);
            }

            $image->move($path . "/",  $key . "." . $image->getClientOriginalExtension());
        }



        return new Response(\json_encode(["message" => "Images uploaded"], 201));
    }
}
