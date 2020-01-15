<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::class,
                $this->getConfiguration('Titre', 'Titre de l\'annonce')
            )
            ->add(
                'slug',
                TextType::class,
                $this->getConfiguration('Adresse web', 'Adresse web (automatique)', [
                    'required' => false
                ])
            )
            ->add(
                'coverImage',
                UrlType::class,
                $this->getConfiguration('URL image principale', 'Adresse d\'une image')
            )
            ->add(
                'introduction',
                TextType::class,
                $this->getConfiguration('Introduction', 'Description globale de l\'annonce')
            )
            ->add(
                'rooms',
                IntegerType::class,
                $this->getConfiguration('Nombre de chambres', 'Nombre de chambres disponnibles')
            )
            ->add(
                'price',
                MoneyType::class,
                $this->getConfiguration('Prix par nuit', 'Indiquez le prix pour une nuit')
            )
            ->add(
                'images',
                CollectionType::class,
                [
                    'entry_type' => ImageType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                ]
        )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
