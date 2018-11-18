<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Encuesta;
use AppBundle\Entity\Curso;

class EncuestaController extends Controller
{

    public function crearEncuestaAction(Request $request){

        try{
            $encuesta = new Encuesta();
            $form = $this->createForm(\AppBundle\Form\EncuestaType::class, $encuesta);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();

            if($form->isSubmitted() && $form->isValid()){

	   	//   $evaluado= $form['evaluado']->getData();
            	   if($encuesta->getEvaluado() != $encuesta->getUsuario() ){
	            	   $na = $encuesta->getEvaluado()->getNombre().' '.$encuesta->getEvaluado()->getApellidos() ;
	            	   $encuesta->setNaevaluado($na);
	           //     $em = $this->getDoctrine()->getManager();
	            	   $rep = $em->getRepository('AppBundle:Curso');
	                $cursoActivo = $rep->findBy(	array('activo' => 1));
	                $cursoActivo[0]->addTitulacione($encuesta->getTitulacion());
	                $em->persist($encuesta);
	                $em->flush();



 		   }
 		   else { $this->addFlash('success', 'Un usuario no puede evaluarse así mismo' ); }


            }
        }catch (Exception $ex) {
                echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
        $rep = $em->getRepository('AppBundle:Encuesta');
        $encuestas = $rep->mostarEncuestasCursoActivo();


        return $this->render('Encuesta/crear_encuesta.html.twig', array('form' => $form->createView(), 'encuestas'=>$encuestas ));
    }
}
