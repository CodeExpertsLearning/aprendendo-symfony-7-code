<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('email', Type\EmailType::class)
            ->add('username')
            ->add('password', Type\PasswordType::class)
            ->add('roles', Type\ChoiceType::class, [
                'label' => 'Papéis',
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'Administrador' => 'ROLE_ADMIN',
                    'Gerente'       => 'ROLE_MANAGER',
                    'Usuário'       => 'ROLE_USER'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
