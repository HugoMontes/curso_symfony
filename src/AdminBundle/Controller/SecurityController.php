<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller{

  /**
   * @Route("/login", name="user_login")
   */
  public function loginAction(){
    $authenticationUtils = $this->get('security.authentication_utils');
    $error=$authenticationUtils->getLastAuthenticationError();
    $lastUsername=$authenticationUtils->getLastUserName();
    $data['error']=$error;
    $data['last_username']=$lastUsername;
    return $this->render('AdminBundle:Security:login.html.twig', $data);
  }

  /**
   * @Route("/login_check", name="user_login_check")
   */
  public function loginCheckAction(){

  }

  /**
   * @Route("/logout", name="user_logout")
   */
  public function logoutAction(){

  }
}
