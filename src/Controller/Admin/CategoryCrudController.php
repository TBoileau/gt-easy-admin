<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Catégories')
            ->setEntityLabelInSingular('Catégorie')
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
