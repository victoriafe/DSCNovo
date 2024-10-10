<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Stock;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class StockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product', EntityType::class, [
                'label' => 'Produto',
                'disabled' => true,
                'class' => Product::class,
                'choice_label' => 'name',
            ])
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantidade',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, insira a quantidade.',
                    ]),
                    new Positive([
                        'message' => 'A quantidade deve ser um valor positivo.',
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Digite a quantidade',
                    'class' => 'form-control',
                ],
            ])
            ->add('purchasePrice', MoneyType::class, [
                'label' => 'Preço de Compra (R$)',
                'currency' => 'brl',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, insira o preço de compra.',
                    ]),
                    new Positive([
                        'message' => 'O preço de compra deve ser um valor positivo.',
                    ]),
                ],
                'attr' => [
                    'placeholder' => '0,00',
                    'class' => 'form-control',
                    'step' => '0.01',
                ],
            ])
            ->add('salePrice', MoneyType::class, [
                'label' => 'Preço de Venda (R$)',
                'currency' => 'brl',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, insira o preço de venda.',
                    ]),
                    new Positive([
                        'message' => 'O preço de venda deve ser um valor positivo.',
                    ]),
                ],
                'attr' => [
                    'placeholder' => '0,00',
                    'class' => 'form-control',
                    'step' => '0.01',
                ],
            ])
            ->add('entryDate', DateType::class, [
                'label' => 'Data de Entrada',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Selecione a data',
                ],
            ])
            ->add('expirationDate', DateType::class, [
                'label' => 'Data de Validade',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Selecione a data',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stock::class,
        ]);
    }
}
