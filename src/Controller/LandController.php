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
}
