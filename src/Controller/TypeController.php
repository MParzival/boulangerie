<?php

namespace App\Controller;

use App\Entity\Type;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type")
 **/
class TypeController extends AbstractController
{
    /**
     * @Route("/", name="type")
     */
    public function index(TypeRepository $typeRepository)
    {
        return $this->render('type/index.html.twig', [
            'types' => $typeRepository->findAll(),
        ]);
    }

    /**
     * @param TypeRepository $typeRepository
     * @param Type $type
     * @Route("/show/{id}",name="type_show")
     * Function show
     * User: emayemba
     * Date: 06/08/2020
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(TypeRepository $typeRepository,Type $type)
    {
        return $this->render('type/showType.html.twig',[
            'type'=>$type,
        ]);
    }
}
