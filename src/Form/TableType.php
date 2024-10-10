<?php

namespace App\Form;

use App\Entity\Table;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class TableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number', IntegerType::class, [
                'label' => 'Número da Mesa',
                'attr' => [
                    'placeholder' => 'Digite o número da mesa',
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'O número da mesa não pode estar vazio.']),
                    new Positive(['message' => 'O número da mesa deve ser um valor positivo.']),
                ],
            ])
            ->add('capacity', IntegerType::class, [
                'label' => 'Capacidade',
                'attr' => [
                    'placeholder' => 'Digite a capacidade da mesa',
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'A capacidade não pode estar vazia.']),
                    new Positive(['message' => 'A capacidade deve ser um valor positivo.']),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Table::class,
        ]);
    }
}
