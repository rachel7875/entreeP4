<?php

namespace OC\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use OC\CoreBundle\Entity\Duration;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email',  EmailType::class)
        ->add('visitDay',       DateType::class, array(
            'widget'=> 'single_text',
            // prevents rendering it as type="date", to avoid HTML5 date pickers
            'html5' => false,
            // adds a class that can be selected in JavaScript
            'attr' => ['class' => 'js-datepicker'],
        ) )
        ->add('duration',       EntityType::class, array(
            'class'        => Duration::class,
            'choice_label' => 'durationName',
            'multiple'     => false,
            'expanded'     => true,
        ))
        ->add('ticketsNumber',  ChoiceType::class,  array(
            'choices'  => array(
                '1' => 1,
                '2' => 2,
                '3' => 3,
                '4' => 4,
                '5' => 5,
                '6' => 6,
                '7' => 7,
                '8' => 8,
                '9' => 9,
                '10' => 10,
            ), 
        
        ))    
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
        'data_class' => 'OC\CoreBundle\Entity\Booking',
        ));
    }

   
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_corebundle_booking';
    }


}
