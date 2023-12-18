<?php

namespace App\Controller;

use App\Entity\Meal;
use App\Entity\Planner;
use App\Entity\User;
use App\Form\AdminType;
use App\Form\DbMealType;
use App\Form\MealType;
use App\Form\Planner1Type;
use App\Repository\MealRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{

    // ======= Admin controller for Users ======


    #[Route('/', name: 'app_admin_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin/UsersDashboard/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/mealDashboard', name: 'app_mealDashboard_index', methods: ['GET'])]
    public function mealDashboard(MealRepository $mealRepository): Response
    {
        // Fetch only approved meals
        // $approvedMeals = $mealRepository->findApprovedMeals();

        return $this->render('admin/MealDashboard/meal_dashboard.html.twig', [
            'meals' => $mealRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(AdminType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/UsersDashboard/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('admin/UsersDashboard/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_edit', methods: ['GET', 'POST'])]
    public function edit($id, UserRepository $userRepo, Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdminType::class, $user);
        $form->handleRequest($request);
        $specUser = $userRepo->find($id);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/UsersDashboard/edit.html.twig', [
            'user' => $specUser,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/deleteUser', name: 'app_admin_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/ban/{id}', name: 'app_admin_ban', methods: ['GET'])]
    public function banUser(User $user, EntityManagerInterface $entityManager): Response
    {
        $user->setIsBanned(!$user->isIsBanned());
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
    }

    // ======= Admin controller for the Meal ======

    #[Route('/{id}/showMeal', name: 'app_mealDashboard_show', methods: ['GET', 'POST'])]
    public function mealDbShow(Meal $meal, Request $request, EntityManagerInterface $entityManager): Response
    {
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

        return $this->render('admin/MealDashboard/DbShow.html.twig', [
            'meal' => $meal,
            'planner' => $planner,
            'plan' => $plan,
        ]);
    }

    #[Route('/{id}/editMeal', name: 'app_mealDashboard_edit', methods: ['GET', 'POST'])]
    public function MealDbEdit(Request $request, Meal $meal, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DbMealType::class, $meal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_mealDashboard_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/MealDashboard/DbEdit.html.twig', [
            'meal' => $meal,
            'DbForm' => $form,
        ]);
    }

    #[Route('/{id}/deleteMeal', name: 'app_mealDashboard_delete', methods: ['POST'])]
    public function MealDbDelete(Request $request, Meal $meal, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $meal->getId(), $request->request->get('_token'))) {
            $entityManager->remove($meal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_mealDashboard_index', [], Response::HTTP_SEE_OTHER);
    }
    // This is for the Planner
    // public function planner(Request $request, EntityManagerInterface $entityManager): Response
    // {

    // }

    public function approveMeal(Meal $meal, EntityManagerInterface $entityManager)
    {
        // Handle approval logic
        $meal->setIsVerified(true);
        $entityManager->persist($meal);
        $entityManager->flush();

        // Redirect or return a response
    }

    public function removeMeal(Meal $meal, EntityManagerInterface $entityManager)
    {
        // Handle removal logic
        $entityManager->remove($meal);
        $entityManager->flush();

        // Redirect or return a response
    }
}
