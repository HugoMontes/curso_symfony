<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
    // En caso que se desee ingresar la fecha en TextPlain
    // ->add('fechanac', DateTimeType::class, array('widget' => 'single_text', 'date_format' => 'yyyy-MM-dd'))
    ->add('edad')
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
