<?php

namespace App\Form;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Company1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            //->add('password')
            //->add('role')
            //->add('token')
            //->add('emailValidated')
            //->add('actived')
            //->add('inscriptiondate')
            //->add('connected')
            ->add('name')
            ->add('certification')
            ->add('influencezone')
            ->add('street')
            ->add('streetnumber')
            ->add('postcode')
            ->add('city')
            ->add('region')
            ->add('country')
            ->add('phone')
            ->add('wantevaluation')
            ->add('description')
            ->add('vision')
            ->add('socialreason')
            ->add('urlwebsite')
            ->add('urlfacebook')
            ->add('urltwitter')
            ->add('urllinkedin')
            //->add('slug')
            ->add('startingdate')
            //->add('package')
            //->add('image')
            ->add('latitude')
            ->add('longtitude')
            //->add('companyfavs')
            //->add('category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
