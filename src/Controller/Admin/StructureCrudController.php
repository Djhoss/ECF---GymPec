<?php

namespace App\Controller\Admin;

use App\Entity\Structure;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;



    

class StructureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Structure::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom du manager'),      
            ImageField::new('illustration', 'Image du club')
            ->setBasePath('club')
                ->setUploadDir('public/club')
                ->setUploadedFileNamePattern("[randomhash].[extension]")
                ->setRequired(false)
                ,
            EmailField::new('mail', 'Email de la structure'),
            TextField::new('city', 'Ville'),
            TextField::new('adress', 'Adresse'),
            TextField::new('postal_code', 'Code postal'),
            TextareaField::new('description'),
            AssociationField::new('partenaire'),
            BooleanField::new('open', 'Structures active'),
        ];
    }
}

