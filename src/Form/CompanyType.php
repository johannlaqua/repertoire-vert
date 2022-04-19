<?php

namespace App\Form;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\ORM\EntityRepository;


class CompanyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('startingdate',DateType::class,[
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jours',
                ],
                'years' => range(1970, date('Y'))
            ])
            ->add('certification')
            ->add('category', EntityType::class, array(
                'class' => 'App:Category',
                'choice_label' =>'name',
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('p');
                },
                'expanded'  => false,
                'multiple'  => true,
            ))
            /*
            ->add('category','entity', array(
                'class'=>'Repertoire_Vert\src\App\Entity\Category.php',
                'property'=>'companyCategory',
                'multiple'=>false,
            ))
            */
            ->add('influencezone')
            ->add('wantevaluation')
            ->add('description')
            ->add('vision')
            ->add('socialreason')
            ->add('urlwebsite')
            ->add('urlfacebook')
            ->add('urltwitter')
            ->add('urllinkedin')
            //->add('username')
            // ->add('email', RepeatedType::class,[
            //     'type' => TextType::class,
            //     'first_options' => ['label' => 'Email'],
            //     'second_options' => ['label' => 'Confirmer votre email'],
            // ])
            ->add('street')
            ->add('streetnumber')
            ->add('postcode')
            ->add('city')
            ->add('region')
            ->add('country')
            ->add('phone')
            // ->add('plainPassword', RepeatedType::class, [
            //     'type' => PasswordType::class,
            //     'first_options' => ['label' => 'Password'],
            //     'second_options' => ['label' => 'Confirm Password'],
            // ])
            ->add('package')
            ->add('image',FileType::class, ['label' => 'image','data' => null,'required' =>false])
            ->add('latitude')
            ->add('longtitude');
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Company::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_company';
    }


}
