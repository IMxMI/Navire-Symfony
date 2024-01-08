<?php

namespace App\Form;

use App\Entity\Navire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Port;
use App\Entity\AisShipType;
use App\Entity\Pays;

class NavireType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
                ->add('imo', TextType::class)
                ->add('Nom', TextType::class)
                ->add('MMSI', TextType::class)
                ->add('indicatifappel', TextType::class)
                ->add('Eta', DateTimeType::class, ['widget' => 'single_text'])
                ->add('longueur', IntegerType::class)
                ->add('largeur', IntegerType::class)
                ->add('tirantdeau', NumberType::class, array(
                    'scale' => 1,
                ))
                ->add('aisShipType', EntityType::class, [
                    'class' => AisShipType::class,
                    'choice_label' => 'libelle'
                ])
                ->add('Pavillon', EntityType::class, [
                    'class' => Pays::class,
                    'choice_label' => 'nom'
                ])
                ->add('destination', EntityType::class, [
                    'class' => Port::class,
                    'choice_label' => 'nom'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Navire::class,
        ]);
    }
}
