<?php

namespace App\Service;
use App\Entity\Category;
use App\Repository\CategoryRepository;


class CategoryService {

    public function delete($id, CategoryRepository $categoryRepository) {
        dd($id);
    }

}