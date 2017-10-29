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

  /**
   * @Route("/estudiante/buscar/{id}", name="estudiante_buscar")
   */
  public function buscarAction($id) {
    $repository=$this->getDoctrine()->getRepository("AdminBundle:Estudiante");
    $estudiante = $repository->find($id);
    // Tambien es valido
    // $estudiante=$repository->findOneById($id);
    $data['estudiante']=$estudiante;
    return $this->render('AdminBundle:Estudiante:detalle.html.twig', $data);
  }


  /**
   * @Route("/estudiante/editar/{id}", name="estudiante_editar")
   */
  public function editarAction(Request $request, $id){
    $em = $this->getDoctrine()->getManager();
    $estudiante = $em->getRepository('AdminBundle:Estudiante')->find($id);
    $form = $this->createForm(EstudianteType::class, $estudiante);
    $form->handleRequest($request);
    if ($request->getMethod()=='POST' and $form->isValid()) {
        // Actualizar el registro en la BD
        $em->flush();
        // Preparar mensaje para el usuario
        $request->getSession()
        ->getFlashBag()
        ->add('success', 'El estudiante fue editado exitosamente.');
        // Redireccionar para mostrar el listado
        return $this->redirectToRoute('estudiante_listar');
    }
    // Generar un formulario con los datos de estudiante
    $data['form']=$form->createView();
    return $this->render("AdminBundle:Estudiante:editar.html.twig", $data);
  }

  /**
   * @Route("/estudiante/eliminar/{id}", name="estudiante_eliminar")
   */
  public function eliminarAction(Request $request, $id){
    $em=$this->getDoctrine()->getManager();
    $estudiante=$em->getRepository("AdminBundle:Estudiante")->find($id);
    if(!$estudiante){
      throw $this->createNotFoundException('No existe el estudiante con id: '.$id);
    }
    $em->remove($estudiante);
    $em->flush();
    // Preparar mensaje para el usuario
    $request->getSession()
    ->getFlashBag()
    ->add('success', 'El estudiante fue eliminado exitosamente.');
    // Redireccionar para mostrar el listado
    return $this->redirectToRoute('estudiante_listar');
  }

  /**
   * @Route("/estudiante/search", name="estudiante_search")
   */
  public function searchAction() {
    $request = $this->getRequest();
    $searchterm = $request->get('txt_search');
    $repository=$this->getDoctrine()->getManager()->getRepository('AdminBundle:Estudiante');
    $estudiantes=$repository->searchByNombre($searchterm);
    $data['estudiantes']=$estudiantes;
    return $this->render('AdminBundle:Estudiante:index.html.twig', $data);
    // return new \Symfony\Component\HttpFoundation\Response($searchterm);
  }

  /**
   * @Route("/estudiante/consulta/{nro}", name="estudiante_consulta")
   */
   public function consultasAction($nro){
     $repository=$this->getDoctrine()->getManager()->getRepository('AdminBundle:Estudiante');
     switch($nro){
       case 1:
         // Todos los estudiantes ordenados por nombre
         $estudiantes=$repository->findAllOrderedByNombre();
         $data['estudiantes']=$estudiantes;
         $data['titulo']='Estudiantes ordenados por nombre';
         return $this->render("AdminBundle:Estudiante:consulta1.html.twig", $data);
       break;
       case 2:
         // Todos los estudiantes mayores de edad
         $estudiantes=$repository->findAllMayores();
         $data['estudiantes']=$estudiantes;
         $data['titulo']='Estudiantes mayores de edad';
         return $this->render("AdminBundle:Estudiante:consulta1.html.twig", $data);
       break;
       case 3:
         // Todos los estudiantes menores de edad
         $estudiantes=$repository->findAllMenores();
         $data['estudiantes']=$estudiantes;
         $data['titulo']='Estudiantes menores de edad';
         return $this->render("AdminBundle:Estudiante:consulta1.html.twig", $data);
       break;
       case 4:
         // Recuperar los estudiantes y sus cursos
         $estudiantes=$repository->findEstudiantesCurso();
         $data['estudiantes']=$estudiantes;
         return $this->render("AdminBundle:Estudiante:consulta4.html.twig", $data);
       break;
       case 5:
         // Recuperar cursos y sus estudiantes
         $cursos=$repository->findCursosEstudiantes();
         $data['cursos']=$cursos;
         return $this->render("AdminBundle:Estudiante:consulta5.html.twig", $data);
       break;
     }
   }

}
