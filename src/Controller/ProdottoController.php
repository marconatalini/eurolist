<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 26/04/2019
 * Time: 14:11
 */

namespace App\Controller;

use App\Repository\ProdottoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prodotto")
 */
class ProdottoController extends AbstractController
{
    /**
     * @var ProdottoRepository
     */
    private $prodottoRepository;

    public function __construct(ProdottoRepository $prodottoRepository)
    {

        $this->prodottoRepository = $prodottoRepository;
    }

    /**
     * @Route("/", name="prodotto_index")
     */
    public function index()
    {
        var_dump($this->prodottoRepository->findProdotti());die;

        return $this->render('prodotto/index.html.twig' , [
           'prodotti' => $this->prodottoRepository->findProdotti(),
        ]);
    }

}