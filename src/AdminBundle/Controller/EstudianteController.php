<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AdminBundle\Entity\Estudiante;
use AdminBundle\Form\EstudianteType;
use Symfony\Component\HttpFoundation\Request;

class EstudianteController extends Controller{

  /**
  * @Route("/estudiante", name="estudiante_listar")
  */
  public function indexAction(){
    // getDoctrine() devuelve objeto para manejo de servicios doctrine.
    // getManager() devuelve objeto para manejo de proceso de persistencia.
    $em=$this->getDoctrine()->getManager();
    // getRepository devuelve un objeto de una clase entidad
    // findAll() metodo similar a un SELECT * FROM estudiante
    $estudiantes=$em->getRepository('AdminBundle:Estudiante')->findAll();
    $data['estudiantes']=$estudiantes;
    return $this->render('AdminBundle:Estudiante:index.html.twig', $data);
  }

  /**
  * @Route("/estudiante/guardar/demo", name="estudiante_guardar_demo")
  */
  public function guardarDemoAction(){
    // Recuperar los datos
    $estudiante = new Estudiante();
    $estudiante->setNombre("hugo");
    $estudiante->setEmail("hugo@gmail.com");
    // DateTime(): devuelve la fecha actual
    $estudiante->setFechanac(new \DateTime());
    $estudiante->setEdad(50);
    // Persistimos la instancia
    $em = $this->getDoctrine()->getManager();
    $em->persist($estudiante);
    $em->flush();
    // Redireccionamos llamando a la ruta para listar estudiantes
    return $this->redirectToRoute('estudiante_listar');
  }


  /**
  * @Route("/estudiante/nuevo", name="estudiante_nuevo")
  */
  public function nuevoAction(){
    // Metodo que pemite generar el formulario en blanco
    $form=$this->createForm(EstudianteType::class);
    $data['form']=$form->createView();
    return $this->render('AdminBundle:Estudiante:nuevo.html.twig',$data);
  }

  /**
  * @Route("/estudiante/guardar", name="estudiante_guardar")
  */
  public function guardarAction(Request $request){
    $estudiante=new Estudiante();
    // Se asocia el objeto estudiante con el formulario
    $form=$this->createForm(EstudianteType::class, $estudiante);
    // Se obtienen los datos provenientes del formulario
    $form->handleRequest($request);
    // Verificar que los datos provenientes del formulario sean validos
    if($form->isValid()){ // Tambien se verifica si es post o get
      // Se procede a guardar los datos
      $em = $this->getDoctrine()->getManager();
      $em->persist($estudiante);
      $em->flush();
      // Preparar mensaje para el usuario
      $request->getSession()
      ->getFlashBag()
      ->add('success', 'El estudiante '.$estudiante->getNombre().' fue guardado exitosamente.');
      // Redireccionamos llamando a la ruta para listar estudiantes
      return $this->redirectToRoute('estudiante_listar');
    }else{
      // En caso que los datos no sean validos redireccionar al formulario
      return $this->redirectToRoute('estudiante_nuevo');
    }
  }
}
