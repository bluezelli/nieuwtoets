<?php

namespace App\Controller;

use App\Entity\Continent;
use App\Entity\Country;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandController extends AbstractController
{




    #[Route('/', name: 'continent')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $continent = $entityManager->getRepository(Continent::class)->findAll();
        return $this->render('land/index.html.twig', [
            'continent' => $continent
        ]);
    }

    #[Route('/landen/{id}', name: 'land')]
    public function landenshower(EntityManagerInterface $entityManager , int $id): Response
    {
        $land = $entityManager->getRepository(Country::class)->find($id);
        return $this->render('land/index.html.twig', [
            'land'=> $land
        ]);
    }

    #[Route('/update/{id}', name: 'refresh')]
    public function updateshower(EntityManagerInterface $entityManager , int $id): Response
    {
        $update = $entityManager->getRepository(Country::class)->find($id);
        $update = new Country();
        $form = $this->createForm()

        return $this->render('land/index.html.twig', [
//            'land'=> $land
        ]);
    }

    #[Route('/update/{id}', name: 'update')]
    public function update(AutosRepository $autosRepository, Autos $autoClass , EntityManagerInterface $entityManager, Request $request)
    {
        $id = $autoClass->getId();
        $auto = new Autos();
        $auto->$autosRepository->find($id);
        $form = $this->createForm(AutoFormType::class, $auto);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $auto = $form->getData();
            $entityManager->persist($auto);
            $entityManager->flush($auto);
//            $this->redirectToRoute('home');
        }
        return $this->renderForm('update.html.twig', [
            'form' => $form
        ]);


    }
