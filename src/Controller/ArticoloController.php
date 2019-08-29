<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 25/04/2019
 * Time: 22:22
 */

namespace App\Controller;

use App\Repository\ArticoloRepository;
use App\Repository\FamigliaRepository;
use Doctrine\Common\Collections\ArrayCollection;
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
    public function index(Request $request, int $page, ArticoloRepository $articoloRepository, FamigliaRepository $famigliaRepository)
    {
        $serie = null;
        if ($request->query->has('serie')){
            $serie = $request->get('serie');
        }

        $search = null;
        if ($request->query->has('codice')){
            $search = $request->get('codice');
        }

        $classe = null;
        if ($request->query->has('classe')){
            $classe = $request->get('classe');
        }

        $linkTo = null;
        if ($request->query->has('linkTo')){
            $linkTo = $articoloRepository->find($request->query->get('linkTo'))->getLinkedTo();
        }

        $famiglie = null;
        if ($request->query->has('familyOf')){
            $famiglie = $articoloRepository->find($request->query->get('familyOf'))->getFamiglie();
        }

        $famiglia = null;
        if ($request->query->has('famiglia')){
            $famiglie = array($famigliaRepository->find($request->query->get('famiglia')));
        }

        $articoli = $this->articoloRepository->findArticoli($page, $serie, $search, $classe, $linkTo, $famiglie);

        return $this->render('articolo/index.html.twig', [
            'paginator' => $articoli,
            'famiglie' => $famigliaRepository->findAll(),
        ]);
    }
}