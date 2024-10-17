<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\TableOrder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name',
                'label' => 'Produto',
                'placeholder' => 'Selecione um produto',
                'required' => true,
            ])
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantidade',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Quantidade do produto',
                    'class' => 'form-control',
                    'min' => 1,
                ],
                'constraints' => [
                    new NotBlank(['message' => 'A quantidade é obrigatória']),
                    new Positive(['message' => 'A quantidade deve ser um número positivo']),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
