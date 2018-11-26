<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Pregunta;
use AppBundle\Entity\EncuestaPregunta;
class PreguntaController extends Controller
{

    public function crearPreguntaAction(Request $request){

        try{

            $pregunta = new Pregunta();
            $form = $this->createForm(\AppBundle\Form\PreguntaType::class, $pregunta);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();

            if($form->isSubmitted() && $form->isValid()){
                $tipo = $request->request->get('tipo');
                $em = $this->getDoctrine()->getManager();
                $pregunta->setTipo($tipo);
                $em->persist($pregunta);
                $em->flush();
                if($tipo == 'ALUMNO'){
                  $role = 'ROLE_ALU';
                }
                else if($tipo == 'PROFESOR_INTERNO'){
                   $role = 'ROLE_PROFI';
                }
                else if($tipo == 'PROFESOR_EXTERNO'){
                   $role = 'ROLE_PROFE';
                }
                //Asigno a todas las encuestas segun el tipo, la nueva pregunta
          //       $em = $this->getDoctrine()->getManager();
             //    $encuestas = $em->getRepository('AppBundle:Encuesta')->obtenerEncuestasSegunRol($role);
                  $encuestas = $em->getRepository('AppBundle:Encuesta')->findAll();
                 if($encuestas){
                     foreach ($encuestas as $key => $value) {
                          if($value->getEvaluado()->getRoles()[0]  == $role  ){
                                $encuestapregunta =  new EncuestaPregunta();
                                 $encuestapregunta->setEncuesta($value);
                                 $encuestapregunta->setPregunta($pregunta);
                                 $em->persist($encuestapregunta);
                                 $em->flush();
                         }
                     }
                }
                $this->addFlash('success', 'Registro creado correctamente' );
            }
        }catch (Exception $ex) {
                $this->addFlash('danger', 'Error al crear el registro' );
                echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }

            $rep = $em->getRepository('AppBundle:Pregunta');
            $preguntas = $rep->findAll();
        return $this->render('Pregunta/crear_pregunta.html.twig', array('form' => $form->createView(), 'preguntas'=>$preguntas ));
    }

public function editarPreguntaAction(Request $request, $idPregunta){

  try{
   $m = $this->getDoctrine()->getManager();
   $pregunta = $m->getRepository('AppBundle:Pregunta')->find($idPregunta);
   $tipo = $pregunta->getTipo();
   $form = $this->createForm(\AppBundle\Form\PreguntaType::class, $pregunta);
   $form->handleRequest($request);

   if($form->isSubmitted() && $form->isValid()){
        $tipo = $request->request->get('tipo');
        $pregunta = $form->getData();
        $pregunta->setTipo($tipo);
        $man = $this->getDoctrine()->getManager();
        $man->persist($pregunta);
        $man->flush();
        $this->addFlash('success', 'Registro modificado correctamente' );

      //  return $this->render('Pregunta/editar_pregunta.html.twig', array('form' => $form->createView(), 'titulaciones'=>$preguntas) );
        return $this->redirectToRoute('mostrar_preguntas');
   }

  }
  catch(Excepcition $ex){
    $this->addFlash('danger', 'Error al modificar el registro' );
   echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
  }
    $rep = $m->getRepository('AppBundle:Pregunta');
   $preguntas = $rep->findAll();
  return $this->render('Pregunta/editar_pregunta.html.twig', array('form' => $form->createView(), 'preguntas'=>$preguntas, 'tipo' => $pregunta->getTipo()  ) );
 }

    public function mostrarPreguntasAction(Request $request){
        try{
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Pregunta');
            $preguntas = $rep->findAll();

        } catch (Exception $ex) {
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
//dump($usuarios[0]);die();
        return $this->render('Pregunta/mostrar_preguntas.html.twig', array('preguntas'=>$preguntas ));
    }

    public function eliminarPreguntaAction(Request $request, $idPregunta){
        try{
            $m = $this->getDoctrine()->getManager();
            $pregunta = $m->getRepository('AppBundle:Pregunta')->find($idPregunta);
            if(!$pregunta){
                throw $this->createNotFoundException('La pregunta con id: '.$idPregunta.' no existe.');
            }
//            $idLogado = $this->getuser()->getId();
             if( in_array("ROLE_ADMIN", $this->getuser()->getRoles(), FALSE) ){

                $m = $this->getDoctrine()->getManager();
               $encuestapreguntas = $m->getRepository('AppBundle:EncuestaPregunta')->findByPregunta($idPregunta);

               if($encuestapreguntas){
                    foreach ($encuestapreguntas as $key => $encpreg) {
                        $m->remove($encpreg);
                        $m->flush();
                     }
              }
                $m->remove($pregunta);
                $m->flush();
                $this->addFlash('success', 'Registro eliminado correctamente' );
             }

        //     $_SERVER['PHP_SELF']
      //        $request = $this->container->get('request'); $routeName = $request->get('_route');  die($this->get('kernel')->getRootDir());
            return $this->redirectToRoute('mostrar_preguntas');
        }
        catch (Exception $ex) {
            $this->addFlash('danger', 'Error al eliminar el registro' );
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
    }

}

