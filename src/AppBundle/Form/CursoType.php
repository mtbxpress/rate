<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
class CursoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion', TextType::class, array('required' => true, 'label' => 'Descripcion'))
            ->add('activo')
            ->add('reset',ResetType::class, array('attr' => array( 'class' => 'btn btn-success'  )))
            ->add('aceptar',SubmitType::class, array('attr' => array( 'class' => 'btn btn-primary'  )));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Curso'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_curso';
    }


}
         /*   ->add('empresaID',EntityType::class, array(
                'required' => true,
                'label' => 'Empresa',
                    'class' => 'AppBundle:Empresa',
                        'query_builder' => function(EntityRepository $er){
                            return $er->createQueryBuilder('u');
                        },
                        'choice_label'=> 'getNombreEmpresa',
                        'placeholder' => 'Seleccione una empresa',
            )) */