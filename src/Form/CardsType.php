<?php

namespace App\Form;

use App\Entity\Cards;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class CardsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surname', TextType::class, [
                'label' => 'Фамилия'
            ])
            ->add('name', TextType::class, [
                'label' => 'Имя'
            ])
            ->add('patronymic', TextType::class, [
                'label' => 'Отчество'
            ])
            ->add('date_birth', BirthdayType::class, [
                'label' => 'Дата рождения',
                'years' => range(date('1920'), date('2002')),
            ])
            ->add('number', IntegerType::class, [
                'label' => 'Номер телефона'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Электронная почта'
            ])
            ->add('regulations', CheckboxType::class, [
                'label' => 'Принять условия',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cards::class,
        ]);
    }
}
