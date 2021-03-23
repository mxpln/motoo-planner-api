<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstName', 'Prénom'),
            TextField::new('lastName', 'Nom'),
            TextField::new('email', 'Email'),
            ArrayField::new('roles', 'Rôles'),
            TextField::new('password', 'Mot de passe'),
            TextField::new('avatar', 'Avatar'),
            DateTimeField::new('createdAt', 'Date de création'),
            DateTimeField::new('updatedAt', 'Date de modification')
        ];
    }

    public function configureUserMenu(UserInterface $user) {
        return parent::configureUserMenu($user)
            ->setName($user->getUserName())
            ->setAvatarUrl('https://eu.ui-avatars.com/api/?name=' . $user->getFirstName() . '+' . $user->getLastName())
            ->displayUserAvatar(true);
    }
}
