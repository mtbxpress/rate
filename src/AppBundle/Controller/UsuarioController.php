<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Usuario;
use AppBundle\Entity\RolSistema;
use AppBundle\Repository\UsuarioRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

        } catch (Exception $ex) {
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
//dump($usuarios[0]);die();
        return $this->render('Usuario/mostrar_usuarios.html.twig', array('usuarios'=>$usuarios ));
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
