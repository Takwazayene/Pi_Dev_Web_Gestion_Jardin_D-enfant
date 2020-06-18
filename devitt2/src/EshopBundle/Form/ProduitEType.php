<?php

namespace EshopBundle\Form;

use EshopBundle\Entity\CategorieE;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitEType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('quantite')
                ->add('libelle')
                ->add('description')
                ->add('img')
                ->add('prix')
                ->add('idCategorie',EntityType::class,array('class'=> 'EshopBundle:CategorieE','choice_label'=>'label','multiple'=>false))
                ->add("add",SubmitType::class,array('label' => 'Enregistrer'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EshopBundle\Entity\ProduitE'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'eshopbundle_produite';
    }


}
