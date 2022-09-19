<?php

namespace App\Controller\Admin;

use App\Controller\Mail;
use App\Entity\Partenaire;
use App\SendMail\Mail as SendMailMail;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PartenaireCrudController extends AbstractCrudController
{
    
    public static function getEntityFqcn(): string
    {
       
        return Partenaire::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Name', 'Nom du partenaire'),
            EmailField::new('Mail', 'Email du partenaire'),
            TextField::new('Structure'),
            BooleanField::new('Partenaire_active', 'Actif'),
        ];
    }
    
}
