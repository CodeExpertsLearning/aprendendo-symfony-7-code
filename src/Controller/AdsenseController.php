<?php

namespace App\Controller;

use App\Entity\Adsense;
use App\Form\AdsenseType;
use App\Repository\AdsenseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/manager/adsenses', name: 'adsense_')]
class AdsenseController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(AdsenseRepository $adsenseRepository): Response
    {
        return $this->render('adsense/index.html.twig', [
            'adsenses' => $adsenseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $adsense = new Adsense();
        $form = $this->createForm(AdsenseType::class, $adsense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adsense->setCreatedAt();
            $adsense->setUpdatedAt();

            $entityManager->persist($adsense);
            $entityManager->flush();

            return $this->redirectToRoute('adsenses_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adsense/new.html.twig', [
            'adsense' => $adsense,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Adsense $adsense): Response
    {
        return $this->render('adsense/show.html.twig', [
            'adsense' => $adsense,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Adsense $adsense, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdsenseType::class, $adsense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adsense->setUpdatedAt();

            $entityManager->flush();

            return $this->redirectToRoute('adsenses_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adsense/edit.html.twig', [
            'adsense' => $adsense,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Adsense $adsense, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $adsense->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($adsense);
            $entityManager->flush();
        }

        return $this->redirectToRoute('adsenses_index', [], Response::HTTP_SEE_OTHER);
    }
}
