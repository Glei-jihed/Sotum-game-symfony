<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    #[Route("/profile/update", name: "profile_update", methods: ["POST"])]
    public function updateProfile(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, SluggerInterface $slugger): Response
    {
        $user = $this->getUser(); // Récupère l'utilisateur connecté

        // Récupérez les données du formulaire
        $username = $request->request->get('username');
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        $confirmPassword = $request->request->get('confirm_password');
        $profilePictureFile = $request->files->get('profilePicture');

        // Mettez à jour l'entité User
        $user->setUsername($username);
        $user->setEmail($email);

        if ($password && $confirmPassword) {
            if ($password !== $confirmPassword) {
                $this->addFlash('error', 'Les mots de passe ne correspondent pas.');
                return $this->redirectToRoute('app_profile');
            }

            $user->setPassword($passwordHasher->hashPassword($user, $password));
        }

        if ($profilePictureFile instanceof UploadedFile) {
            $originalFilename = pathinfo($profilePictureFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$profilePictureFile->guessExtension();

            try {
                $profilePictureFile->move(
                    $this->getParameter('kernel.project_dir').'/public/profile_pictures',
                    $newFilename
                );
            } catch (FileException $e) {
                // Gérer l'erreur d'upload ici
                $this->addFlash('error', 'Une erreur s\'est produite lors de l\'upload de l\'image.');
                return $this->redirectToRoute('app_profile');
            }

            // Mettez à jour le nom de fichier de l'image de profil
            $user->setProfilePicture($newFilename);
        }

        // Enregistrez les modifications
        $entityManager->persist($user);
        $entityManager->flush();

        // Redirigez vers la page de profil avec un message de confirmation
        $this->addFlash('success', 'Profil mis à jour avec succès !');
        return $this->redirectToRoute('app_profile');
    }
}
