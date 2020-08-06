<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/ingredient")
 **/
class IngredientController extends AbstractController
{
    /**
     * @Route("/", name="ingredient")
     */
    public function index(IngredientRepository $ingredientRepository)
    {
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredientRepository->findAll(),
        ]);
    }

    /**
     * Function showIngredient
     * @Route("/show/{id}",name="ingredient_show")
     * User: emayemba
     * Date: 06/08/2020
     */
    public function showIngredient(IngredientRepository $ingredientRepository,Ingredient $ingredient){
      return $this->render('ingredient/showIngredient.html.twig',[
          'ingredient'=>$ingredient,
      ]);
    }
}
