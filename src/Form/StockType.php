<?php

namespace App\Form;

use App\Entity\Stock;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StockType extends AbstractType
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
            ->add('Description', CKEditorType::class, [
                'label' => 'Описание',
            ])
            ->add('Image', FileType::class, [
                'label' => 'Изображение',
                'mapped' => false,
                'required' => false,
            ])
            ->add('Region', ChoiceType::class,
                [
                    'label' => 'Регион',
                    'choices' => $choices,
                ])
            ->add('Submit', SubmitType::class, [
            'label' => 'Сохранить',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stock::class,
            'choices' => null,
        ]);
    }
}
