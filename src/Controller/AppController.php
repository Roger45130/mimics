<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AppController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductRepository $repoProduct): Response
    {
        /*
            Exo :
            1. Sélectionner tout les produits enregistrés en BDD.
            2. Transmettre au template les produits sélectionnées (render()). 
            3. Réaliser le traitement permettant d'afficher les produits dans le template 'app/index.html.twig' . 
            4. Créer une nouvelle méthode appProductDetails avec la route 'app/product/details/{id}' / app_product_details, nouveau template 'app/product/details.html.twig' . 
            5. Sélectionner en BDD le produit.
            6. Afficher les informations du produit (titre, référence, image etc...)
        */

        $db_product = $repoProduct->findAll();
        // dump($db_product);

        return $this->render('app/index.html.twig', [
            'dbProduct' => $db_product
        ]);
    }

    #[Route('/product/details/{id}', name: 'app_product_details')]
    public function appProductDetails($id, ProductRepository $repoProduct): Response
    {
        $product = $repoProduct->find($id);
        // dump($product);

        return $this->render('app/product.details.html.twig', ['product' => $product]);
    }

    #[Route('/products', name: 'app_products')]
    public function appProducts(): Response
    {
        return $this->render('app/products.html.twig', []);
    }

    #[Route('/about', name: 'app_about')]
    public function appAbout(): Response
    {
        return $this->render('app/about.html.twig', []);
    }

    #[Route('/why', name: 'app_why')]
    public function appWhy(): Response
    {
        return $this->render('app/why.html.twig', []);
    }

    #[Route('/testimonrial', name: 'app_testimonrial')]
    public function appTestimonrial(): Response
    {
        return $this->render('app/testimonrial.html.twig', []);
    }

    #[Route('/myaccount', name: 'app_my_account')]
    public function appMyAccount(): Response
    {
        $user = $this->getUser();
        return $this->render('app/account.html.twig', []);
    }
}
