<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PruebaController extends Controller{
    /**
     * @Route("/prueba/saludo" , name="saludo")
     */
    public function indexAction(){
        return new Response('Buenas noches curso Symfony...');
    }
    
    /**
     * @Route("/prueba/parametros/{nombre}/{edad}" , name="parametros")
     */
    public function parametrosAction($nombre, $edad){
    	return new Response($nombre.' tiene '.$edad.' años');
    }
    
    /**
     * @Route("/prueba/empleado/{nombre}/{sueldo}" , defaults={"nombre"="Ana","sueldo"=5000}, name="empleado")
     */
    public function reporteAction($nombre, $sueldo){
        return new Response('Nombre: '.$nombre.' sueldo: '.$sueldo);
    }  
}
