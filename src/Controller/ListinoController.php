<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 26/04/2019
 * Time: 12:11
 */

namespace App\Controller;

use App\Repository\ListinoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/listino")
 */
class ListinoController extends AbstractController
{
    /**
     * @var ListinoRepository
     */
    private $listinoRepository;

    public function __construct(ListinoRepository $listinoRepository)
    {
        $this->listinoRepository = $listinoRepository;
    }

    /**
     * @Route("/", name="listino_index")
     */
    public function index()
    {
        return $this->render("listino\index.html.twig",[
           'listini' => $this->listinoRepository->findAll()
        ]);
    }

}