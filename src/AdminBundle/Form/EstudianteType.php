<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EstudianteType extends AbstractType{
  /**
  * {@inheritdoc}
  */
  public function buildForm(FormBuilderInterface $builder, array $options){
    // Permite añadir componentes de fomulario a usar
    $builder
    ->add('nombre')
    ->add('email', EmailType::class)
    ->add('fechanac', DateTimeType::class, array('years'=>range(date('Y')-100, date('Y'))))
    ->add('edad')
    ->add('curso', EntityType::class, array(
            'class'=>'AdminBundle:Curso',
            'choice_label'=>'getDescripcion'))
    ->add('guardar', SubmitType::class);
  }

  /**
  * {@inheritdoc}
  */
  public function configureOptions(OptionsResolver $resolver){
    // Relaciona el formulario con la clase entidad
    $resolver->setDefaults(array(
      'data_class' => 'AdminBundle\Entity\Estudiante'
    ));
  }

  /**
  * {@inheritdoc}
  */
  public function getBlockPrefix()
  {
    return 'adminbundle_estudiante';
  }
}
