<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Encuesta;

class EncuestaController extends Controller
{

    public function crearEncuestaAction(Request $request){

        try{
            $encuesta = new Encuesta();
            $form = $this->createForm(\AppBundle\Form\EncuestaType::class, $encuesta);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();

            if($form->isSubmitted() && $form->isValid()){

                $em = $this->getDoctrine()->getManager();
                $em->persist($encuesta);
                $em->flush();

                $this->addFlash('success', 'Registro creado correctamente' );
                $encuesta = new Encuesta();
                ///$form = $this->createForm(\AppBundle\Form\TitulacionType::class, $titulacion);
                //return $this->render('Titulacion/crear_titulacion.html.twig', array('form' => $form->createView() ));
            }
        }catch (Exception $ex) {
                echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
        $rep = $em->getRepository('AppBundle:Encuesta');
    //    $encuestas = $rep->mostarEncuestasAnyoActivo();
        return $this->render('Encuesta/crear_encuesta.html.twig', array('form' => $form->createView()/*, 'encuestas'=>$encuestas*/ ));
    }
}
