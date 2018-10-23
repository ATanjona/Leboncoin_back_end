<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
//        ->add('user', EntityType::class,array('class' => User::class))
//        ->add('categorie', TextType::class)
//        ->add('typeUser', TextType::class)
//        ->add('typeAnnonce', TextType::class)
//        ->add('titre', TextType::class)
//        ->add('text', TextType::class)
//        ->add('prix', NumberType::class)
        ->add('flyerFile', FileType::class);
//        ->add('codePostale', IntegerType::class)
//        ->add('adresse', TextType::class)
//        ->add('startDate', DateType::class)
//        ->add('endDate', DateType::class)
//        ->add('isPublish');

//        $annonces->setUser($user);
//        $annonces->setCategorie($categorie);
//        $annonces->setTypeUtilisateur($typeUtilisa);
//        $annonces->setTypeAnnonce($typeAnnonc);
//        $annonces->setTitre($request->get('titre'));
//        $annonces->setText($request->get('text'));
//        $annonces->setPrix($request->get('prix'));
//        $annonces->setFlyer($request->get('flyer'));
//        $annonces->setVille($ville);
//        $annonces->setAdresse($request->get('adresse'));


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
