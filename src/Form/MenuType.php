<?php

namespace App\Form;

use App\Entity\Menu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class,[
                'label' => 'Название'
            ])
            ->add('URL', TextType::class,[
                'label' => 'Ссылка'
            ])
            ->add('Parent', TextType::class, [
                'required' => false,
            ])
            ->add('Level', TextType::class, [
                'required' => false,
            ])
            ->add('Number', TextType::class, [
                'required' => false,
            ])
            ->add('Childs', TextType::class, [
                'required' => false,
            ])
            ->add('Submit', SubmitType::class, [
                'label' => 'Сохранить',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
