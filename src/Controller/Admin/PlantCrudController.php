<?php

namespace App\Controller\Admin;

use App\Entity\Plant;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PlantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Plant::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextField::new('getNextWatering', 'Next watering in (days):')->hideOnForm(),
            TextField::new('description'),
            IntegerField::new('minNumberOfDaysToWater')->onlyOnForms(),
            IntegerField::new('maxNumberOfDaysToWater')->onlyOnForms(),
            IntegerField::new('height'),

            ArrayField::new('fertilizers'),
            DateField::new('createdAt')->hideOnForm(),

        ];
    }
    public function setDate($plant)
    {
        if (!$plant instanceof Plant) {
            return;
        }
        $plant->setCreatedAt(new DateTimeImmutable());
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->setDate($entityInstance);
        parent::persistEntity($entityManager, $entityInstance);
    }


}
