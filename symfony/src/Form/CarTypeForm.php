<?php
namespace App\Form;

use App\Entity\Car;
use App\Entity\CarCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('model', TextType::class, [
                'label' => 'Model',
            ])
            ->add('year', IntegerType::class, [
                'label' => 'Year',
            ])
            ->add('color', TextType::class, [
                'label' => 'Color',
            ])
            ->add('carCategory', EntityType::class, [
                'class' => CarCategory::class,
                'label' => 'Car Category',
                'choice_label' => 'name',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save Car',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}