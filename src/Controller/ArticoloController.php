<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 25/04/2019
 * Time: 22:22
 */

namespace App\Controller;

use App\Repository\ArticoloRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/articolo")
 */
class ArticoloController extends AbstractController
{
    /**
     * @var ArticoloRepository
     */
    private $articoloRepository;

    public function __construct(ArticoloRepository $articoloRepository)
    {
        $this->articoloRepository = $articoloRepository;
    }

    /**
     * @Route("/", defaults={"page": "1", "_format"="html"}, methods={"GET"}, name="articolo_index")
     * @Route("/page/{page<[1-9]\d*>}", defaults={"_format"="html"}, methods={"GET"}, name="articolo_index_paginated")
     * @Cache(smaxage="10")
     *
     * NOTE: For standard formats, Symfony will also automatically choose the best
     * Content-Type header for the response.
     * See https://symfony.com/doc/current/quick_tour/the_controller.html#using-formats
     */
    public function index(Request $request, int $page)
    {
        $serie = null;
        if ($request->query->has('serie')){
            $serie = $request->get('serie');
        }

        $classe = null;
        if ($request->query->has('classe')){
            $classe = $request->get('classe');
        }


        $articoli = $this->articoloRepository->findArticoli($page, $serie, $classe);

        return $this->render('articolo/index.html.twig', [
            'paginator' => $articoli,
        ]);
    }

    /**
     * @Route("/classe/{classe<[B]\S{1}>}", name="articoli_classe")
     */
    public function articoli_classe($classe)
    {
        $articoli = $this->articoloRepository->findArticoliClasse($classe);

        return $this->render('articolo/index.html.twig', [
            'articoli' => $articoli,
        ]);
    }

}