<?php

namespace App\Form;

use App\Entity\News;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => 'Заголовок',
            ])
            ->add('ShortDescription', CKEditorType::class, [
                'label' => 'Короткое описание',
            ])
            ->add('Description', CKEditorType::class, [
                'label' => 'Описание',
            ])
            ->add('Image', FileType::class, [
                'label' => 'Изображение',
                'mapped' => false,
                'required' => false,
            ])
            ->add('Date')
            ->add('Submit', SubmitType::class, [
                'label' => 'Сохранить',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}
