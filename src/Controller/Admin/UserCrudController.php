<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    // 1. Ін'єктимо сервіс хешування паролів
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    ) {
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
                ->setFormType(PasswordType::class)
                ->onlyOnForms()
                ->setRequired($pageName === Crud::PAGE_NEW),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->hashPassword($entityInstance);
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->hashPassword($entityInstance);
        parent::updateEntity($entityManager, $entityInstance);
    }

    private function hashPassword($user): void
    {
        if (!$user instanceof User) {
            return;
        }

        $plainPassword = $user->getPassword();

        if (empty($plainPassword)) {
            return;
        }


        $hashedPassword = $this->userPasswordHasher->hashPassword($user, $plainPassword);
        $user->setPassword($hashedPassword);
    }
}
