<?php

namespace App\Form;

use App\Entity\GeneralInformation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GeneralInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('SEO_Title', TextType::class, [
                'label' => 'Название'
            ])
            ->add('SEO_Description', TextType::class, [
                'label' => 'Описание'
            ])
            ->add('SEO_Keywords', TextType::class, [
                'label' => 'Ключевые слова'
            ])
            ->add('Submit', SubmitType::class, [
                'label' => 'Сохранить',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GeneralInformation::class,
        ]);
    }
}
