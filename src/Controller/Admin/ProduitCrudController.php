<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Moneyfield;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            SlugField::new('slug')->setTargetFieldName('nom')->hideOnIndex(),
            TextEditorField::new('description'),
            TextEditorField::new('infoComplementaire')->hideOnIndex(),
            Moneyfield::new('prix')->setCurrency('USD'),
            IntegerField::new('quantite'),
            TextField::new('tags'),
            BooleanField::new('meileureVente'),
            BooleanField::new('nouvelleArrivage'),
            BooleanField::new('isFeaturead', 'Featured'),
            BooleanField::new('offreSpeciale'),
            AssociationField::new('categories'),
            ImageField::new('image')->setBasePath('assets/upload/produits/')
                                    ->setUploadDir('public/assets/upload/produits/')
                                    ->setRequired(false),
        ];
    }
}
