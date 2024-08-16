<?php


namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('mail', TextType::class, [
                'label' => 'Adresse e-mail',
            ])
            ->add('date', DateType::class, [
                'label' => 'Date',
                'format' => 'dd-MM-yyyy',
                'widget' => 'single_text',
                'min' => new \DateTime('today'), // Définit la date minimale à aujourd'hui
            ])
            ->add('heure', TimeType::class, [
                'label' => 'Heure',
                'format' => 'HH:mm',
                'widget' => 'single_text',
                'min' => '11:00', // Définit l'heure minimale à 11h00
                'max' => '00:00', // Définit l'heure maximale à 00h00
            ])
            ->add('nombrePersonnes', IntegerType::class, [
                'label' => 'Nombre de personnes',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}

