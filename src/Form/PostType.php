<?php

namespace App\Form;

use App\Entity\Marchandise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
            ->add('body')
            ->add('category', EntityType::class, array(
                'class' => 'App:PostCategory',
                'choice_label' =>'name',
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('p');
                },
                'expanded'  => false,
                'multiple'  => false,
            ))

            ->add('subtitle')
            ->add('body')
            ->add('photo', FileType::class, ['label' => 'image', 'required' => false])
            ->add('Ajouter',SubmitType::class);
            /*->add('image2', FileType::class, array(
            'label' => 'Image',
            'data_class' => null,
            'required' => false
        ))*/
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Post'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_post';
    }
}
