<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AppController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('app/index.html.twig', []);
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
