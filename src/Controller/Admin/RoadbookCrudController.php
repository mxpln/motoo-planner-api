<?php

namespace App\Controller\Admin;

use App\Entity\Roadbook;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RoadbookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Roadbook::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre'),
            TextField::new('description', 'Description'),
            DateTimeField::new('tripStart', 'Départ de la balade'),
            TextField::new('pictureURL', 'Image de couverture'),
            IntegerField::new('status', 'Status'),
            DateTimeField::new('createdAt', 'Date de création'),
            DateTimeField::new('updatedAt', 'Date de modification'),
            TextField::new('shareLink', 'Code de partage'),
            AssociationField::new('user', 'Utilisateur')
        ];
    }
}
