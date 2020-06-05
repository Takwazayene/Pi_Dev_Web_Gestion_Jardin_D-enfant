<?php

namespace RestoBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityRepository;
use RestoBundle\Repository\abonnerestoRepository;
use RestoBundle\Entity\enfant;
use RestoBundle\Entity\abonneresto;
use RestoBundle\Entity\Parents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class abonnerestoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      //  $person=$this->getUser()->getId();


        $builder->add('idAb',HiddenType::class)->add('nom' ,EntityType::class,['class' => 'RestoBundle:enfant','choice_label' =>  function ($enfant) {
            return $enfant->getNom();
        } ,
        ]

    )->add('typeAbo', ChoiceType::class, [
            'choices' => [
                'annuel' => 'annuel',
                'mensuel' => 'mensuel',
                'hebdomadaire' => 'hebdomadaire',
            ],
        ])->add('typePension', ChoiceType::class, [
        'choices' => [
            'complete' => 'complete',
            'Demi p1' => 'Demi p1',
            'Demi p2' => 'Demi p2',
        ],
    ])->add('etat',HiddenType::class,[
            'data' => 0,
        ])->add('absence',HiddenType::class,[
            'data' => 0,
        ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RestoBundle\Entity\abonneresto'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'restobundle_abonneresto';
    }


}
