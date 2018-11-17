<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Titulacion;
class TitulacionController extends Controller
{

    public function crearTitulacionAction(Request $request){

        try{
            $titulacion = new Titulacion();
            $form = $this->createForm(\AppBundle\Form\TitulacionType::class, $titulacion);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                $em = $this->getDoctrine()->getManager();
                $em->persist($titulacion);
                $em->flush();

                $this->addFlash('success', 'Registro creado correctamente' );
                $titulacion = new Titulacion();
                $form = $this->createForm(\AppBundle\Form\TitulacionType::class, $titulacion);
            return $this->render('Titulacion/crear_titulacion.html.twig', array('form' => $form->createView() ));
            }
        }catch (Exception $ex) {
                echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
        return $this->render('Titulacion/crear_titulacion.html.twig', array('form' => $form->createView() ));
    }

    public function mostrarTitulacionesAction(){

        try{
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Titulacion');
            $titulaciones = $rep->findAll();

        } catch (Exception $ex) {
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
        return $this->render('Titulacion/mostrar_titulaciones.html.twig', array('titulaciones'=>$titulaciones ));


    }

}
