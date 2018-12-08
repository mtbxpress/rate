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

use AppBundle\Entity\Curso;
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

    public function mostrarUsuariosAction(Request $request, $m){
        try{
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Usuario');
            $usuarios = $rep->findAll();
            if($m == 1){
                $usuarios = $rep->mostarUsuariosConCursoActivo();
            }
            else if($m == 2){
                $usuarios = $rep->mostarUsuariosConEncuestasEnCursoActivo();
            }
        } catch (Exception $ex) {
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
//dump($usuarios[0]);die();
        return $this->render('Usuario/mostrar_usuarios.html.twig', array('usuarios'=>$usuarios ));
    }

    public function mostrarUsuarioAction(Request $request, $idUsuario){
        try{
            $usuarioLogado = $this->getuser();
            if($usuarioLogado->getRoles()[0] != 'ROLE_ADMIN' && $usuarioLogado->getId() != $idUsuario){
                $this->addFlash('danger', 'No tiene permiso para ver ese perfil' );
                return $this->render('Inicio/inicio.html.twig');
            }
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Usuario');
            $medias = $rep->calcularMedias($idUsuario);

            $usuario = $rep->mostarUsuarioEncuestaConCursoActivo($idUsuario);

            if(!isset($usuario) ){
                $usuario = $rep->mostarUsuarioCursoActivo($idUsuario);
            }

            if(isset($usuario) ){
         //       $encsDelUsuarioEvaluado = $em->getRepository('AppBundle:Encuesta')->findByEvaluado($usuario);
                $encsDelUsuarioEvaluado = $em->getRepository('AppBundle:Encuesta')->obtenerEncuestasCursoActivoEvaluado($usuario['id']);
                $resultados = 0;
//dump($encsDelUsuarioEvaluado);die();
                foreach ($encsDelUsuarioEvaluado as $key => $value) {
                    if($value['completada'] == 'SI'){
                        $encResultados[$value['id']] = $em->getRepository('AppBundle:EncuestaPregunta')->findByEncuesta($value['id']);
                    }
                }

                if(isset($encResultados)){
                    foreach ($encResultados as $key => $value) {
                              if( $value  != null ){
                                      $resultados = 1;
                              }
                    }
                }

                if( $resultados == 0){
                    $encResultados = 1; // con encuesta asignada pero sin completar
                }

                return $this->render('Usuario/mostrar_usuario.html.twig', array('usuario'=>$usuario, 'encResultados' => $encResultados ,'medias' => $medias));
            }
            $this->addFlash('danger', 'No esta inscrito en este curso' );
            return $this->render('Inicio/inicio.html.twig');
        } catch (Exception $ex) {
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
        if(!$usuario){
            $usuarios = $rep->mostarUsuariosConCursoActivo();
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
                $file= $form['avatar']->getData();
                if(!$file){
                    $usuario->setAvatar("avatar_default.jpeg");
                }
                else{
                    if($usuario->getAvatar() != '' && $usuario->getAvatar() !=null){
                        $subido = $this->subirImagenAction($form,$usuario);
                    }
                }
                $em = $this->getDoctrine()->getManager();

                $roles = $request->request->get('roles');
                $usuario->setRoles($roles);
                $passNoCodificada = $usuario->getPassword();
                //Codificamos la contraseña antes de guardarla
                $password = $passwordEncoder->encodePassword($usuario, $usuario->getPassword());
                $usuario->setPassword($password);


                $usuarioExiste =$em->getRepository('AppBundle:Usuario')->findByUsername($usuario->getusername());
                if(isset($usuarioExiste[0])){
                      $usuario = $em->getRepository('AppBundle:Usuario')->find($usuarioExiste[0]->getId());
                }
                $rep = $em->getRepository('AppBundle:Curso');
                $cursoActivo = $rep->findBy(array('activo' => true));
    //            echo $cursoActivo[0]->getId(); die();
   //             echo "<pre>"; print_r($cursoActivo[0]);  echo "</pre>";die("sldjh");
                $cursoActivo[0]->addUsuario($usuario);
                $usuario->addCurso($cursoActivo[0]);

                $em->persist($usuario);
                $em->persist($cursoActivo[0]);
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

    public function subirImagenAction($form,$usuario)   {
            // Recogemos el fichero
            $subido = false;
            $file= $form['avatar']->getData();  // OTRA FORMA DE OBTENER EL ELEMENTO DEL FORMULARIO
            if($file){  //$emp->setNombreEmpresa("Fujitsu")->getData();
                // Sacamos la extensión del fichero
                $ext=$file->guessExtension();

                // Le ponemos un nombre al fichero NO PUEDO PONER EN EL NOMBRE EL ID, POR QUE AUN NO SE HA CREADO $emp->getId(), SE CREA CUANDO SE INSRTA EN LA BD CON EL FLUSH
                $file_name="avatar_".$usuario->getUsername()."_".time().".".$ext;

                // Guardamos el fichero en el directorio uploads que estará en el directorio /web del framework
                $subido = $file->move("imagenes/avatares", $file_name);

                // Establecemos el nombre de fichero en el atributo de la entidad

                $usuario->setAvatar($file_name);
            }
            return $subido;
    }
 public function editarUsuarioAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, ValidatorInterface $validator, $idUsuario){

  try{
    $usuarioLogado = $this->getuser();
    if($usuarioLogado->getRoles()[0] != 'ROLE_ADMIN' && $usuarioLogado->getId() != $idUsuario){
        $this->addFlash('danger', 'No tiene permiso para editar ese usuario' );
        return $this->render('Inicio/inicio.html.twig');
    }
   $m = $this->getDoctrine()->getManager();
   $usuario = $m->getRepository('AppBundle:Usuario')->find($idUsuario);
   $avatarOriginal = $usuario->getAvatar();
   $rolOriginal = $usuario->getRoles();
   $form = $this->createForm(UsuarioType::class, $usuario);
   $form->handleRequest($request);

   if($form->isSubmitted() && $form->isValid()){
        $roles = $request->request->get('roles');
        if(!$roles){
            $usuario->setRoles($rolOriginal[0]);
        }else{
            $usuario->setRoles($roles);
        }

        $usuario = $form->getData();
        $password = $passwordEncoder->encodePassword($usuario, $usuario->getPassword());
        $usuario->setPassword($password);

//dump($usuario);die();
   //     if( $usuario->getAvatar() !=null){

            $subido = $this->subirImagenAction($form,$usuario);
            if( $subido && $avatarOriginal != 'avatar_default.jpeg' ){
                unlink('imagenes/avatares/'.$avatarOriginal);
            }
            if( !$subido ){
                $usuario->setAvatar($avatarOriginal);
            }
     //   }

        $man = $this->getDoctrine()->getManager();
        $man->persist($usuario);
        $man->flush();
        $this->addFlash('success', 'Registro modificado correctamente' );


        if($usuarioLogado->getRoles()[0] == 'ROLE_ADMIN'){
            return $this->redirectToRoute('mostrar_usuarios' , array('m' => 1));
        }
        else{
            return $this->redirectToRoute('editar_usuario' , array('idUsuario' => $usuarioLogado->getId()));
        }
   }

  }
  catch(Excepcition $ex){
   echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
  }
  return $this->render('Usuario/editar_usuario.html.twig', array('form' => $form->createView(),'usuario'=> $usuario));
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
                if( $usuario->getAvatar() != 'avatar_default.jpeg' ){
                     unlink('imagenes/avatares/'.$usuario->getAvatar());
                }
                $m->remove($usuario);
                $m->flush();
                        $this->addFlash('success', 'Registro eliminado correctamente' );
             }
             else{
                $this->addFlash('danger', 'No puede eliminarse así mismo' );
             }
            return $this->redirectToRoute('mostrar_usuarios', array('m' => 1));
        }
        catch (Exception $ex) {
            $this->addFlash('danger', 'Error al eliminar el registro' );
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
//echo count($usuarios); die("ñlkhf");
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

    public function mostrarEstadisticasAction(){
        try{
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Curso');
            $cursoActivo = $rep->findBy(array('activo' => true));

            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Usuario');
            $numUsuarios = $rep->calcularNumTiposUsuarios();
            $numEncuestas = $rep->calcularNumEncuestas($cursoActivo[0]->getId());
            $numEncCompletada = $rep->calcularNumEncuestasPorUsuarios($cursoActivo[0]->getId(),'SI');
            $numEncNoCompletada = $rep->calcularNumEncuestasPorUsuarios($cursoActivo[0]->getId(),'NO');
            $topAlu = $rep->calcularTopUsuarios('ROLE_ALU',5);
            $topProfi = $rep->calcularTopUsuarios('ROLE_PROFI',5);
            $topProfe = $rep->calcularTopUsuarios('ROLE_PROFE',5);

        } catch (Exception $ex) {
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }

        return $this->render('Estadistica/estadisticas.html.twig', array('numUsuarios' => $numUsuarios, 'numEncuestas' => $numEncuestas, 'numEncCompletada' => $numEncCompletada, 'numEncNoCompletada' => $numEncNoCompletada, 'topAlu' => $topAlu, 'topProfi' => $topProfi, 'topProfe' => $topProfe) );
    }

 /*  public function calcularMediasAction($idUsuario){
        try{

            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository('AppBundle:Usuario');
            $medias = $rep->calcularMedias($idUsuario);

        } catch (Exception $ex) {
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
        return $medias;
        //return $this->render('Usuario/mostrar_usuarios.html.twig', array('usuarios'=>$usuarios ));
    }*/




}
