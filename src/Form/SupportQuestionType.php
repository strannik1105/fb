<?php

namespace App\Form;

use App\Entity\SupportQuestion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SupportQuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => 'Название',
                'required' => true,
                ])
            ->add('URL', TextType::class, [
                'label' => 'Ссылка',
                'required' => true,
                ])
            ->add('Submit', SubmitType::class, [
                'label' => 'Сохранить',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SupportQuestion::class,
        ]);
    }
}
