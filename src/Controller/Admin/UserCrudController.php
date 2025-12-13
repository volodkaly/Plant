<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{

    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {


        if (!$entityInstance instanceof User) {
            return;
        }

        if ($entityInstance->getPassword()) {
            $entityInstance->setPassword(
                $this->passwordHasher->hashPassword(
                    $entityInstance,
                    $entityInstance->getPassword()
                )
            );
        }

        parent::persistEntity($entityManager, $entityInstance);
    }
    public static function getEntityFqcn(): string
    {
        return User::class;
    }




    public function configureFields(string $pageName): iterable
    {


        return [
            TextField::new('email'),
            ArrayField::new('roles'),
            TextField::new('customRole'),
            TextField::new('password')

        ];
    }





}
