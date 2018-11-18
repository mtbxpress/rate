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
            $em = $this->getDoctrine()->getManager();

            if($form->isSubmitted() && $form->isValid()){

                $em = $this->getDoctrine()->getManager();
                $em->persist($titulacion);
                $em->flush();

                $this->addFlash('success', 'Registro creado correctamente' );
                $titulacion = new Titulacion();
                ///$form = $this->createForm(\AppBundle\Form\TitulacionType::class, $titulacion);
                //return $this->render('Titulacion/crear_titulacion.html.twig', array('form' => $form->createView() ));
            }
        }catch (Exception $ex) {
                echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
        $rep = $em->getRepository('AppBundle:Titulacion');
        $titulaciones = $rep->mostarTitulacionesAnyoActivo();
        return $this->render('Titulacion/crear_titulacion.html.twig', array('form' => $form->createView(), 'titulaciones'=>$titulaciones ));
    }

    public function mostrarTitulacionesAction(){

        try{
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Titulacion');
       //     $titulaciones = $rep->findAll();
            $titulaciones = $rep->mostarTitulacionesAnyoActivo();

        } catch (Exception $ex) {
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
        return $this->render('Titulacion/mostrar_titulaciones.html.twig', array('titulaciones'=>$titulaciones ));


    }

    public function eliminarTitulacionAction(Request $request, $idTitulacion){
        try{
            $m = $this->getDoctrine()->getManager();
            $titulacion = $m->getRepository('AppBundle:Titulacion')->find($idTitulacion);
            if(!$titulacion){
                throw $this->createNotFoundException('La titulacion con id: '.$idTitulacion.' no existe.');
            }
//            $idLogado = $this->getuser()->getId();
             if( in_array("ROLE_ADMIN", $this->getuser()->getRoles(), FALSE) ){

                $m->remove($titulacion);
                $m->flush();
                $this->addFlash('success', 'Registro eliminado correctamente' );
             }
             else{
                $this->addFlash('danger', 'No puede eliminarse así mismo' );
             }
        //     $_SERVER['PHP_SELF']
      //        $request = $this->container->get('request'); $routeName = $request->get('_route');  die($this->get('kernel')->getRootDir());
            return $this->redirectToRoute('mostrar_titulaciones');
        }
        catch (Exception $ex) {
            $this->addFlash('danger', 'Registro no se ha eliminado correctamente' );
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
    }

public function editarTitulacionAction(Request $request, $idTitulacion){

  try{
   $m = $this->getDoctrine()->getManager();
   $titulacion = $m->getRepository('AppBundle:Titulacion')->find($idTitulacion);

 /*  foreach ($titulacion->getCursos() as $key => $value) {
     echo $value->getDescripcion();
   }
   die("aqui");*/
   $form = $this->createForm(\AppBundle\Form\TitulacionType::class, $titulacion);
   $form->handleRequest($request);

   if($form->isSubmitted() && $form->isValid()){
        $titulacion = $form->getData();
        $man = $this->getDoctrine()->getManager();
        $man->persist($titulacion);
        $man->flush();
        $this->addFlash('success', 'Registro modificado correctamente' );

        return $this->redirectToRoute('mostrar_titulaciones');
   }
    $rep = $m->getRepository('AppBundle:Titulacion');
    $titulaciones = $rep->mostarTitulacionesAnyoActivo();
  }
  catch(Excepcition $ex){
   echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
  }
  return $this->render('Titulacion/editar_titulacion.html.twig', array('form' => $form->createView(), 'titulaciones'=>$titulaciones) );
 }
}

