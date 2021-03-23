<?php

namespace App\Controller\Admin;

use App\Entity\Information;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class InformationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Information::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom'),
            TextField::new('email', 'Email'),
            TextareaField::new('description', 'Description'),
            TextField::new('phone', 'Téléphone'),
            AssociationField::new('roadbook', 'Roadbook'),
        ];
    }
}
