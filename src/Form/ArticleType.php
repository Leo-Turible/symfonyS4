<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Fournisseur;
use App\Repository\FournisseurRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $departement = $options['departement'];
        $builder
            ->add('designation')
            ->add('description')
            ->add('prix')
            ->add('quantiteDisponible')
            ->add('fournisseur', EntityType::class, [
                'class' => Fournisseur::class,
                'choice_label' => 'id',
                'query_builder' => function (FournisseurRepository $fournisseurRepository) use ($departement) {
                    return $fournisseurRepository->createQueryBuilder('f')
                        ->innerJoin('f.adresse', 'a')
                        ->where('a.codePostal LIKE :departement')
                        ->setParameter('departement', $departement.'%')
                        ->orderBy('f.id', 'ASC');
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'departement' => null,
        ]);
    }
}
