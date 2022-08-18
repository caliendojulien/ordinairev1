<?php

namespace App\Form;

use App\Entity\Promotion;
use App\Entity\Stages;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomPromotion')
            ->add('stage', EntityType::class, ['label' => false, 'multiple' => false, 'expanded' => false, 'choice_label' => 'nom', 'class' => Stages::class])
            ->add('dateDebut', DateType::class)
            ->add('dateFin', DateType::class)
            ->add('nbStagiaire')
            ->add('Ajouter', SubmitType::class, ['attr' => ['class' => 'button']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Promotion::class,
        ]);
    }
}
