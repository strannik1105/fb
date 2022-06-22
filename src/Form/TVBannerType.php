<?php

namespace App\Form;

use App\Entity\TVBanner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TVBannerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Image', FileType::class, [
                'label' => 'Изображение',
                'mapped' => false,
                'required' => false,
            ])
            ->add('Submit', SubmitType::class, [
                'label' => 'Сохранить',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TVBanner::class,
        ]);
    }
}
