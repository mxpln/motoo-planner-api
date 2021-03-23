<?php

namespace App\Controller\Admin;

use App\Entity\Checklist;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ChecklistCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Checklist::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('task', 'tâches'),
            AssociationField::new('roadbook', 'Roadbook'),
        ];
    }
}
