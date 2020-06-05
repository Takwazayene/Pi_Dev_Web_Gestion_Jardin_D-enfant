<?php

namespace RestoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class paiementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $total = $options['total'];

        $builder->add('idC',HiddenType::class,[
        'data' => 0,
        ])->add('type', ChoiceType::class, [
            'choices' => [
                'carte bancaire' => 'cartebancaire',
                'edinar' => 'edinar',

            ],
        ])->add('date',HiddenType::class)->add('total',TextType::class,[
            'data' => $total,'disabled'=>true,
        ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RestoBundle\Entity\paiement',
        'total'=>null  ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'restobundle_paiement';
    }


}
