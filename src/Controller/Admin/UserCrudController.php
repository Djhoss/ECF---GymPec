<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use Symfony\Component\Form\FormTypeInterface;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {        
        
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('firstname', 'Prénom'),
            TextField::new('lastname', 'Nom'),
            TextField::new('password', 'Mot de passe'),
            EmailField::new('email', 'Email'),
            ChoiceField::new('roles')
            ->setPermission('ROLE_ADMIN')

            ->allowMultipleChoices()->setChoices([
                'client' => 'client',
                'Administrateur' => 'ROLE_ADMIN',
                'Partenaire' => 'ROLE_PARTNER',
                'Technicien' => 'ROLE_TECHNICIAN',
            ]),

        ];
    }
}
