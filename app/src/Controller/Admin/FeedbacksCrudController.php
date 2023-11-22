<?php

namespace App\Controller\Admin;

use App\Entity\Feedbacks;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FeedbacksCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Feedbacks::class;
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
