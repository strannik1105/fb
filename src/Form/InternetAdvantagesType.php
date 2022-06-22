<?php

namespace App\Form;

use App\Entity\InternetAdvantages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class InternetAdvantagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Image', FileType::class, [
                'label' => 'Изображение',
                'mapped' => false,
                'required' => false,
                ])
            ->add('Name', CKEditorType::class, [
                'label' => 'Название',
            ])
            ->add('Description', CKEditorType::class, [
                'label' => 'Описание',
            ])
            ->add('Submit', SubmitType::class, [
                'label' => 'Сохранить',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InternetAdvantages::class,
        ]);
    }
}
