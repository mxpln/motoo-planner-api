<?php

namespace App\Controller\Admin;

use App\Entity\Step;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StepCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Step::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            DateTimeField::new('stepDate', "Date de l'étape"),
            TextField::new('title', 'titre'),
            TextField::new('description', 'Description'),
            NumberField::new('stepLat', 'Latitude')
                ->setCustomOption('numDecimals', 5),
            NumberField::new('stepLong', 'Longitude')
                ->setCustomOption('numDecimals', 5),
            AssociationField::new('roadbook', 'Roadbook'),
            AssociationField::new('suggestion', 'Suggestion'),
        ];
    }
}
