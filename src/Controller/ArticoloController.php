<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 25/04/2019
 * Time: 22:22
 */

namespace App\Controller;

use App\Repository\ArticoloRepository;
use Doctrine\ORM\Query\Expr;
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
     * @Route("/", name="articolo_index")
     */
    public function index(Request $request)
    {
        if (null!== $request->get('codice')){
            $articoli = $this->articoloRepository->findArticolo($request->get('codice'));
        } else {
            $articoli = $this->articoloRepository->findAll();
        }

        return $this->render('articolo/index.html.twig', [
            'articoli' => $articoli,
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

    /**
     * @Route("/profili/{serie}", name="profili_serie")
     */
    public function serie_profili(Request $request, $serie)
    {
        $articoli = $this->articoloRepository->findProfiliSerie($serie);

        return $this->render('articolo/index.html.twig', [
            'articoli' => $articoli,
        ]);
    }


}