<?php

namespace BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', new textType()
                        , array('label'=>'Nombre',"attr" => array(
                        "class" => "form-name form-control")
                    , 'required' => true))
                ->add('surname', new textType()
                        , array('label'=>'Apellidos',"attr" => array(
                        "class" => "form-name form-control")
                    , 'required' => true))
                ->add('email', new emailType()
                        , array('label'=>'Email',"attr" => array(
                        "class" => "form-name form-control")
                    , 'required' => true))
                ->add('password', new passwordType()
                        , array('label'=>'Contraseña',"attr" => array(
                        "class" => "form-name form-control")
                    , 'required' => true))
                ->add('Guardar', 'submit', array('label'=>'Guardar','attr' => array(
                    "class" => "form-submit btn btn-success"
                )))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BlogBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'blogbundle_user';
    }

}
