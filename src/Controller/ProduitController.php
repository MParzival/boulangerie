<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/produit")
 **/
class ProduitController extends AbstractController
{
    /**
     * @Route("/", name="produit")
     */
    public function index(ProduitRepository $produitRepository)
    {
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

    /**
     * @param ProduitRepository $produitRepository
     * @param Produit $produit
     * @Route("/show/{id}",name="produit_show")
     * Function show
     * User: emayemba
     * Date: 06/08/2020
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(ProduitRepository $produitRepository,Produit $produit){
        return $this->render('produit/showProduit.html.twig',[
            'produit'=>$produit,
        ]);
    }
}
