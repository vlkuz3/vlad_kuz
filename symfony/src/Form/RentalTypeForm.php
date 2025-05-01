<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Customer;
use App\Entity\Rental;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RentalTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('car', EntityType::class, [
                'class' => Car::class,
                'label' => 'Car',
                'choice_label' => 'model',
            ])
            ->add('customer', EntityType::class, [
                'class' => Customer::class,
                'label' => 'Customer',
                'choice_label' => 'name',
            ])
            ->add('startDate', DateType::class, [
                'label' => 'Start Date',
                'widget' => 'single_text',
                'html5' => true,
            ])
            ->add('endDate', DateType::class, [
                'label' => 'End Date',
                'widget' => 'single_text',
                'html5' => true,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save Rental',
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rental::class,
        ]);
    }
}
