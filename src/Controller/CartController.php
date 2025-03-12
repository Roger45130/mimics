<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

final class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function cart(SessionInterface $session, ProductRepository $repoProduct): Response
    {
        $cart = $session->get('cart');
        dump($cart);

        $dataCart = [];
        $total = 0;

        // On boucle la session
        // $id stock receptionne pour chaque tour de boucle 1 id d'un produit
        // $quantity réceptionne pour chaque tour de boucle une quantité saisi du produit
        if (!empty($cart)) {
            foreach ($cart as $id => $quantity) {
                // On sélectionne en BDD les informations des produits
                $product = $repoProduct->find($id);
                // dump($product);
                // On ajoute dans le tableau ARRAY les données
                $dataCart[] = [
                    "product" => $product,  // on envoi Entity Product directement dans l'ARRAY
                    'quantity' => $quantity
                ];
                // Calcul du montant total de la commande
                $total += $product->getPrice() * $quantity;
                dump($dataCart);
                dump($total);
            }
        }

        return $this->render('cart/index.html.twig', [
            'dataCart' => $dataCart,
            'total' => $total
        ]);
    }

    #[Route('/cart/add/{id}', name: 'app_cart_add')]
    public function cardAdd(Request $request, Product $product, SessionInterface $session)
    {
        // dump($request);
        // dump($product);

        // Création du panier dans la session
        $cart = $session->get("cart", []);
        // On stock l'id du produit à ajouter dans le panier dans une variable
        $id = $product->getId();
        // On stock la quantity saisie dans le formulaire dans une variable
        $quantity = $request->request->get("quantity");

        // dump($cart);
        // dump($id);
        // dump($quantity);

        if (!empty($cart[$id])) {
            // dump('if produit existe dans le panier');
            $cart[$id] = $cart[$id] + $quantity;
        } else {
            // dump('else produit inexiste dans le panier');
            $cart[$id] = $quantity;
        }

        $session->set("cart", $cart);

        // dump($cart);

        return $this->redirectToRoute('app_cart');
    }
}
