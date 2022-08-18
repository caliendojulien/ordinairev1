<?php

namespace App\Form;

use App\Entity\Admin;
use App\Entity\Stages;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            //  ->add('plainPassword', PasswordType::class, ['mapped' => false, 'attr' => ['autocomplete' => 'new-password'], 'constraints' => [
            //   new NotBlank(['message' => 'Please enter a password',]),
            // new Length(['min' => 6, 'minMessage' => 'Your password should be at least {{ limit }} characters', 'max' => 4096,]),],])
            ->add('grade')
            ->add('nom')
            ->add('prenom')
            ->add('compagnie');
        //->add('stages', EntityType::class, ['label' => false, 'multiple' => true, 'expanded' => true, 'choice_label' => 'nom', 'class' => Stages::class,
        //   'attr' => ['class' => 'checkbox'], 'row_attr' => ['class' => 'zizi']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}
