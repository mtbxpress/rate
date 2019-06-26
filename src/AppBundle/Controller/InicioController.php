<?php
/*
 * Controlador Inicio, Pagina principal
 * @version 0.1
 * @author Juan José Delgado Romero
 */


namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Curso;

class InicioController extends Controller{

    public function inicioAction(Request $request)
    {

    	// $em = $this->getDoctrine()->getManager();
     //    $rep = $em->getRepository('AppBundle:Curso');
     //    $cursoActivo = $rep->findBy(array('activo' => 1));

     //    if($cursoActivo){

     //      	$session = $request->getSession();
    	// 	$session->set('cursoActivo', $cursoActivo[0]->getDescripcion());
     //        //die("CURSO ".$session->get('cursoActivo') );
     //    }

        return $this->render('Inicio/inicio.html.twig'/*, array('cursoActivo' => $cursoActivo)*/);
    //    return $this->render('Inicio/inicio.html.twig');
       // return $this->render('@App/base_menu.html.twig');
    }
}