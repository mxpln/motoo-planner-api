<?php

namespace App\Controller\Admin;

use App\Entity\Suggestion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SuggestionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Suggestion::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom'),
            TextField::new('picture'),
            TextField::new('address', 'Adresse'),
            TextField::new('zipCode', 'Code postal'),
            TextField::new('city', 'Ville'),
            TextField::new('country', 'Pays'),
            TextField::new('phone', 'Téléphone'),
            TextField::new('description', 'Description'),
            TextField::new('picture', 'Image'),
            DateTimeField::new('createdAt', 'Date de création'),
            DateTimeField::new('updatedAt', 'Date de modification'),
            NumberField::new('suggestLat', 'Latitude')
                ->setCustomOption('numDecimals', 5),
            NumberField::new('suggestLong', 'Longitude')
                ->setCustomOption('numDecimals', 5),
            AssociationField::new('categories', 'Catégorie')
        ];
    }
}
