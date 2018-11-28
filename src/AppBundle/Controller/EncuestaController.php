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
                    $rolUsuario = $encuesta->getUsuario()->getRoles()[0];
                    $rolEvaluado = $encuesta->getEvaluado()->getRoles()[0];
            	   if($encuesta->getEvaluado() != $encuesta->getUsuario() ){

                    if(
                        ($rolUsuario == 'ROLE_ALU' && ($rolEvaluado == 'ROLE_PROFI' || $rolEvaluado == 'ROLE_PROFE') ) ||
                        ($rolUsuario == 'ROLE_PROFI' && ($rolEvaluado == 'ROLE_ALU' ) )  ||
                        ($rolUsuario == 'ROLE_PROFE' && ($rolEvaluado == 'ROLE_ALU' ) )
                    ){

	            	   $na = $encuesta->getEvaluado()->getNombre().' '.$encuesta->getEvaluado()->getApellidos() ;
	            	   $encuesta->setNaevaluado($na);
	            	   $rep = $em->getRepository('AppBundle:Curso');
	                $cursoActivo = $rep->findBy(	array('activo' => 1));
	                $cursoActivo[0]->addTitulacion($encuesta->getTitulacion());

                             $rep = $em->getRepository('AppBundle:Pregunta');
                             if($encuesta->getEvaluado()->getRoles()[0] == 'ROLE_PROFE'){
                                $tipoPregunta = 'PROFESOR_EXTERNO';
                             }
                             else if($encuesta->getEvaluado()->getRoles()[0] == 'ROLE_PROFI'){
                                $tipoPregunta = 'PROFESOR_INTERNO';
                             }
                             else if($encuesta->getEvaluado()->getRoles()[0] == 'ROLE_ALU'){
                                $tipoPregunta = 'ALUMNO';
                             }
                             else { $tipoPregunta = 'PROFESOR_INTERNO'; }

                             $preguntas = $rep->findByTipo(['tipo' => $tipoPregunta ]);
                        //      echo $tipoPregunta;  echo count($preguntas ); die("jdgiu");
                             foreach ($preguntas as $key => $value) {

                                $encPre = new EncuestaPregunta();
                                $encPre->setEncuesta($encuesta);
                                $encPre->setPregunta($value);
                                $encuesta->addEncuestapregunta($encPre);
                             }
                            $em->persist($encuesta);
                            $em->flush();
                            $this->addFlash('success', 'Registro creado correctamente' );
                    }
                        else { $this->addFlash('danger', 'Este tipo usuario no puede realizar esa encuesta' ); }

                }
 	  else { $this->addFlash('danger', 'Un usuario no puede evaluarse así mismo' ); }
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
            $this->addFlash('danger', 'Error al eliminar el registro' );
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

        try{
            $usuario = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Encuesta');
            $encuestasAsignadas = $rep->findByUsuario($usuario->getId());
            $encuesta = $em->getRepository('AppBundle:Encuesta')->find($idEncuesta);

            if( $encuesta->getCompletada() == 'NO' && $encuesta->getUsuario()->getId() == $usuario->getId()){

                    $respuestas = $request->request; //devuelve tipo parameterbag
                    $respuestas = $respuestas->all();
                     $encuPreg = $em->getRepository('AppBundle:EncuestaPregunta')->findBy(  array('encuesta' => $idEncuesta) );

                     if( count($encuPreg) == count($respuestas)){

                            foreach ($encuPreg as $key => $value) {

                                $resultado = $em->getRepository('AppBundle:Resultado')->findOneBy(  array('valor' => $respuestas[$value->getPregunta()->getId()]) );
                                $value->setResultado($resultado);
                                $em->persist($value);
                                $em->flush();
                            }

                            $encuesta->setCompletada('SI');
                            $em->persist($encuesta);
                            $em->flush();

                            $mediaTotal = $em->getRepository('AppBundle:Usuario')->calcularMediaTotal($encuesta->getEvaluado()->getId());
                            $evaluado    = $em->getRepository('AppBundle:Usuario')->find($encuesta->getEvaluado()->getId());
                            $evaluado->setMedia($mediaTotal[0]['media']);
                            $em->persist($evaluado);
                            $em->flush();
                     }
                     else{
                          $this->addFlash('danger', 'No se han respondido todas las preguntas' );
                     }
            }
            else{
                $this->addFlash('danger', 'No puede realizar esta encuesta' );
            }


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

    public function realizarEncuestaAction($idEncuesta){

        try{
            $usuario = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Encuesta');
            $encuesta = $rep->find($idEncuesta);

            $rep = $em->getRepository('AppBundle:Encuesta');
            $encuestasAsignadas = $rep->findByUsuario($usuario->getId());

            if($encuesta){
                if($encuesta->getUsuario()->getId() == $usuario->getId()){
                    if($encuesta->getCompletada() == 'NO'){
                        $encuPregs = $encuesta->getEncuestapregunta();
                  //      dump($encuPregs); die();
                      //  echo count($encuPregs); die();
                        if(count($encuPregs) == 0){
                            $this->addFlash('danger', 'Esta encuesta no tiene preguntas asignadas' );
                            return $this->render('Encuesta/mostrar_encuestas_asignadas.html.twig', array('encuestasAsignadas'=>$encuestasAsignadas ));
                        }
                        return $this->render('Encuesta/realizar_encuesta.html.twig', array('encuPregs'=>$encuPregs ));
                    }
                    else{ $this->addFlash('danger', 'Esta encuesta ya ha sido completada' ); }
                }
                else{
                    $this->addFlash('danger', 'Esta encuesta no le ha sido asignada' );
                }
            }else{
                $this->addFlash('danger', 'No existe esa encuesta asignadas' );
            }


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
