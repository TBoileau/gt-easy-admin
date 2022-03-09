<?php

namespace App\Controller\Admin;

use App\Entity\Feature;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;

class FeatureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Feature::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Caractéristiques')
            ->setEntityLabelInSingular('Caractéristique')
            ->setDefaultSort(['name' => 'asc']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters->add(TextFilter::new('name', 'Nom'));
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name', 'Nom');
    }
}
