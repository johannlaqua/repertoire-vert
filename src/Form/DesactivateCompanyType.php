<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\Length;

class DesactivateCompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('email', EmailType::class, [
            'label' => 'Adresse mail *',
            'required' => true,
            'constraints' => [
            ]
        ])->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Mots de passe non identiques',
            'options' => [
                'attr' => [
                    'class' => 'password-field'
                ]
            ],
            'required' => true,
            'first_options'  => ['label' => 'Mot de passe *'],
            'second_options' => ['label' => 'Confirmer mot de passe *']
        ])->add('submit', SubmitType::class, [
            'label' => 'Valider',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
