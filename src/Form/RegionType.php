<?php

namespace App\Form;

use App\Entity\Region;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;


class RegionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => 'Название',
            ])
            ->add('Phone', TextType::class, [
                'label' => 'Телефон',
                'required' => false,
            ])
            ->add('Mail', TextType::class, [
                'label' => 'Почта',
                'required' => false,
            ])
            ->add('Adress', TextType::class, [
                'label' => 'Адрес',
                'required' => false,
            ])
            ->add('Map', TextType::class, [
                'label' => 'Поле для карты',
                'required' => false,
            ])
            ->add('WhatsApp', TextType::class, [
                'label' => 'WhatsApp',
                'required' => false,
            ])
            ->add('Telegram', TextType::class, [
                'label' => 'Telegram',
                'required' => false,
            ])
            ->add('Viber', TextType::class, [
                'label' => 'Viber',
                'required' => false,
            ])
            ->add('InternetWarning', CKEditorType::class, [
                'label' => 'Предупреждение(Интернет)',
                'required' => false,
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Сохранить',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Region::class,
        ]);
    }
}
