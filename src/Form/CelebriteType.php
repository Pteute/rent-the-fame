<?php

namespace App\Form;

use App\Entity\Activite;
use App\Entity\Celebrite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CelebriteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('metier')
            ->add('fame')
            ->add('imageUpload', FileType::class, [
                'required' => false,
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg'
                        ],
                        'mimeTypesMessage' => "L'image n'est pas dans un format valide"
                    ])
                ]
            ])
            ->add('activites', EntityType::class, [
                'class' => Activite::class,
                'choice_label' => 'nom',
                'multiple' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Celebrite::class,
        ]);
    }
}
