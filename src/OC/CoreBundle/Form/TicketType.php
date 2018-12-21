<?php

namespace OC\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\Translator;


class TicketType extends AbstractType
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
        ->add('visitor',     VisitorType::class, array('label' => $this->getTranslator()->trans('label.visitor'))) 
        ->add('reducedRate', CheckboxType::class, array(
            'required' => false, 
            'label' => $this->getTranslator()->trans('label.reducedRate'),
            'attr' =>array('data-help'=>'general.reducedRateConditionp'),
        ));
    }
        


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
           'data_class' => 'OC\CoreBundle\Entity\Ticket',
           'locale' => 'fr', // the default locale
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_corebundle_ticket';
    }


}
