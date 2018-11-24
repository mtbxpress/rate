<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Encuesta;
use AppBundle\Entity\Curso;
use AppBundle\Entity\Pregunta;
use AppBundle\Entity\EncuestaPregunta;

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
	            	   $rep = $em->getRepository('AppBundle:Curso');
	                $cursoActivo = $rep->findBy(	array('activo' => 1));
	                $cursoActivo[0]->addTitulacion($encuesta->getTitulacion());

                             $rep = $em->getRepository('AppBundle:Pregunta');
                             if($encuesta->getUsuario()->getRoles()[0] == 'ROLE_PROFE'){
                                $tipoPregunta = 'PROFESOR_EXTERNO';
                             }
                             else if($encuesta->getUsuario()->getRoles()[0] == 'ROLE_PROFI'){
                                $tipoPregunta = 'PROFESOR_INTERNO';
                             }
                             else if($encuesta->getUsuario()->getRoles()[0] == 'ROLE_ALU'){
                                $tipoPregunta = 'ALUMNO';
                             }
                             else { $tipoPregunta = 'PROFESOR_INTERNO'; }
                             $preguntas = $rep->findByTipo(['tipo' => $tipoPregunta ]);

                             foreach ($preguntas as $key => $value) {
                                $encPre = new EncuestaPregunta();
                                $encPre->setEncuesta($encuesta);
                                $encPre->setPregunta($value);
                                $encuesta->addEncuestapregunta($encPre);
                             }
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
    public function mostrarEncuestasAsignadasAction(){

        try{
            $usuario = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Encuesta');
            $encuestasAsignadas = $rep->findByUsuario($usuario->getId());
           if(count( $encuestasAsignadas) > 0){
                return $this->render('Encuesta/mostrar_encuestas_asignadas.html.twig', array('encuestasAsignadas'=>$encuestasAsignadas ));
           }
           else{
                  return $this->render('Encuesta/mostrar_encuestas_asignadas.html.twig', array('sinEncuestas'=>"sinEncuestas" ));
           }

        } catch (Exception $ex) {
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
            return $this->render('Encuesta/mostrar_encuestas_asignadas.html.twig', array('encuestasAsignadas'=>$encuestasAsignadas ));
    }

    public function insertarDatosEncuestaAction(Request $request, $idEncuesta){
        echo "<pre>"; print_r($request);  echo "</pre>"; die();
   /*     try{
            $usuario = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Encuesta');
            $encuestasAsignadas = $rep->findByUsuario($usuario->getId());
           if(count( $encuestasAsignadas) > 0){
                return $this->render('Encuesta/mostrar_encuestas_asignadas.html.twig', array('encuestasAsignadas'=>$encuestasAsignadas ));
           }
           else{
                  return $this->render('Encuesta/mostrar_encuestas_asignadas.html.twig', array('sinEncuestas'=>"sinEncuestas" ));
           }

        } catch (Exception $ex) {
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }*/
            return $this->render('Encuesta/mostrar_encuestas_asignadas.html.twig', array('encuestasAsignadas'=>$encuestasAsignadas ));
    }

    public function realizarEncuestaAction($idEncuesta){

        try{

            $usuario = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Encuesta');
            $encuesta = $rep->find($idEncuesta);

            if($encuesta){
                if($encuesta->getUsuario()->getId() == $usuario->getId()){
                    $encuPregs = $encuesta->getEncuestapregunta();
                    return $this->render('Encuesta/realizar_encuesta.html.twig', array('encuPregs'=>$encuPregs ));
                }
            }else{
                $this->addFlash('danger', 'No tiene encuestas asignadas' );
            }
            $rep = $em->getRepository('AppBundle:Encuesta');
            $encuestasAsignadas = $rep->findByUsuario($usuario->getId());

        } catch (Exception $ex) {
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
            return $this->render('Encuesta/mostrar_encuestas_asignadas.html.twig', array('encuestasAsignadas'=>$encuestasAsignadas ));


    }

/*
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
*/
}
