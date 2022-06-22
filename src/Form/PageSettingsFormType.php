<?php

namespace App\Form;

use App\Entity\PageSettings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class PageSettingsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('MainPage', CKEditorType::class, [
                'label' => 'Основная страница',
            ])
            ->add('Company_About_Years', TextType::class, [
                'label' => 'Количество лет',
            ])
            ->add('Company_About_Companies', TextType::class, [
                'label' => 'Количество компаний',
            ])
            ->add('Company_About_Abonents', TextType::class, [
                'label' => 'Количество абонентов',
            ])
            ->add('Company_Text', CKEditorType::class, [
                'label' => 'Текст',
            ])
            ->add('CompanyImage', FileType::class, [
                'label' => 'Изображение',
                'mapped' => false,
                'required' => false,
                ])
            ->add('Rates_Warning', CKEditorType::class, [
                'label' => 'Предупреждение',
            ])
            ->add('Internet_Text', CKEditorType::class, [
                'label' => 'Текст',
            ])
            ->add('TVBanner', FileType::class, [
                'label' => 'Изображение',
                'mapped' => false,
                'required' => false,
                ])
            ->add('TV_Warning', CKEditorType::class, [
                'label' => 'Предупреждение',
            ])
            ->add('Video_Text', CKEditorType::class, [
                'label' => 'Текст',
            ])
            ->add('Support_Questions', CKEditorType::class, [
                'label' => 'Вопросы',
            ])
            ->add('Support_Text', CKEditorType::class, [
                'label' => 'Текст',
            ])
            ->add('SupportImage', FileType::class, [
                'label' => 'Изображение',
                'mapped' => false,
                'required' => false,
                ])
            ->add('VacancyImage', FileType::class, [
                'label' => 'Изображение',
                'mapped' => false,
                'required' => false,
                ])
            ->add('VacancyText', CKEditorType::class, [
                'label' => 'WhatsApp',
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
			->add('SubmitType', SubmitType::class, [
                'label' => 'Сохранить',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PageSettings::class,
        ]);
    }
}
