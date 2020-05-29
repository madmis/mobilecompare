<?php

namespace App\Controller\Html;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     *
     * @return Response
     */
    public function home() : Response
    {
        return $this->render('home.html.twig');
    }
}
