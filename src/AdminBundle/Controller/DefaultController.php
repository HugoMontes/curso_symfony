<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller{
    /**
     * @Route("/", name="escritorio")
     */
    public function indexAction(){
        return $this->render('AdminBundle:Default:index.html.twig');
    }
}
