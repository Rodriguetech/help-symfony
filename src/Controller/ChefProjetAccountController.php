<?php

namespace App\Controller;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChefProjetAccountController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager ) {
        $this->entityManager = $entityManager;
    }


    #[Route('/chef', name: 'chef_projet_account')]
    public function index(): Response
    {



        return $this->render('chef_projet_account/index.html.twig');
    }

    //listes des clients

    #[Route('/chef/list_client', name: 'chef_client')]
    public function listClient(): Response
    {

        $role = $this->entityManager->getRepository(User::class)->findByRoleClient();

        Return $this->render('chef_projet_account/client.html.twig', [
           'role' => $role
        ]);

    }


    #[Route('/chef/list_dev', name: 'chef_dev')]
    public function listDev(): Response
    {
        $role = $this->entityManager->getRepository(User::class)->findByRoleDev();

        Return $this->render('chef_projet_account/dev.html.twig', [
            'role' => $role
        ]);
    }
}
