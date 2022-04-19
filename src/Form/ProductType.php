<?php

namespace App\Form;

use App\Entity\Marchandise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;

class ProductType extends AbstractType
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
                //'choice_attr' => ['data-cat' => $options['user']->getCategories()]
                ))
            ->add('origin', TextType::class, [
                'required' => true,
            ])
            ->add('slug')
            ->add('certification', TextType::class, [
                'required' => true,
            ])
            ->add('packaging')
            ->add('quantity', TextType::class, [
                'required' => true,
            ])
            ->add('weight')
            ->add('latitude',TextType::class)
            ->add('longitude',TextType::class)
            ->add('weightunit',ChoiceType::class, [
                'choices'  => [
                    'kg' => 'kg',
                    'cg' => 'cg',
                    'dg' => 'dg',
                    'g' => 'g',
                    'dag' => 'dag',
                    'hg' => 'hg',
                    'kg' => 'kg',
                    'q' => 'q',
                    't' => 't',
                ],
                'expanded'=>false,
                'multiple'=>false
            ])
            ->add('volume')
            ->add('volumeunit',ChoiceType::class, [
                'choices'  => [
                    'ml' => 'ml',
                    'cl' => 'cl',
                    'dl' => 'dl',
                    'l' => 'l',
                    'mm3' => 'mm3',
                    'cm3' => 'cm3',
                    'dm3' => 'dm3',
                    'm3' => 'm3',
                ],
                'expanded'=>false,
                'multiple'=>false
            ])
            ->add('height')
            ->add('width')
            ->add('depth')
            ->add('lengthunit',ChoiceType::class, [
                'choices'  => [
                    'mm' => 'mm',
                    'cm' => 'cm',
                    'dm' => 'dm',
                    'm' => 'm',
                ],
                'expanded'=>false,
                'multiple'=>false
            ])
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
            ->add('wantevaluation', ChoiceType::class, [
                'choices'  => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'required' => true,
                'expanded' => true,
                'multiple' => false
            ])
            ->add('updated_date')
            ->add('image', FileType::class, array(
                'required' => true,
                'label' => false,
                'constraints' => [
                    new Image([
                        /*'maxWidth' => '900',
                        'maxHeight'=> '900',
                        'maxWidthMessage' => 'La largeur de l\'image est trop grande ({{ width }}px). Le maximum autorisé est {{ max_width }}px.',
                        'maxHeightMessage' => 'La hauteur de l\'image est trop grande ({{ width }}px). Le maximum autorisé est {{ max_width }}px.',*/
                        'mimeTypes' => ['image/png', 'image/jpg', 'image/jpeg'],
                        'mimeTypesMessage' => 'Le fichier n\'est pas une image valide',
                    ]),
                    new File([
                        'maxSize' => '8M',
                        'maxSizeMessage' => 'Le fichier est trop lourd ({{ size }} {{ suffix }}). La taille maximum est de {{ limit }} {{ suffix }}.'
                    ])
                ],
            )
)

            /*->add('image2', FileType::class, array(
            'label' => 'Image',
            'data_class' => null,
            'required' => false
        ))*/
        ;
    }

   /* public function buildView(FormView $view, FormInterface $form, array $options)
    {
        dump('build view');
        //dd($view);
        dump($form->getData()->getImage());
        dump($options);

        $entity = $form->getData()->getImage();

        if (is_file($entity)) {


            $view->vars['file_uri'] = ($entity->getFilename() === null)
                ? null
                : 'uploads/products/' . $entity->getFilename()
            ;
            //dd($view->vars);
        }


    }*/

    /**
     * {@inheritdoc}
     * PERMET DE RECUPERER DES VARIABLES QU'ON ENVOIE DEPUIS LE CONTROLEUR
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Marchandise',
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
