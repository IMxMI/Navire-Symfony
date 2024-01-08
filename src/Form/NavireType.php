<?php

namespace App\Form;

use App\Entity\Navire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NavireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imo')
            ->add('Nom')
            ->add('MMSI')
            ->add('indicatifappel')
            ->add('Eta')
            ->add('longueur')
            ->add('largeur')
            ->add('tirantdeau')
            ->add('aisShipType')
            ->add('Pavillon')
            ->add('destination')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Navire::class,
        ]);
    }
}
