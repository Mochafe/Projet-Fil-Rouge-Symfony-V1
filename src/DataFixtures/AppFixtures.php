<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Uid\Uuid;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Validator\Constraints\Uuid as ConstraintsUuid;

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
        $iGuitarE = new Image();
        $iGuitarE->setTitle("Guitares Electriques");
        $iGuitarE->setPath("/img/category/guitar_electrique.webp");

        $cGuitarE = new Category();
        $cGuitarE->setName("Guitares Electriques");
        $cGuitarE->setParent($mcGuitar);
        $cGuitarE->setImage($iGuitarE);
        $manager->persist($cGuitarE);

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

        $pGuitar = new Product();
        $pGuitar->setName("Harley Benton R-458MN WH Fanfret");
        $pGuitar->setDescription("# Guitare éléctrique\n
        <br>\n
        - 8 cordes\n
        - Série Progressive\n
        - - Corps en tilleul\n
        - Profil du manche: Speed D\n
        - Manche vissé en érable\n
        - Touche en érable\n
        - Repères \"points décalés\"\n
        - Sillet NuBone\n
        - 24 frettes Medium Jumbo en éventail\n
        - Rayon de la touche: 350 mm\n
        - Largeur au sillet: 54 mm\n
        - Diapason: 692/650 mm\n
        - Barre de réglage (Truss Rod) double action\n
        - 2 micros double bobinage Hi-Gain\n
        - 1 réglage de volume\n
        - 1 réglage de tonalité\n
        - Sélecteur 3 positions\n
        - Accastillage noir\n
        - Mécaniques DLX moulées sous pression\n
        - Tirant des cordes: .009, .011, .016, .024, .032, .042, .054, .065\n
        - Accordage: Fa#, Si, Mi, La, Ré, Sol, Si, Mi\n
        - Finition: Haute brillance\n
        - Couleur: Blanc\n
        - Housse adaptée optionnelle non-fournie (142777) \n
        ");

        $gElec = new Image();
        $gElec->setPath("/img/product/Harley Benton R-458MN WH Fanfret/1.jpg");
        $gElec->setTitle("Image de la guitare");
        $manager->persist($gElec);

        $pGuitar->addImage($gElec);

        $gElec = new Image();
        $gElec->setPath("/img/product/Harley Benton R-458MN WH Fanfret/2.jpg");
        $gElec->setTitle("Image de la guitare");
        $manager->persist($gElec);

        $pGuitar->addImage($gElec);

        $content["Référencé depuis"] = "Juin 2018";
        $content["Numéro d'article"] = "427252";
        $content["Conditionnement (UVC)"] = "1 Pièce(s)";
        $content["Couleur"] = "Blanc";
        $content["Corps"] = "Tilleul";
        $content["Table"] = "Aucune";
        $content["Manche"] = "Erable";
        $content["Touche"] = "Erable";
        $content["Frettes"] = "24";
        $content["Diapason"] = "686 mm";
        $content["équipement de micros"] = "HH";
        $content["Vibrato"] = "Non";
        $content["Etui inclu"] = "Non";
        $content["Housse incl."] = "Non";

        $pGuitar->setContent($content);

        $pGuitar->setReference(Uuid::v4());
        $pGuitar->setPrice("198");
        $pGuitar->setQuantity(12);
        $pGuitar->setCategory($cGuitarE);
        $manager->persist($pGuitar);

        $manager->flush();
    }
}
