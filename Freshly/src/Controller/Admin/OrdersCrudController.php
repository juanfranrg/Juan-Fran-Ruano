<?php

namespace App\Controller\Admin;

use App\Entity\Orders;
use App\Entity\CountryLang;
use App\Entity\OrderDetail;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OrdersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Orders::class;
    }

    /*public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAG_INDEX, Action::order_details);
    }*/
    public function configureFields(string $pageName): iterable
    {
        
        return [

            TextField::new('reference', 'Reference ORDER'),
            DateTimeField::new('date_add', 'Date'),
            TextField::new('total_paid'),
            AssociationField::new('id_address', 'Address and Country'),
            AssociationField::new('id_customer', 'Name and Surname'),
            AssociationField::new('current_state', 'State'),
            //CollectionField::new('details', 'Products')
            //    ->setTemplatePath('detail.html.twig'), 
            //CollectionField::new('order_details', 'Order Details'),

        ];
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('id_address')
            ->add('id_customer')
            ->add('current_state')
            ->add('reference')
            ->add('total_paid')
            ->add('date_add')
        ;
    }
    /*public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setNumberFormat('%.2d');
        ;
    }*/
    
}
