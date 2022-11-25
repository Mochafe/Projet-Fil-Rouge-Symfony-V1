<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager) : void
    {
        //Categorie Guitare
        $iGuitar = new Image();
        $iGuitar->setTitle("Guitares & Basses");
        $iGuitar->setPath("/img/category/guitarbasse.webp");

        $manager->persist($iGuitar);

        $mcGuitar = new Category();
        $mcGuitar->setName("Guitares & Basses");
        $mcGuitar->setImage($iGuitar);
        $manager->persist($mcGuitar);


        //Sous-Categorie de guitar
        //Guitar electrique
        $iGuitar = new Image();
        $iGuitar->setTitle("Guitares Electriques");
        $iGuitar->setPath("/img/category/guitar_electrique.webp");

        $cGuitar = new Category();
        $cGuitar->setName("Guitares Electriques");
        $cGuitar->setParent($mcGuitar);
        $cGuitar->setImage($iGuitar);
        $manager->persist($cGuitar);

        //Guitar classique
        $iGuitar = new Image();
        $iGuitar->setTitle("Guitares Classiques");
        $iGuitar->setPath("/img/category/guitar_classic.webp");

        $cGuitar = new Category();
        $cGuitar->setName("Guitares Classiques");
        $cGuitar->setParent($mcGuitar);
        $cGuitar->setImage($iGuitar);
        $manager->persist($cGuitar);

        //Basses Electrique
        $iGuitar = new Image();
        $iGuitar->setTitle("Basses Electriques");
        $iGuitar->setPath("/img/category/guitar_basseelectrique.webp");

        $cGuitar = new Category();
        $cGuitar->setName("Basses Electriques");
        $cGuitar->setParent($mcGuitar);
        $cGuitar->setImage($iGuitar);
        $manager->persist($cGuitar);


        $manager->flush();
    }
}
