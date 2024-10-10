<?php

namespace App\Form;

use App\Entity\Table;
use App\Entity\TableOrder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TableOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('occupiedTable', EntityType::class, [
                'class' => Table::class,
                'choice_label' => 'number',
                'label' => 'Mesa Ocupada',
                'placeholder' => 'Selecione a mesa',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TableOrder::class,
        ]);
    }
}