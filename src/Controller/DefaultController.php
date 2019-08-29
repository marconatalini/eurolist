<?php

namespace App\Controller;

use App\Repository\FamigliaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(FamigliaRepository $famigliaRepository)
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'famiglie' => $famigliaRepository->findAll(),
        ]);
    }
}
