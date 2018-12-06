<?php

namespace OC\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\Translator;


class VisitorType extends AbstractType
{
    private $translator;

    private function getTranslator() {

        if(!isset($this->translator)) {
            $this->translator = new Translator($this->options['locale']);
        }

        return $this->translator;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->options = $options;

        $builder
        ->add('visitorName',        TextType::class, array('label' => $this->getTranslator()->trans('label.visitorName')))
        ->add('visitorFirstName',   TextType::class, array('label'  => $this->getTranslator()->trans('label.visitorFirstName')))
        ->add('birthday',           BirthdayType::class, array(
            'widget' => 'choice',
            'label' => $this->getTranslator()->trans('label.birthdayDate'),
            'format' => 'dd-MM-yyyy',
        ))
        ->add('country',        CountryType::class, array('label'=> $this->getTranslator()->trans('label.country')));
    }
    


    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\CoreBundle\Entity\Visitor',
            'locale' => 'fr', // the default locale
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
