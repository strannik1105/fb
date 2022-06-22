<?php

namespace App\Form;

use App\Entity\VacantPosition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VacantPositionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => 'Название',
            ])
            ->add('Requirements', TextType::class, [
                'label' => 'Требования',
            ])
            ->add('Payment', TextType::class, [
                'label' => 'Оплата'
            ])
            ->add('Image', FileType::class, [
                'label' => 'Изображение',
                'mapped' => 'false',
                'data_class' => null,
            ])
            ->add('Submit', SubmitType::class, [
                'label' => 'Сохранить',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VacantPosition::class,
        ]);
    }
}
