<?php

namespace App\Controller;

use App\Entity\Continent;
use App\Entity\Country;
use App\Form\FormlandType;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Request;
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
    public function updateshower( EntityManagerInterface $entityManager , Request $request, int $id): Response
    {
//        $id = $countryclass->getId();
        $update = $entityManager->getRepository(Country::class)->findBy($id);
        $update = new Country();
        $form = $this->createForm(FormlandType::class, $update);
        $form->handleRequest($request);



            if ($form->isSubmitted() && $form->isValid()){
              $data  = $form->getData();
                $entityManager->persist($form);
                $entityManager->flush($form);
            $this->redirectToRoute('home');
            }
        return $this->renderForm('update.html.twig', [
            'form' => $form
        ]);

        #[Route('/update/{id}', name: 'refresh')]
public function inserten( EntityManagerInterface $entityManager , int $id): Response
{
//
        $update = new Country();
        $form = $this->createForm(FormlandType::class, $update);



        if ($form->isSubmitted() && $form->isValid()){
            $data  = $form->getData();
            $entityManager->persist($);
            $entityManager->flush($);
//            $this->redirectToRoute('home');
        }
        return $this->renderForm('update.html.twig', [
            'form' => $form
        ]);


    }


