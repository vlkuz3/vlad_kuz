<?php

namespace App\Form;

use App\Entity\Payment;
use App\Entity\Rental;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rental', EntityType::class, [
                'class' => Rental::class,
                'label' => 'Rental',
                'choice_label' => 'id',
            ])
            ->add('amount', NumberType::class, [
                'label' => 'Amount',
            ])
            ->add('paymentDate', DateTimeType::class, [
                'label' => 'Payment Date',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save Payment',
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Payment::class,
        ]);
    }
}
