<?php
/*
 * Controlador Login
 * @version 0.1
 * @author Juan José Delgado Romero
 */


namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
	public function loginAction(){
	    return $this->render('login.html.twig');
	}

}