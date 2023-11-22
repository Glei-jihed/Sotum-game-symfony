<?php

namespace App\Controller\Admin;

use App\Entity\Classements;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ClassementsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Classements::class;
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
