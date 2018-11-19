<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Encuesta;
use AppBundle\Entity\Curso;
use AppBundle\Entity\Pregunta;

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

   public function eliminarEncuestaAction(Request $request, $idEncuesta){
        try{
            $m = $this->getDoctrine()->getManager();
            $encuesta = $m->getRepository('AppBundle:Encuesta')->find($idEncuesta);
            if(!$encuesta){
                throw $this->createNotFoundException('La encuesta con id: '.$idEncuesta.' no existe.');
            }
//            $idLogado = $this->getuser()->getId();
             if( in_array("ROLE_ADMIN", $this->getuser()->getRoles(), FALSE) ){

                $query = "delete from AppBundle\Entity\EncuestaPregunta m where m.encuesta = $idEncuesta";
                $q = $m->createQuery($query);
                $numDeleted = $q->execute();

                $m->remove($encuesta);
                $m->flush();
                $this->addFlash('success', 'Registro eliminado correctamente' );
             }

        //     $_SERVER['PHP_SELF']
      //        $request = $this->container->get('request'); $routeName = $request->get('_route');  die($this->get('kernel')->getRootDir());
            return $this->redirectToRoute('crear_encuesta');
        }
        catch (Exception $ex) {
            $this->addFlash('danger', 'Registro no se ha eliminado correctamente' );
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
    }

public function editarEncuestaAction(Request $request, $idEncuesta){

  try{
   $m = $this->getDoctrine()->getManager();
   $encuesta = $m->getRepository('AppBundle:Encuesta')->find($idEncuesta);

   $form = $this->createForm(\AppBundle\Form\EncuestaType::class, $encuesta);
   $form->handleRequest($request);
   $rep = $m->getRepository('AppBundle:Encuesta');
//$this->asignaPreguntasAEncuestaSegunUsuario($encuesta);
   if($form->isSubmitted() && $form->isValid()){
        $encuesta = $form->getData();
        $man = $this->getDoctrine()->getManager();
        $man->persist($encuesta);
        $man->flush();

        $this->addFlash('success', 'Registro modificado correctamente' );

        return $this->redirectToRoute('crear_encuesta');
   }
    $rep = $m->getRepository('AppBundle:Encuesta');
    $encuestas = $rep->mostarEncuestasCursoActivo();
  }
  catch(Excepcition $ex){
   echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
  }
  return $this->render('Encuesta/editar_encuesta.html.twig', array('form' => $form->createView(), 'encuestas'=>$encuestas) );
 }
/*
 public function asignaPreguntasAEncuestaSegunUsuario($encuesta){

  try{
       $m = $this->getDoctrine()->getManager();


    //   $service = $repository->findBy(array('name' => 'Registration'),array('name' => 'ASC'),1 ,0)[0];

        if($encuesta->getUsuario()->getRoles()[] == "ROLE_PROFE"){
            $preguntas = $m->getRepository('AppBundle:Pregunta')->find(array('tipo' => 'PROFESOR_EXTERNO'),array('orden' => 'ASC') ) ;
        }
        echo $encuesta->getUsuario()->getRoles() ;die();
        echo count($encuestas); die("DDD");
  }
  catch(Excepcition $ex){
   echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
  }
  return $this->render('Encuesta/editar_encuesta.html.twig', array('form' => $form->createView(), 'encuestas'=>$encuestas) );
 }
*/
}
