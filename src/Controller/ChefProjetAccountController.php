<?php

namespace App\Controller;


use App\Entity\Projet;
use App\Entity\User;
use App\Form\ProjetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

        $projets = $this->entityManager->getRepository(Projet::class)->findAll();
        return $this->render('chef_projet_account/index.html.twig',[
            'projets' => $projets
        ]);
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



    #[Route('/chef/createproject', name: 'chef_create_project')]
    public function createProjet(Request $request): Response
    {

        $notification = null;
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $projet = $form->getData();

            $this->entityManager->persist($projet);
            $this->entityManager->flush();


            $notification = "Invitation envoyé avec succès ";
        }
        return $this->render('chef_projet_account/create_projet.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);

    }


/*
    #[Route('/chef/createtache', name: 'chef_create_tache')]
    public function createTache(): Response
    {
        Return $this->render('chef_projet_account/create_tache.html.twig');
    }
*/
}
