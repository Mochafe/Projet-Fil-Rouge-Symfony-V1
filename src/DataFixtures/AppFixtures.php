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
        $iGuitarClassic = new Image();
        $iGuitarClassic->setTitle("Guitares Classiques");
        $iGuitarClassic->setPath("/img/category/guitar_classic.webp");

        $cGuitarClassic = new Category();
        $cGuitarClassic->setName("Guitares Classiques");
        $cGuitarClassic->setParent($mcGuitar);
        $cGuitarClassic->setImage($iGuitarClassic);
        $manager->persist($cGuitarClassic);

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
        $pGuitar->setDescription("## Guitare éléctrique\n\n- 8 cordes\n- Série Progressive\n- Corps en tilleul\n- Profil du manche: Speed D\n- Manche vissé en érable\n- Touche en érable\n- Repères \"points décalés\"\n- Sillet NuBone\n- 24 frettes Medium Jumbo en éventail\n- Rayon de la touche: 350 mm\n- Largeur au sillet: 54 mm\n- Diapason: 692/650 mm\n- Barre de réglage (Truss Rod) double action\n- 2 micros double bobinage Hi-Gain\n- 1 réglage de volume\n- 1 réglage de tonalité\n- Sélecteur 3 positions\n- Accastillage noir\n- Mécaniques DLX moulées sous pression\n- Tirant des cordes: .009, .011, .016, .024, .032, .042, .054, .065\n- Accordage: Fa#, Si, Mi, La, Ré, Sol, Si, Mi\n- Finition: Haute brillance\n- Couleur: Blanc\n- Housse adaptée optionnelle non-fournie (142777)\n");

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




        $pGuitarClassic = new Product();
        $pGuitarClassic->setName("Startone GitarLele NT");
        $pGuitarClassic->setDescription("## Guitarlélé\n\n- Guitare classique 1/8 au format ukulélé\n- Corps en tilleul\n- Manche en nato\n- Touche en Roseacer\n- Diapason: 433 mm\n- Largeur au sillet: 48 mm\n- 17 frettes\n- Chevalet en Roseacer\n- Tête creuse\n- Mécaniques classiques\n- Cordes en nylon (tension moyenne)\n- Accordage: La, Ré, Sol, Do, Mi, La\n- Couleur: Naturel");

        $iGuitarClassic = new Image();
        $iGuitarClassic->setPath("/img/product/Startone GitarLele NT/1.jpg");
        $iGuitarClassic->setTitle("Guitar classic de face");
        $manager->persist($iGuitarClassic);

        $pGuitarClassic->addImage($iGuitarClassic);


        $iGuitarClassic = new Image();
        $iGuitarClassic->setPath("/img/product/Startone GitarLele NT/2.jpg");
        $iGuitarClassic->setTitle("Guitar classic d'arriere");
        $manager->persist($iGuitarClassic);

        $pGuitarClassic->addImage($iGuitarClassic);

        $content["Référencé depuis"] = "Septembre 2020";
        $content["Numéro d'article"] = "489975";
        $content["Conditionnement (UVC)"] = "1 Pièce(s)";
        $content["Pan coupé"] = "Non";
        $content["Table"] = "Tilleul";
        $content["Fond et éclisses"] = "Tilleul";
        $content["Micro"] = "Non";
        $content["Touche"] = "Roseacer";
        $content["Largeur au sillet en mm"] = "48,00 mm";
        $content["Diapason"] = "433 mm";
        $content["Couleur"] = "Naturel";
        $content["Housse incl."] = "Non";
        $content["Etui"] = "Non";

        $pGuitarClassic->setContent($content);
        $pGuitarClassic->setReference(Uuid::v4());
        $pGuitarClassic->setPrice("33");
        $pGuitarClassic->setQuantity(50);
        $pGuitarClassic->setCategory($cGuitarClassic);
        $manager->persist($pGuitarClassic);


        $cTradition = new Category();
        $cTradition->setName("Instruments Traditionnels");

        $itradition = new Image();
        $itradition->setTitle("Image de violon");
        $itradition->setPath("/img/category/tradition.webp");
        $manager->persist($itradition);

        $cTradition->setImage($itradition);
        $manager->persist($cTradition); 

        

        $manager->flush();
    }
}
