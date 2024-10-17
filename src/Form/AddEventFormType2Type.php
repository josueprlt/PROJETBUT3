<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddEventFormType2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datetime_start', null, [
                'widget' => 'single_text',
            ])
            ->add('datetime_end', null, [
                'widget' => 'single_text',
            ])
            ->add('titre')
            ->add('description')
            ->add('visibility')
            ->add('users', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
