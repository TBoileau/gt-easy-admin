<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\FeatureValueType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\DateTimeFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductCrudController extends AbstractCrudController
{
    public function __construct(private string $uploadDir)
    {
    }

    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(DateTimeFilter::new('updatedAt', 'Dernière mise à jour'))
            ->add(TextFilter::new('name', 'Nom'))
            ->add(EntityFilter::new('category', 'Catégorie'));
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Produits')
            ->setEntityLabelInSingular('Produit')
            ->setDateTimeFormat(DateTimeField::FORMAT_LONG, DateTimeField::FORMAT_SHORT)
            ->setDefaultSort(['updatedAt' => 'desc']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield ImageField::new('image', 'Image')
            ->setBasePath($this->uploadDir)
            ->hideOnForm();
        yield TextField::new('name', 'Nom');
        yield DateTimeField::new('updatedAt', 'Dernière modification')->hideOnForm();
        yield MoneyField::new('price', 'Prix')->setCurrency('EUR');
        yield PercentField::new('tax', 'TVA');
        yield TextField::new('file', 'Image')
            ->setFormType(VichImageType::class)
            ->onlyOnForms();
        yield AssociationField::new('category', 'Catégorie')
            ->setCrudController(CategoryCrudController::class);
        yield CollectionField::new('features', 'Caractéristiques')
            ->setEntryIsComplex(true)
            ->setEntryType(FeatureValueType::class)
            ->setTemplatePath('admin/product/features.html.twig');
    }
}
