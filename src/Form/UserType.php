<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Nome de Usuário',
                'attr' => [
                    'placeholder' => 'Digite seu nome de usuário',
                    'class' => 'form-control'
                ],
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'Cargos',
                'choices' => [
                    'Chef' => 'ROLE_CHEF',
                    'Garçom' => 'ROLE_WAITER',
                    'Admin' => 'ROLE_ADMIN',
                ],
                'expanded' => true, // Para exibir como botões de opção
                'multiple' => true, // Permitir múltiplas seleções
                'attr' => [
                    'class' => 'form-check-inline'
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Senha',
                'attr' => [
                    'placeholder' => 'Digite sua senha',
                    'class' => 'form-control'
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'Nome Completo',
                'attr' => [
                    'placeholder' => 'Digite seu nome completo',
                    'class' => 'form-control'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
