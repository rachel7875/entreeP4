<?php

namespace OC\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisitorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('visitorName',        TextType::class, array('label' => 'Nom'))
        ->add('visitorFirstName',   TextType::class, array('label' => 'Prénom'))
        ->add('birthday',           BirthdayType::class, array(
            'widget' => 'choice',
            'label' => "Date d'anniversaire",
            'format' => 'dd-MM-yyyy',
        ))
        ->add('country',        CountryType::class, array('label' => 'Pays'));
    }
    


    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\CoreBundle\Entity\Visitor'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_corebundle_visitor';
    }


}
