<?php

namespace App\Service;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ImageRepository;
use App\Repository\ProductRepository;


class CategoryService {

    private $categoryRepository;
    private $productRepository;
    private $imageRepository;

    public function __construct(CategoryRepository $catRepo, ProductRepository $productRepository, ImageRepository $imageRepository) {
        $this->categoryRepository = $catRepo;
        $this->productRepository = $productRepository;
        $this->imageRepository = $imageRepository;
    }
    
    //TODO main cat can't delete
    public function delete($id) {

        //get noCat
        $noCat = $this->categoryRepository->find(1);

        // dd($noCat);
        $category = $this->categoryRepository->find($id);


        $products = $category->getProducts();
        //set product category to noCat
        foreach($products as $product) {
            $product->setCategory($noCat);
            $this->productRepository->save($product);
        }

        $childs = $category->getChilds();


        foreach($childs as $child) {
            $child->setParent($noCat);
            $this->categoryRepository->save($child);
        }

    
        $this->imageRepository->remove($category->getImage(), true);

        $this->categoryRepository->remove($category, true);
    
    }

}