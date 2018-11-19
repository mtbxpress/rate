<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
class EncuestaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('evaluado',EntityType::class, array(
                'class'=> 'AppBundle:Usuario',
                'label'=> 'usuario.evaluado',
                'placeholder' => '' ,
                //'choice_label'=> 'username'
                'choice_label' => function ($usuario) {
                        $strOption=$usuario->getNombre();
                    //    if ($usuario->getNombre()) {
                    //      $strOption.='  '.$usuario->getNombre();
                          if ($usuario->getApellidos()) {
                            $strOption.=' '.$usuario->getApellidos();
                          }
                    //    }
                        return $strOption;
                      }
            ))
            ->add('titulacion',EntityType::class, array(
                'class'=> 'AppBundle:Titulacion',
                'label'=> 'Titulacion',
                'placeholder' => '' ,
                'choice_label'=> 'nombre'
            ))
            ->add('usuario',EntityType::class, array(
                'class'=> 'AppBundle:Usuario',
                'label'=> 'usuario.usuario',
                'placeholder' => '' ,
                'choice_label' => function ($usuario) {
                        $strOption=$usuario->getNombre();
              //          if ($usuario->getNombre()) {
              //            $strOption.=' - '.$usuario->getNombre();
                          if ($usuario->getApellidos()) {
                            $strOption.=' '.$usuario->getApellidos();
                          }
             //           }
                        return $strOption;
                      }
            ))
            ->add('reset',ResetType::class, array('attr' => array( 'class' => 'btn btn-success'  )))
            ->add('aceptar',SubmitType::class, array('attr' => array( 'class' => 'btn btn-primary'  )));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Encuesta'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_encuesta';
    }


}
