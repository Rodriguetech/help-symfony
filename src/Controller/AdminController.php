<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Invite;
use App\Entity\User;
use App\Form\EditUserType;
use App\Form\InviteType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin_')]

class AdminController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }


    //Affichages des utilisateurs

    #[Route('/', name: 'index')]
    public function index(UserRepository $user): Response
    {
        return $this->render('admin/index.html.twig', [
            'user' => $user ->findAll()
        ]);

    }

    #[Route('/edit/{id}', name: 'edit_user')]
    public function editUser(User $user , Request $request): Response
    {

        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form ->isValid()){
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this ->addFlash('message' , 'Utilisateur modifié avec succès');

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/edit_user.html.twig',[
            'userForm' => $form->createView()
        ]);
    }


    #[Route('/invitation/user', name: 'invitation')]
    public function inviteUser(Request $request): Response
    {
        $notification = null;
        $invite = new Invite();
        $form = $this->createForm(InviteType::class, $invite);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $email = $form['email']->getData();

            $invite->setEmail($email);

            $this->entityManager->persist($invite);
            $this->entityManager->flush();

            $link = "https://127.0.0.1:8000/inscription";

            $mail = new Mail();
            $content = "Bonjour je suis Administrateur du CRM . Vous pouvez maintenant vous inscrire " . "<a class='text-warning' style='text-decoration: none;' href='$link'> Cliqué ici </a>";
            $mail->send($invite->getEmail(), 'Invitation', 'Vous êtes invités à vous inscrire', $content);

            $notification = "Invitation envoyé avec succès ";
        }
        return $this->render('admin/invite.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);

    }
}
