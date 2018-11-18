<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Config\Definition\Exception\Exception;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\RolSistema;
use AppBundle\Repository\UsuarioRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use AppBundle\Form\UsuarioType;


use AppBundle\Entity\Encuesta;
use AppBundle\Entity\Resultado;

/**
 * Lógica de todas las pantallas relacionadas con el apartado de usuarios.
 */
class UsuarioController extends Controller
{

    /**
     * Lógica de la pantalla donde se muestra todos los usuarios permitiendo hacer búsquedas.
     * @return Response HTML
     */

    public function mostrarUsuariosAction(Request $request){
        try{
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Usuario');
            $usuarios = $rep->findAll();
            $usuarios = $rep->mostarUsuariosCursoActivo();
        } catch (Exception $ex) {
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
//dump($usuarios[0]);die();
        return $this->render('Usuario/mostrar_usuarios.html.twig', array('usuarios'=>$usuarios ));
    }

    public function mostrarUsuarioAction(Request $request, $idUsuario){
        try{
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Usuario');
     //       $usuario = $rep->find($idUsuario);
            $usuario = $rep->mostarUsuarioCursoActivo($idUsuario);

        } catch (Exception $ex) {
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
        if(!$usuario){
            $usuarios = $rep->mostarUsuariosCursoActivo();
           return $this->render('Usuario/mostrar_usuarios.html.twig', array('usuarios'=>$usuarios ));
        }
        return $this->render('Usuario/mostrar_usuario.html.twig', array('usuario'=>$usuario ));
    }
    public function crearUsuarioAction(Request $request, ValidatorInterface $validator, UserPasswordEncoderInterface $passwordEncoder){
        try{

            $usuario = new Usuario();
            $errors = $validator->validate($usuario);
            $usuario->setFechaAlta(new \DateTime());
            $form = $this->createForm(UsuarioType::class, $usuario);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $roles = $request->request->get('roles');
                $usuario->setRoles($roles);
                $passNoCodificada = $usuario->getPassword();
                //Codificamos la contraseña antes de guardarla
                $password = $passwordEncoder->encodePassword($usuario, $usuario->getPassword());
                $usuario->setPassword($password);
                $em = $this->getDoctrine()->getManager();
                $em->persist($usuario);
                $em->flush();

             /*   $message = (new \Swift_Message("Envío de Password"))
                    ->setFrom('gestorofertas2018@gmail.com')
                     ->setTo($usuario->getEmail())
                    ->setBody(
                        $this->renderView(
                            '@App/emails/plantilla_envio_password.html.twig',
                             array('pass' => $passNoCodificada)
                            ),
                            'text/html'
                        );

            $res = $mailer->send($message);

            if($res > 0){
                $this->addFlash('info', 'Se ha enviado la contraseña del usuario a su email' );
            }
            */
                $this->addFlash('success', 'Registro creado correctamente' );
                $usuario = new Usuario();
                $form = $this->createForm(UsuarioType::class, $usuario);
            return $this->render('Usuario/crear_usuario.html.twig', array('form' => $form->createView() ));
            }
        }
    catch (Exception $ex) {
        echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
    }

        return $this->render('Usuario/crear_usuario.html.twig', array('form' => $form->createView() ));
    }

 public function editarUsuarioAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, ValidatorInterface $validator, $idUsuario){

  try{
   $m = $this->getDoctrine()->getManager();
   $usuario = $m->getRepository('AppBundle:Usuario')->find($idUsuario);

   $form = $this->createForm(UsuarioType::class, $usuario);
   $form->handleRequest($request);

   if($form->isSubmitted() && $form->isValid()){
    $roles = $request->request->get('roles');
    $usuario->setRoles($roles);
                          $password = $passwordEncoder->encodePassword($usuario, $usuario->getPassword());
                          $usuario->setPassword($password);
    $usuario = $form->getData();

    $man = $this->getDoctrine()->getManager();
    $man->persist($usuario);
    $man->flush();
    $this->addFlash('success', 'Registro modificado correctamente' );

    return $this->redirectToRoute('mostrar_usuarios');
   }

  }
  catch(Excepcition $ex){
   echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
  }
  return $this->render('Usuario/editar_usuario.html.twig', array('form' => $form->createView()));
 }

