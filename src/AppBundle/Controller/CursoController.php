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

            if($form->isSubmitted() && $form->isValid()){

                $em = $this->getDoctrine()->getManager();
                $em->persist($curso);
                $em->flush();
                if($curso->getActivo()){
                    $rep->desactivarOtrosCursos($curso->getId());
                }

                $this->addFlash('success', 'Registro creado correctamente' );
          //      $curso = new Curso();
                ///$form = $this->createForm(\AppBundle\Form\TitulacionType::class, $titulacion);
                //return $this->render('Titulacion/crear_titulacion.html.twig', array('form' => $form->createView() ));
            }
        }catch (Exception $ex) {
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

                $m->remove($curso);
                $m->flush();
                $this->addFlash('success', 'Registro eliminado correctamente' );
             }

        //     $_SERVER['PHP_SELF']
      //        $request = $this->container->get('request'); $routeName = $request->get('_route');  die($this->get('kernel')->getRootDir());
            return $this->redirectToRoute('crear_curso');
        }
        catch (Exception $ex) {
            $this->addFlash('danger', 'Registro no se ha eliminado correctamente' );
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
