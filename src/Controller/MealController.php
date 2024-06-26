<?php

namespace App\Controller;

use App\Entity\Planner;
use App\Form\Planner1Type;


use App\Entity\Meal;
use App\Form\MealType;
use App\Message\MealCreatedNotification;
use App\Repository\MealRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;



#[Route('/meal')]
class MealController extends AbstractController
{

    private $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    #[Route('/', name: 'app_meal_index', methods: ['GET'])]
    public function index(MealRepository $mealRepository): Response
    {
        // Fetch only approved meals
        $approvedMeals = $mealRepository->findApprovedMeals();
        $user = $this->getUser();

        return $this->render('meal/index.html.twig', [
            'meals' => $approvedMeals,
            'user' => $user
        ]);
    }

    #[Route('/filter', name: 'app_filter', methods: ['GET'])]
    public function filter(Request $request, mealRepository $mealRepository): Response
    {
        $user = $this->getUser();

        $filterName = $request->query->get('type');
    
        $filteredMeals = $mealRepository->findBy(['type' => $filterName]);
    
        return $this->render('meal/index.html.twig', [
            'meals' => $filteredMeals,
            'user' => $user
        ]);
    }

    #[Route('/calories300', name: 'app_filter300', methods: ['GET'])]
    public function filter300(MealRepository $mealRepository): Response
    {
    // Filter meals with calories under 300
    $user = $this->getUser();
    $filteredMeals = $mealRepository->findMealsWithCaloriesUnder300();

    return $this->render('meal/index.html.twig', [
        'meals' => $filteredMeals,
        'user' => $user
    ]);
    }
    #[Route('/calories400', name: 'app_filter400', methods: ['GET'])]
    public function filter400(MealRepository $mealRepository): Response
    {
    // Filter meals with calories under 400
    $user = $this->getUser();
    $filteredMeals = $mealRepository->findMealsWithCaloriesUnder400();

    return $this->render('meal/index.html.twig', [
        'meals' => $filteredMeals,
        'user' => $user
    ]);
    }
    #[Route('/calorie500', name: 'app_filter500', methods: ['GET'])]
    public function filter500(MealRepository $mealRepository): Response
    {
    // Filter meals with calories under 500
    $user = $this->getUser();
    $filteredMeals = $mealRepository->findMealsWithCaloriesUnder500();

    return $this->render('meal/index.html.twig', [
        'meals' => $filteredMeals,
        'user' => $user
    ]);
    }
    #[Route('/calories600', name: 'app_filter600', methods: ['GET'])]
    public function filter600(MealRepository $mealRepository): Response
    {
    // Filter meals with calories under 600
    $user = $this->getUser();
    $filteredMeals = $mealRepository->findMealsWithCaloriesUnder600();

    return $this->render('meal/index.html.twig', [
        'meals' => $filteredMeals,
        'user' => $user
    ]);
    }
    #[Route('/calories700', name: 'app_filter700', methods: ['GET'])]
    public function filter700(MealRepository $mealRepository): Response
    {
    // Filter meals with calories under 700
    $user = $this->getUser();
    $filteredMeals = $mealRepository->findMealsWithCaloriesUnder700();

    return $this->render('meal/index.html.twig', [
        'meals' => $filteredMeals,
        'user' => $user
    ]);
    }
    #[Route('/calories800', name: 'app_filter800', methods: ['GET'])]
    public function filter800(MealRepository $mealRepository): Response
    {
    // Filter meals with calories under 800
    $user = $this->getUser();
    $filteredMeals = $mealRepository->findMealsWithCaloriesUnder800();

    return $this->render('meal/index.html.twig', [
        'meals' => $filteredMeals,
        'user' => $user
    ]);
    }
    #[Route('/calories900', name: 'app_filter900', methods: ['GET'])]
    public function filter900(MealRepository $mealRepository): Response
    {
    // Filter meals with calories under 900
    $user = $this->getUser();
    $filteredMeals = $mealRepository->findMealsWithCaloriesUnder900();

    return $this->render('meal/index.html.twig', [
        'meals' => $filteredMeals,
        'user' => $user
    ]);
    }
    #[Route('/calories1000', name: 'app_filter1000', methods: ['GET'])]
    public function filter1000(MealRepository $mealRepository): Response
    {
    // Filter meals with calories under 1000
    $user = $this->getUser();
    $filteredMeals = $mealRepository->findMealsWithCaloriesUnder1000();

    return $this->render('meal/index.html.twig', [
        'meals' => $filteredMeals,
        'user' => $user
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

            // Send notification to admin
            $this->sendNotificationToAdmin($meal);

            return $this->redirectToRoute('app_meal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('meal/new.html.twig', [
            'meal' => $meal,
            'form' => $form,
        ]);
    }

    private function sendNotificationToAdmin(Meal $meal)
    {
        // Send a message to notify the admin
        $this->messageBus->dispatch(new MealCreatedNotification($meal));
    }

    #[Route('/{id}', name: 'app_meal_show', methods: ['GET', 'POST'])]
    public function show(Meal $meal, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        // This is for the planner
        $planner = new Planner();
        $plan = $this->createForm(Planner1Type::class, $planner);
        $plan->handleRequest($request);

        if ($plan->isSubmitted() && $plan->isValid()) {
            $planner->setFkUser($this->getUser());
            $planner->setFkMeal($meal);
            $entityManager->persist($planner);
            $entityManager->flush();


            return $this->redirectToRoute('app_planner1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('meal/show.html.twig', [
            'meal' => $meal,
            'planner' => $planner,
            'plan' => $plan,
            'user' => $user
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

    #[Route('/delete/{id}', name: 'app_meal_delete', methods: ['GET'])]
    public function delete(Meal $meal, EntityManagerInterface $entityManager): Response
    {
        
        $entityManager->remove($meal);
        $entityManager->flush();
        

        return $this->redirectToRoute('app_meal_index', [], Response::HTTP_SEE_OTHER);
    }
    // This is for the Planner
    // public function planner(Request $request, EntityManagerInterface $entityManager): Response
    // {

    // }

    // public function approveMeal(Meal $meal, EntityManagerInterface $entityManager)
    // {
    //     // Handle approval logic
    //     $meal->setIsVerified(true);
    //     $entityManager->persist($meal);
    //     $entityManager->flush();

    //     // Redirect or return a response
    // }


    // public function removeMeal(Meal $meal, EntityManagerInterface $entityManager)
    // {
    //     // Handle removal logic
    //     $entityManager->remove($meal);
    //     $entityManager->flush();

    //     // Redirect or return a response
    // }
}
