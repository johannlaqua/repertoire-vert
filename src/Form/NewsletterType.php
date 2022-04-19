<?php

namespace App\Form;

use App\Entity\NewsLetterUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Email;

class NewsletterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,["label" => "nom"])
            ->add('prenom',TextType::class,["label" => "prenom"])
            ->add('mail',EmailType::class,["label" => "mail",
            'constraints'=>[
                new Email()
            ]
            ])

            ->add('ville',TextType::class,["label" => "ville"])
            ->add('code_postal',TextType::class,["label" => "code postal"])
            ->add("enregistrer" , SubmitType::class, [
                "attr" => [
                "class" => "btn btn-secondary"
                ] 
                ]);

          
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NewsLetterUser::class,
        ]);
    }
}
