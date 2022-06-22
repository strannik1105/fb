<?php

namespace App\Form;

use App\Entity\Rate;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = array();
        foreach($options['choices'] as $i)
        {
            $choices[$i->getName()] = $i;
        }
        $builder
            ->add('Name', TextType::class, [
                'label' => 'Название',
            ])
            ->add('Type', ChoiceType::class,[
                'label' => 'Тип',
                'choices' => ['Интернет' => 'Internet',
                    'Телевидение' => 'TV',
                    'Видеонаблюдение' => 'Video'],
            ])
            ->add('Description', CKEditorType::class, [
                'label' => 'Описание',
            ])
            ->add('Speed', TextType::class, [
                'label' => 'Скорость',
                'required' => false,
            ])
            ->add('Cost', CKEditorType::class, [
                'label' => 'Цена',
                'required' => false,
                'config' => [
                    'contentsCss' => '/css/style.min.css',
                    ],
            ])
            ->add('CostType', TextType::class, [
                'label' => 'Единицы измерения цены',
                'required' => false,
            ])
            ->add('Region', ChoiceType::class,
            [
                'label' => 'Регион',
                'choices' => $choices,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Сохранить',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rate::class,
            'choices' => null,
        ]);
    }
}
