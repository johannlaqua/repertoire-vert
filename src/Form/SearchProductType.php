<?php

namespace App\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('nom', TextType::class,['required' => false])
            ->add('category', EntityType::class, array(
                'class' => 'App:Category',
                'choice_label' =>'name',
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('p');
                },
                'expanded'  => false,
                'multiple'  => false,
            ))
            ->add('prixMin', TextType::class)
            ->add('prixMax', TextType::class)
            /*
            ->add('Niveau_de_certification',ChoiceType::class, [
                'choices'  => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,

                ],
                'expanded'=>false,
                'multiple'=>false
            ])*/
            ->add('recherche', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
