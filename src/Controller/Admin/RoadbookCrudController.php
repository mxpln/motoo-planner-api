<?php

namespace App\Controller\Admin;

use App\Entity\Roadbook;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RoadbookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Roadbook::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
