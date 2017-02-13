<?php

namespace BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TagType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', new textType()
                        , array('label'=>'Nombre',"attr" => array(
                        "class" => "form-name form-control")
                    , 'required' => true))
            ->add('description', new TextareaType()
                        , array('label'=>'Nombre',"attr" => array(
                        "class" => "form-name form-control")
                    , 'required' => true))
            ->add('Guardar', 'submit', array('attr' => array(
                    "class" => "form-submit btn btn-success"
                )))    
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BlogBundle\Entity\Tag'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'blogbundle_tag';
    }
}
