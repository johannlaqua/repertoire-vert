<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Image;

class ServiceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
     public function buildForm(FormBuilderInterface $builder, array $options)
     {
        $builder->add('name', TextType::class, [
            'required' => true,
        ])
            ->add('description', TextareaType::class, [
                'required' => true,
            ])
            ->add('subcategories', EntityType::class, array(
                'class' => 'App:Subcategory',
                'choice_label' =>'name',
                'required' => true,
                'query_builder' => function (EntityRepository $repo) use ($options) {
                    return $repo->createQueryBuilder('s')
                        ->select('s')
                        ->join('s.categories', 'c')
                        ->join('c.companies', 'co')
                        ->where('co.id = :user_id')
                        ->setParameter('user_id', $options['user']->getId());
                },
                //'choices' => $options['user'].categories,
                'expanded'  => false,
                'multiple'  => true,
                'choice_attr' => ['data-cat' => $options['user']->getCategories()]
            ))
            ->add('origin', TextType::class, [
                'required' => false,
            ])
            ->add('slug')
            ->add('certification', TextType::class, [
                'required' => true,
            ])
            //->add('packaging')
            //->add('unit')
            ->add('price', TextType::class, [
                'required' => true,
            ])
            ->add('currency',ChoiceType::class, [
                'choices'  => [
                    'CHF' => 'CHF',
                    'Euro' => 'Euro',
                ],
                'required' => true,
                'expanded'=>false,
                'multiple'=>false
            ])
            ->add('serviceduration',ChoiceType::class, [
                'choices'  => [
                    'prestation' => 'prestation',
                    'heure' => 'heure',
                    '2 heures' => '2 Heures',
                    '1/2 journée' => '1/2 journée',
                    'jour' => 'jour',
                ],
                'required' => true,
                'expanded'=>false,
                'multiple'=>false
            ])
            //->add('price')
            ->add('wantevaluation', ChoiceType::class, [
                'choices'  => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'required' => true,
                'expanded'=>false,
            ])->add('image', FileType::class, [
                'label' => false,
                'required' => true,
                'constraints' => [
                new Image([
                    /*'maxWidth' => '900',
                    'maxHeight'=> '900',
                    'maxWidthMessage' => 'La largeur de l\'image est trop grande ({{ width }}px). Le maximum autorisé est {{ max_width }}px.',
                    'maxHeightMessage' => 'La hauteur de l\'image est trop grande ({{ width }}px). Le maximum autorisé est {{ max_width }}px.',*/
                    'mimeTypesMessage' => 'Le fichier n\'est pas une image valide',
                ])
            ],]);
    }

    /**
     * {@inheritdoc}
     */
     public function configureOptions(OptionsResolver $resolver)
     {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Product',
            'user' => null,
        ));
      }

    /**
     * {@inheritdoc}
     */
     public function getBlockPrefix()
     {
        return 'app_product';
     }
}
