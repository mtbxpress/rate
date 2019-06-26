<?php

// src/AppBundle/Controller/SecurityController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Trata las pantallas en relación al 'log in' de administrador, usuarios, etc.
 */
class SecurityController extends Controller
{
    /**
     * Lógica de la pantalla de 'log in'.
     * @param  Request $request
     * @return Response HTML
     */
    public function loginAdminAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('AppBundle:Curso');
        $cursoActivo = $rep->findBy(array('activo' => 1));

        if($cursoActivo){

            $session = $request->getSession();
            $session->set('cursoActivo', $cursoActivo[0]->getDescripcion());
            //die("CURSO ".$session->get('cursoActivo') );
        }
        
        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

}

