<?php

namespace App\Form;

use App\Entity\Stages;
use App\Entity\Utilisateurs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjoutStagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('grade')
            ->add('nom')
            ->add('prenom')
            ->add('compagnie')
            ->add('stage', EntityType::class, ['multiple' => false, 'expanded' => false, 'class' => Stages::class, 'choice_label' => 'nom', 'label' => false])
            ->add('Ajouter', SubmitType::class, ['attr' => ['class' => 'button']]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
        ]);
    }
}
