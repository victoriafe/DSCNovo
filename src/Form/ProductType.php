<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', TextType::class, [
                'label' => 'Categoria',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, insira a categoria.',
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Digite a categoria',
                    'class' => 'form-control',
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'Nome',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, insira o nome do produto.',
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Digite o nome do produto',
                    'class' => 'form-control',
                ],
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Preço',
                'currency' => 'brl',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, insira o preço.',
                    ]),
                    new Positive([
                        'message' => 'O preço deve ser um valor positivo.',
                    ]),
                ],
                'attr' => [
                    'placeholder' => '0,00',
                    'class' => 'form-control',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
