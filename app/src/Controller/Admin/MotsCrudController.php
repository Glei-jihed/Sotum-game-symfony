<?php

namespace App\Controller\Admin;

use App\Entity\Mots;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MotsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mots::class;
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
