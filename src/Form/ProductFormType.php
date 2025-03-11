<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\File;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference', TextType::class, [
                'label' => "Référence",
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => "Veuillez saisir une référence"
                    ])
                ]
            ])
            ->add('title', TextType::class, [
                'label' => "Title",
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => "Veuillez saisir un titre"
                    ])
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => "Description",
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => "Veuillez saisir une description"
                    ])
                ],
                'attr' => [
                    'row' => 10
                ]
            ])
            ->add('color', ChoiceType::class, [
                'label' => "Couleur",
                'choices' => [
                    'Blanc' => 'blanc',
                    'Noir' => 'noir',
                    'Gris sidéral' => 'gris sidéral',
                    'Bleu' => 'bleu',
                    'Rose' => 'rose'
                ]
            ])
            ->add('size', ChoiceType::class, [
                'label' => "Mémoire",
                'choices' => [
                    '128Go' => '128Go',
                    '256Go' => '256Go',
                    '512Go' => '512Go'
                ]
            ])
            ->add('gender', ChoiceType::class, [
                'label' => "Genre",
                'choices' => [
                    'Homme' => 'homme',
                    'Femme' => 'femme',
                    'Mixte' => 'mixte'
                ]
            ])
            ->add('picture', FileType::class, [
                'label' => "Photo produit",
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '100M',
                        'mimeTypes' => [
                            'images/jpeg',
                            'images/png',
                            'images/jpg',
                        ],
                        'mimeTypesMessage' => "Format autorisés : jpg/jpeg/png"
                    ])
                ]
            ])
            ->add('stock', TextType::class, [
                'label' => "Stock",
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => "Veuillez saisir un stock"
                    ])
                ]
            ])
            ->add('price', TextType::class, [
                'label' => "Prix",
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => "Veuillez saisir un prix"
                    ])
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title',
            ])
            /*
                ->add('category' : correspond à la clé étrangère SQL category.
                Ici c'est un champs qui provient d'une autre table SQL donc un champ EntityType, cela va générer dans le formulaire, une liste déroulante avtoute les catégories et les titres des catégorie dans les options du sélecteurs.
                */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
