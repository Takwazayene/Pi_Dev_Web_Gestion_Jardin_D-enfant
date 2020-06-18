<?php

namespace DorsafBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomEvent')->add('categorieEvent',ChoiceType::class,[
                'choices'=>[
                    'quran'=>'quran',
                    'music'=>'music',
                    'theatre'=>'theatre',
                ],])->add('nbrPlaceDispo')->add('dateEvent', DateType::class, [
            // renders it as a single text box
            'widget' => 'single_text',
        ])->add('description',TextareaType::class)->add('adresse');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DorsafBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'dorsafbundle_event';
    }


}
