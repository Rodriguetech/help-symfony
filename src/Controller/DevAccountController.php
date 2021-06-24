<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DevAccountController extends AbstractController
{
    #[Route('/dev/account', name: 'dev_account')]
    public function index(): Response
    {
        return $this->render('dev_account/index.html.twig', [
            'controller_name' => 'DevAccountController',
        ]);
    }
}
