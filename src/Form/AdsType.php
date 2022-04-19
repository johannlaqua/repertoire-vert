<?php
namespace App\Form;


use App\Entity\Ads;
use App\Entity\Cssstyle;
use App\Entity\Location;
use App\Entity\Pages;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdsType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options): void
{
$builder
    ->add('photo', FileType::class, array('data_class' => null))
    ->add('publishdatebegin', DateType::class)
    ->add('publishdateend', DateType::class)
    ->add('slogan')
    ->add('location', EntityType::class, [
        'class' =>Location::class,
        'choice_label' => 'name'
    ])

    ->add('Ajouter',SubmitType::class);
;
}

public function configureOptions(OptionsResolver $resolver): void
{
$resolver->setDefaults([
'data_class' => Ads::class,
]);
}
}