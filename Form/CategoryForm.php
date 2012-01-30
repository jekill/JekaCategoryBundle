<?php
namespace Jeka\CategoryBundle\Form;


use \Symfony\Component\Form\FormBuilder;
use \Symfony\Component\Form\AbstractType;

class CategoryForm extends AbstractType{


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    function getName()
    {
        return 'category';
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name')
        ->add('slug')
        ->add('is_hidden',null,array('required'=>false))
        ->add('parent');
    }
}