<?php

namespace EjemploBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/ejemplo")
     */
    public function indexAction()
    {
        return $this->render('EjemploBundle:Default:index.html.twig');
    }
}
