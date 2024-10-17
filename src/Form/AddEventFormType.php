<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints as Assert;

class AddEventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datetime_start', null, [
                'widget' => 'single_text',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('datetime_end', null, [
                'widget' => 'single_text',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('titre', null, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('description', null, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('visibility')
            ->add('users', EntityType::class, [
                'required' => true,
                'class' => User::class,
                'choice_label' => 'firstname',
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
