<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Curso;
class CursoController extends Controller
{
   public function crearCursoAction(Request $request){

        try{
            $curso = new Curso();
            $form = $this->createForm(\AppBundle\Form\CursoType::class, $curso);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Curso');



            $idUltimoCurso = $rep->getIdUltimoCurso();//ultimo antes del nuevo


            if($form->isSubmitted() && $form->isValid()){

                $em = $this->getDoctrine()->getManager();

                //Copio las preguntas del año anterior
                $c = $rep->find($idUltimoCurso);
                $preguntas = $c->getPreguntas();
                foreach ($preguntas as $key => $value) {
                  $curso->addPregunta($value);
                }

                $em->persist($curso);
                $em->flush();
                if($curso->getActivo()){
                    $rep->desactivarOtrosCursos($curso->getId());
                    $session = $request->getSession();
                    $session->set('cursoActivo', $curso->getDescripcion());
                }



                $this->addFlash('success', 'Registro creado correctamente' );

            }
        }catch (Exception $ex) {
                $this->addFlash('danger', 'Error al crear el registro' );
                echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
        $cursos = $rep->findAll();
        return $this->render('Curso/crear_curso.html.twig', array('form' => $form->createView(), 'cursos'=>$cursos ));
    }

public function editarCursoAction(Request $request, $idCurso){

  try{
   $m = $this->getDoctrine()->getManager();
   $curso = $m->getRepository('AppBundle:Curso')->find($idCurso);

   $form = $this->createForm(\AppBundle\Form\CursoType::class, $curso);
   $form->handleRequest($request);
   $rep = $m->getRepository('AppBundle:Curso');

   if($form->isSubmitted() && $form->isValid()){
        $curso = $form->getData();
        $man = $this->getDoctrine()->getManager();
        $man->persist($curso);
        $man->flush();
        if($curso->getActivo()){
             $rep->desactivarOtrosCursos($curso->getId());
              $session = $request->getSession();
              $session->set('cursoActivo', $curso->getDescripcion());
        }
        $this->addFlash('success', 'Registro modificado correctamente' );

        return $this->redirectToRoute('crear_curso');
   }
    $rep = $m->getRepository('AppBundle:Curso');
    $cursos = $rep->findAll();
  }
  catch(Excepcition $ex){
   echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
  }
  return $this->render('Curso/editar_curso.html.twig', array('form' => $form->createView(), 'cursos'=>$cursos) );
 }

    public function eliminarCursoAction(Request $request, $idCurso){
        try{
            $m = $this->getDoctrine()->getManager();
            $curso = $m->getRepository('AppBundle:Curso')->find($idCurso);
            if(!$curso){
                throw $this->createNotFoundException('El curso con id: '.$idCurso.' no existe.');
            }
//            $idLogado = $this->getuser()->getId();
             if( in_array("ROLE_ADMIN", $this->getuser()->getRoles(), FALSE) ){
                if($curso->getActivo()){
                    $this->addFlash('danger', 'No puede eliminar el curso activo' );
                }
                else{

                  $encuesta = $m->getRepository('AppBundle:Encuesta')->findOneByCurso($curso->getId());
                  if(isset($encuesta)){
                      $this->addFlash('danger', 'No puede eliminar el curso por que se han realizado encuestas' );
                  }else{
                    $m->remove($curso);
                    $m->flush();
                    $this->addFlash('success', 'Registro eliminado correctamente' );
                  }

                }
             }

        //     $_SERVER['PHP_SELF']
      //        $request = $this->container->get('request'); $routeName = $request->get('_route');  die($this->get('kernel')->getRootDir());
            return $this->redirectToRoute('crear_curso');
        }
        catch (Exception $ex) {
            $this->addFlash('danger', 'Error al eliminar el registro' );
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
    }

    public function mostrarCursosAction(){

        try{
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Curso');
            $cursos = $rep->findAll();

        } catch (Exception $ex) {
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
        return $this->render('Curso/mostrar_cursos.html.twig', array('cursos'=>$cursos ));


    }

}
