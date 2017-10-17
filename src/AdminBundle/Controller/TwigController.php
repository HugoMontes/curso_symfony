<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TwigController extends Controller{
  /**
  * @Route("/twig", name="twig")
  */
  public function indexAction(){
    return $this->render('AdminBundle:Default:index.html.twig');
  }

  /**
  * @Route("/twig/datos/{nombre}/{edad}", name="twig1")
  */
  public function datosAction($nombre,$edad){
    $data['nombre']=$nombre;
    $data['edad']=$edad;
    return $this->render('AdminBundle:Default:prueba1.html.twig', $data);
  }

  /**
  * @Route("/twig/etiquetas", name="twig2")
  */
  public function etiquetasAction(){
    return $this->render('AdminBundle:Default:prueba2.html.twig');
  }

  /**
  * @Route("/twig/coleccion", name="twig3")
  */
  public function coleccionAction(){
    $personas=array(
      array('id'=>1, 'nombre'=>'Juan', 'edad'=>25),
      array('id'=>2, 'nombre'=>'Ana', 'edad'=>12),
      array('id'=>3, 'nombre'=>'Maria', 'edad'=>35),
      array('id'=>4, 'nombre'=>'Ivan', 'edad'=>48),
    );
    $data['personas']=$personas;
    return $this->render('AdminBundle:Default:prueba3.html.twig', $data);
  }

}
