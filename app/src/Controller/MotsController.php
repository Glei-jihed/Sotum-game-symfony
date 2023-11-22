<?php

namespace App\Controller;

use App\Entity\Mots;
use App\Form\MotsType;
use App\Repository\MotsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mots')]
class MotsController extends AbstractController
{
    #[Route('/', name: 'app_mots_index', methods: ['GET'])]
    public function index(MotsRepository $motsRepository): Response
    {
        return $this->render('mots/index.html.twig', [
            'mots' => $motsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mots_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mot = new Mots();
        $form = $this->createForm(MotsType::class, $mot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($mot);
            $entityManager->flush();

            return $this->redirectToRoute('app_mots_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mots/new.html.twig', [
            'mot' => $mot,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mots_show', methods: ['GET'])]
    public function show(Mots $mot): Response
    {
        return $this->render('mots/show.html.twig', [
            'mot' => $mot,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mots_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mots $mot, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MotsType::class, $mot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_mots_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mots/edit.html.twig', [
            'mot' => $mot,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mots_delete', methods: ['POST'])]
    public function delete(Request $request, Mots $mot, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mot->getId(), $request->request->get('_token'))) {
            $entityManager->remove($mot);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_mots_index', [], Response::HTTP_SEE_OTHER);
    }
}
