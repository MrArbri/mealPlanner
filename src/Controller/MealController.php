<?php

namespace App\Controller;

use App\Entity\Planner;
use App\Form\Planner1Type;


use App\Entity\Meal;
use App\Form\MealType;
use App\Repository\MealRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/meal')]
class MealController extends AbstractController
{
    #[Route('/', name: 'app_meal_index', methods: ['GET'])]
    public function index(MealRepository $mealRepository): Response
    {

        return $this->render('meal/index.html.twig', [
            'meals' => $mealRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_meal_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $meal = new Meal();
        $form = $this->createForm(MealType::class, $meal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $meal->setCreator($this->getUser());
            $entityManager->persist($meal);
            $entityManager->flush();

            return $this->redirectToRoute('app_meal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('meal/new.html.twig', [
            'meal' => $meal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_meal_show', methods: ['GET', 'POST'])]
    public function show(Meal $meal, Request $request, EntityManagerInterface $entityManager): Response
    {
        // This is for the planner
        $planner = new Planner();
        $plan = $this->createForm(Planner1Type::class, $planner);
        $plan->handleRequest($request);

        if ($plan->isSubmitted() && $plan->isValid()) {
            $planner->setFkUser($this->getUser());
            $entityManager->persist($planner);
            $entityManager->flush();
           

            return $this->redirectToRoute('app_planner1_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('meal/show.html.twig', [
            'meal' => $meal,
            'planner' => $planner,
            'plan' => $plan,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_meal_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Meal $meal, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MealType::class, $meal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_meal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('meal/edit.html.twig', [
            'meal' => $meal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_meal_delete', methods: ['POST'])]
    public function delete(Request $request, Meal $meal, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $meal->getId(), $request->request->get('_token'))) {
            $entityManager->remove($meal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_meal_index', [], Response::HTTP_SEE_OTHER);
    }
// This is for the Planner
    // public function planner(Request $request, EntityManagerInterface $entityManager): Response
    // {
        
    // }
}
