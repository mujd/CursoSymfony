<?php

namespace BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use BlogBundle\Entity\Tag;

class EntryType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title', 'text', array(
                    'label' => 'Titulo:',
                    "attr" => array(
                        "class" => "form-name form-control"),
                    'required' => true))
                ->add('content', 'textarea', array(
                    'label' => 'Contenido:', "attr" => array(
                        "class" => "form-name form-control")
                    , 'required' => true))
                ->add('status','choice', array('label' => 'Estado:',
                    "choices" => array(
                        "publicado" => "public",
                        "privado" => "private"),
                    "attr" => array(
                        "class" => "form-control")))
                ->add('image', new FileType(), 
                        array('label' => 'Imagen:', 
                            "attr" => array(
                        "class" => "form-control"),
                            "data_class"=>null,
                            'required' => false))
                ->add('category', 'entity', array(
                    'class' => 'BlogBundle:Category',
                    'label' => 'Categoria:',
                    "attr" => array(
                        "class" => "form-control")
                    , 'required' => true))
//            ->add('user')
                ->add('tags','text' , array(
                    "mapped" => false,
                    'label' => 'Etiquetas:',
                    "attr" => array(
                        "class" => "form-control") ))
                ->add('Guardar', 'submit', array('attr' => array(
                        "class" => "form-submit btn btn-success"
            )))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BlogBundle\Entity\Entry'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'blogbundle_entry';
    }

}