    public function eliminarUsuarioAction($idUsuario){

        try{
            $m = $this->getDoctrine()->getManager();
            $usuario = $m->getRepository('AppBundle:Usuario')->find($idUsuario);
            if(!$usuario){
                throw $this->createNotFoundException('El usuario con id: '.$idUsuario.' no existe.');
            }
            $idLogado = $this->getuser()->getId();
            if($idLogado != $usuario->getId()){
                $m->remove($usuario);
                $m->flush();
                        $this->addFlash('success', 'Registro eliminado correctamente' );
             }
             else{
                $this->addFlash('danger', 'No puede eliminarse así mismo' );
             }
            return $this->redirectToRoute('mostrar_usuarios');
        }
        catch (Exception $ex) {
            $this->addFlash('danger', 'Registro no se ha eliminado correctamente' );
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
    }
    /**
     * Busca usuarios según una letra
     * @return Response HTML
     */

    public function buscaUsarioLetraAction(Request $request, $letra){
        try{
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Usuario');
            $usuarios = $rep->buscaUsarioLetra($letra);

        } catch (Exception $ex) {
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
        return $this->render('Usuario/mostrar_usuarios.html.twig', array('usuarios'=>$usuarios ));
    }

    /**
     * Busca usuarios según una letra
     * @return Response HTML
     */

    public function busquedaGeneralAction(Request $request){
        try{

            $palabraBuscar = $request->query->get('busqueda');
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Usuario');
            $usuarios = $rep->busquedaGeneral($palabraBuscar);

        } catch (Exception $ex) {
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
        return $this->render('Usuario/mostrar_usuarios.html.twig', array('usuarios'=>$usuarios ));
    }
/*##############################################################################*/
    /**
     * Lógica de la pantalla donde se muestra todos los usuarios permitiendo hacer búsquedas.
     * @return Response HTML
     */

    public function lista_usuariosAction(Request $request){
        try{
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Usuario');
            $usuarios = $rep->findAll();

        } catch (Exception $ex) {
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }

        return $this->render('@App/Usuarios/lista_usuarios.html.twig', array('usuarios'=>$usuarios ));
    }

    /**
     * Lógica de la pantalla para crear un nuevo usuario
     * @return Response HTML
     */

    public function nuevo_usuarioAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, ValidatorInterface $validator){
        $usuario = new Usuario();
        $errors = $validator->validate($usuario);
        // Valores por defecto
        $usuario->setActivo(true);
        //Fecha de alta será la fecha actual
        $usuario->setFechaAlta(new \DateTime());
        $form = $this->createForm(\AppBundle\Form\UsuarioType::class, $usuario)
                ->add('save',SubmitType::class);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            //Codificamos la contraseña antes de guardarla
            $password = $passwordEncoder->encodePassword($usuario, $usuario->getPassword());
            $usuario->setPassword($password);
            //
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();


            return $this->redirectToRoute('lista_usuarios');
        }
        return $this->render('@App/Usuarios/nuevo_usuario.html.twig', array('form' => $form->createView() ));
    }

    /**
     * Lógica de la pantalla que muestra la ficha de un usuario.
     * @param  Request $request
     * @param  int  $usuario_id
     * @return Response HTML
     */

    public function ver_usuarioAction($idUsuario){

	try{
            $m = $this->getDoctrine()->getManager();
            $rep = $m->getRepository('AppBundle:Usuario');
            $usuario = $rep->find($idUsuario);

                return $this->render('@App/Usuarios/ver_usuario.html.twig',
                    array('usuario'  => $usuario));
        }
        catch (Exception $ex) {
            echo 'Excepción capturada: Ver usuario:',  $ex->getMessage(), "\n";
	}

        return $this->render('@App/Usuarios/ver_usuario.html.twig');
    }

    /**
     * Lógica de la pantalla que posibilita editar los datos de un usuario.
     * @param  Request $request
     * @param  int  $usuario_id
     * @return Response HTML
     */
    public function editar_usuarioAction(Request $request, $idUsuario, UserPasswordEncoderInterface $passwordEncoder)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Usuario');
        $usuario = $repository->find($idUsuario);

        $form = $this->createForm(\AppBundle\Form\UsuarioType::class, $usuario)
            ->add('fechaAlta',DateType::class)
            ->add('fechaBaja',DateType::class)
            ->add('activo',CheckboxType::class, array(
                'label'=>'Activo',
                'required'=> false
            ))
            ->add('save',SubmitType::class);

        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                //Codificamos la contraseña antes de guardarla
                $password = $passwordEncoder->encodePassword($usuario, $usuario->getPassword());
                $usuario->setPassword($password);
                //
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                return $this->redirectToRoute('lista_usuarios');
            }

        return $this->render('@App/Usuarios/editar_usuario.html.twig', array('form' => $form->createView(), 'usuario' => $usuario, 'idUsuario' => $idUsuario));
    }


}
