<?php

namespace App\Controller;

use App\Entity\Adsense;
use App\Repository\AdsenseRepository;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/manager/adsenses', name: 'adsenses_')]
class AdsenseController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(AdsenseRepository $adsRepository): Response
    {
        $adsenses = $adsRepository->findAll();

        return $this->render('adsense/index.html.twig', compact('adsenses'));
    }

    #[Route('/{slug}', name: 'edit')]
    public function edit(AdsenseRepository $adsRepository, string $slug): Response
    {
        $ads = $adsRepository->findOneBySlug($slug);

        if (!$ads) throw $this->createNotFoundException('Anúncio não encontrado!');

        return $this->render('adsense/edit.html.twig', compact('ads'));
    }

    #[Route('/test', name: 'test')]
    public function test(EntityManagerInterface $manager, AdsenseRepository $repo): Response
    {
        //Inserção com Doctrine

        // $tmz = new DateTimeZone('America/Sao_Paulo');

        // $ads = new Adsense();
        // $ads->setTitle('Titulo Teste');
        // $ads->setDescription('Descrição Anúncio');
        // $ads->setBody('Conteúdo anúncio');
        // $ads->setSlug('titulo-teste');
        // $ads->setCreatedAt(new \DateTimeImmutable('now', $tmz));
        // $ads->setUpdatedAt(new \DateTimeImmutable('now', $tmz));

        // $manager->persist($ads);
        // $manager->flush();


        //Atualizando dados...
        // $ads = $repo->findOneBySlug('titulo-teste');

        // $ads->setTitle('Titulo Teste Editado');

        // $manager->flush();

        //Removendo dados...
        // $ads = $repo->findOneBySlug('titulo-teste');

        // $manager->remove($ads);
        // $manager->flush();

        return new Response('Teste...');
    }
}
