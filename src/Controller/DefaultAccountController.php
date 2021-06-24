<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultAccountController extends AbstractController
{
    #[Route('/default/account', name: 'default_account')]
    public function index(): Response
    {
        return $this->render('default_account/index.html.twig', [
            'controller_name' => 'DefaultAccountController',
        ]);
    }
}
