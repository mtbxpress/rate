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

class InicioController extends Controller{

    public function inicioAction(Request $request)
    {
        return $this->render('Inicio/inicio.html.twig');
    //    return $this->render('Inicio/inicio.html.twig');
       // return $this->render('@App/base_menu.html.twig');
    }
}