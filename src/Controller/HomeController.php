<?php

namespace App\Controller;

use App\Repository\MealRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(MealRepository $mealRepository): Response
    {
        return $this->render('meal/index.html.twig', [
            'meals' => $mealRepository->findAll(),
        ]);
    }
}
