<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnoncesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('user', EntityType::class,array('class' => User::class))
        ->add('categorie', TextType::class)
        ->add('typeUser', TextType::class)
        ->add('typeAnnonc', TextType::class)
        ->add('titre', TextType::class)
        ->add('text', TextType::class)
        ->add('prix', NumberType::class)
        ->add('flyer', TextType::class)
        ->add('codePostal', IntegerType::class)
        ->add('adresse', TextType::class)
        ->add('startDate', DateType::class)
        ->add('endDate', DateType::class)
        ->add('isPublish');

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Annonces',
            'csrf_protection' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_annonces';
    }


}
