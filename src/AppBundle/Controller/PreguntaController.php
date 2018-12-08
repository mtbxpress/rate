<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Pregunta;
use AppBundle\Entity\EncuestaPregunta;
use AppBundle\Entity\Curso;
class PreguntaController extends Controller
{
   public function crearPreguntaAction(Request $request){

        try{
           $em = $this->getDoctrine()->getManager();
           $curso = $em->getRepository('AppBundle:Curso')->findByActivo(1);

            $pregunta = new Pregunta();

            $form = $this->createForm(\AppBundle\Form\PreguntaType::class, $pregunta);
            $form->handleRequest($request);


            if($form->isSubmitted() && $form->isValid()){

                $tipo = $request->request->get('tipo');
                if($tipo == 'ALUMNO'){
                  $role = 'ROLE_ALU';
                }
                else if($tipo == 'PROFESOR_INTERNO'){
                   $role = 'ROLE_PROFI';
                }
                else if($tipo == 'PROFESOR_EXTERNO'){
                   $role = 'ROLE_PROFE';
                }
                $existeEncuestaCompleta = $em->getRepository('AppBundle:Pregunta')->comprobarSiexisteEncuestaCompleta($role);

            if(!isset($existeEncuestaCompleta['id'])){

                $pregunta->setTipo($tipo);

                $pregunta->addCurso($curso[0]);
                $curso[0]->addPregunta($pregunta);

                $em->persist($pregunta);
                $em->persist($curso[0]);
                $em->flush();

                //Asigno a todas las encuestas segun el tipo, la nueva pregunta
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
              else{
                $this->addFlash('danger', 'No puede crear una pregunta por que ya se ha completado alguna encuesta' );
              }
            }
        }catch (Exception $ex) {
                $this->addFlash('danger', 'Error al crear el registro' );
                echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }

            $rep = $em->getRepository('AppBundle:Pregunta');
            $preguntas = $rep->obtenerPreguntasCursoActivo();
        return $this->render('Pregunta/crear_pregunta.html.twig', array('form' => $form->createView(), 'preguntas'=>$preguntas ));
    }
/*    public function crearPreguntaAction(Request $request){

        try{

            $pregunta = new Pregunta();
            $form = $this->createForm(\AppBundle\Form\PreguntaType::class, $pregunta);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();

            if($form->isSubmitted() && $form->isValid()){

                $tipo = $request->request->get('tipo');
                if($tipo == 'ALUMNO'){
                  $role = 'ROLE_ALU';
                }
                else if($tipo == 'PROFESOR_INTERNO'){
                   $role = 'ROLE_PROFI';
                }
                else if($tipo == 'PROFESOR_EXTERNO'){
                   $role = 'ROLE_PROFE';
                }
                $existeEncuestaCompleta = $em->getRepository('AppBundle:Pregunta')->comprobarSiexisteEncuestaCompleta($role);

            if(!isset($existeEncuestaCompleta['id'])){

                $pregunta->setTipo($tipo);
                $em->persist($pregunta);
                $em->flush();

                //Asigno a todas las encuestas segun el tipo, la nueva pregunta
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
              else{
                $this->addFlash('danger', 'No puede crear una pregunta por que ya se ha completado alguna encuesta' );
              }
            }
        }catch (Exception $ex) {
                $this->addFlash('danger', 'Error al crear el registro' );
                echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }

            $rep = $em->getRepository('AppBundle:Pregunta');
            $preguntas = $rep->findAll();
        return $this->render('Pregunta/crear_pregunta.html.twig', array('form' => $form->createView(), 'preguntas'=>$preguntas ));
    }
*/
public function editarPreguntaAction(Request $request, $idPregunta){

  try{
   $m = $this->getDoctrine()->getManager();
   $pregunta = $m->getRepository('AppBundle:Pregunta')->find($idPregunta);
   $tipoOriginal = $pregunta->getTipo();
   $form = $this->createForm(\AppBundle\Form\PreguntaType::class, $pregunta);
   $form->handleRequest($request);

   if($form->isSubmitted() && $form->isValid()){
        $pregunta = $form->getData();
        $tipo = $request->request->get('tipo');
        if($tipo == '' || $tipo == null){
            $pregunta->setTipo($tipoOriginal);
        }else{
          $pregunta->setTipo($tipo);
        }


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
   $preguntas = $rep->obtenerPreguntasCursoActivo();
  return $this->render('Pregunta/editar_pregunta.html.twig', array('form' => $form->createView(), 'preguntas'=>$preguntas, 'tipo' => $pregunta->getTipo()  ) );
 }

    public function mostrarPreguntasAction(Request $request){
        try{
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Pregunta');
      //      $preguntas = $rep->findAll();
            $preguntas = $rep->obtenerPreguntasCursoActivo();
//echo "<pre>"; print_r($preguntas);  echo "</pre>"; die();
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

             if( in_array("ROLE_ADMIN", $this->getuser()->getRoles(), FALSE) ){

               $m = $this->getDoctrine()->getManager();

                $tipo = $pregunta->getTipo();
                if($tipo == 'ALUMNO'){
                  $role = 'ROLE_ALU';
                }
                else if($tipo == 'PROFESOR_INTERNO'){
                   $role = 'ROLE_PROFI';
                }
                else if($tipo == 'PROFESOR_EXTERNO'){
                   $role = 'ROLE_PROFE';
                }
               $encuestapreguntas = $m->getRepository('AppBundle:Pregunta')->comprobarSiexisteEncuestaCompleta($role);

              if($encuestapreguntas){
                $this->addFlash('danger', 'eliminar.pregunta.encuesta.asignada' );

              }
              else{
                 $encpregs = $m->getRepository('AppBundle:EncuestaPregunta')->findBy(array('pregunta' => $pregunta));
            //     dump($encpreg); echo $pregunta->getId(); die();
                 foreach ($encpregs as $key => $value) {
                    $m->remove($value);
                 }
                  $m->remove($pregunta);
                  $m->flush();
                  $this->addFlash('success', 'Registro eliminado correctamente' );
               }
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

