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
use App\Repository\PlannerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{

    // ======= Admin controller for Users ======

    // (Getting notified for new recipes.)

    // #[Route('/', name: 'NavbarNumber', methods: ['GET'])]
    // public function verifyNumberOnNavbar(): Response
    // {
    //     return new Response("2");
    // }

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

    #[Route('/mealDashboard/ajax/newRecipe', name: 'app_mealDashboard_ajax', methods: ['GET', "POST"])]
    public function ajaxMealDashboard(MealRepository $mealRepository): Response
    {
        // Fetch only approved meals
        $unapprovedMeals = $mealRepository->findUnapprovedMeals();
        $length = count($unapprovedMeals);


        return new JsonResponse([
            'length' => $length,
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

    // ======= Admin controller for the Planner ======

    #[Route('/find/planners', name: 'app_adminplanner_index', methods: ['GET'])]
    public function adminPlannerIndex(PlannerRepository $plannerRepository): Response
    { 
        $MondayBreakfast = [];
        $MondayLunch = [];
        $MondayDinner= [];
            
        $monday = $plannerRepository->findBy(['day' => "Monday"]);
            foreach($monday as $time){
                
                if($time->getTime() == "Breakfast"){
                    array_push($MondayBreakfast, $time);
                }else if ($time->getTime() == "Lunch"){
                    array_push($MondayLunch, $time);}
                    else if ($time->getTime() == "Dinner"){
                        array_push($MondayDinner, $time);}

            };

        $TuesdayBreakfast = [];
        $TuesdayLunch = [];
        $TuesdayDinner= [];
            $tuesday = $plannerRepository->findBy(['day' => "Tuesday"]);
         
            foreach($tuesday as $time){
                
                if($time->getTime() == "Breakfast"){
                    array_push($TuesdayBreakfast, $time);
                }else if ($time->getTime() == "Lunch"){
                    array_push($TuesdayLunch, $time);}
                    else if ($time->getTime() == "Dinner"){
                        array_push($TuesdayDinner, $time);}

            };

        $WednesdayBreakfast = [];
        $WednesdayLunch = [];
        $WednesdayDinner= [];
            $wednesday = $plannerRepository->findBy(['day' => "Wednesday"]);
             
            foreach($wednesday as $time){
                    
                    if($time->getTime() == "Breakfast"){
                        array_push($WednesdayBreakfast, $time);
                    }else if ($time->getTime() == "Lunch"){
                        array_push($WednesdayLunch, $time);}
                        else if ($time->getTime() == "Dinner"){
                            array_push($WednesdayDinner, $time);}
    
                };

                $ThursdayBreakfast = [];
                $ThursdayLunch = [];
                $ThursdayDinner= [];
                    $thursday = $plannerRepository->findBy(['day' => "Thursday"]);
                     
                    foreach($thursday as $time){
                            
                            if($time->getTime() == "Breakfast"){
                                array_push($ThursdayBreakfast, $time);
                            }else if ($time->getTime() == "Lunch"){
                                array_push($ThursdayLunch, $time);}
                                else if ($time->getTime() == "Dinner"){
                                    array_push($ThursdayDinner, $time);}
            
                        };

        $FridayBreakfast = [];
        $FridayLunch = [];
        $FridayDinner= [];
            $friday = $plannerRepository->findBy(['day' => "Friday"]);
                 
            foreach($friday as $time){
                        
                if($time->getTime() == "Breakfast"){
                        array_push($FridayBreakfast, $time);
                    }else if ($time->getTime() == "Lunch"){
                        array_push($FridayLunch, $time);}
                    else if ($time->getTime() == "Dinner"){
                        array_push($FridayDinner, $time);}
        
                    };

                    $SaturdayBreakfast = [];
                    $SaturdayLunch = [];
                    $SaturdayDinner= [];
                        $saturday = $plannerRepository->findBy(['day' => "Saturday"]);
                             
                        foreach($saturday as $time){
                                    
                            if($time->getTime() == "Breakfast"){
                                    array_push($SaturdayBreakfast, $time);
                                }else if ($time->getTime() == "Lunch"){
                                    array_push($SaturdayLunch, $time);}
                                else if ($time->getTime() == "Dinner"){
                                    array_push($SaturdayDinner, $time);}
                    
                                };
                                $SundayBreakfast = [];
                                $SundayLunch = [];
                                $SundayDinner= [];
                                    $sunday = $plannerRepository->findBy(['day' => "Sunday"]);
                                         
                                    foreach($sunday as $time){
                                                
                                        if($time->getTime() == "Breakfast"){
                                                array_push($SundayBreakfast, $time);
                                            }else if ($time->getTime() == "Lunch"){
                                                array_push($SundayLunch, $time);}
                                            else if ($time->getTime() == "Dinner"){
                                                array_push($SundayDinner, $time);}
                                
                                            };

            
            $tuesday = $plannerRepository->findBy(['day' => "Tuesday", 'fk_user' => $this->getUser()->getId()]);
            $wednesday = $plannerRepository->findBy(['day' => "Wednesday", 'fk_user' => $this->getUser()->getId()]);
            $thursday = $plannerRepository->findBy(['day' => "Thursday", 'fk_user' => $this->getUser()->getId()]);
            $friday = $plannerRepository->findBy(['day' => "Friday", 'fk_user' => $this->getUser()->getId()]);
            $saturday = $plannerRepository->findBy(['day' => "Saturday", 'fk_user' => $this->getUser()->getId()]);
            $sunday = $plannerRepository->findBy(['day' => "Sunday", 'fk_user' => $this->getUser()->getId()]);
       
        return $this->render('planner1/index.html.twig', [
            'monday' => $monday,
            'tuesday' => $tuesday,
            'wednesday' => $wednesday,
            'thursday' => $thursday,
            'friday' => $friday,
            'saturday' => $saturday,
            'sunday' => $sunday,
            "mondayBreakfast"=> $MondayBreakfast,
            "mondayLunch"=> $MondayLunch,
            "mondayDinner"=> $MondayDinner,
            "tuesdayBreakfast"=> $TuesdayBreakfast,
            "tuesdayLunch"=> $TuesdayLunch,
            "tuesdayDinner"=> $TuesdayDinner,
            "wednesdayBreakfast"=> $WednesdayBreakfast,
            "wednesdayLunch"=> $WednesdayLunch,
            "wednesdayDinner"=> $WednesdayDinner,
            "thursdayBreakfast"=> $ThursdayBreakfast,
            "thursdayLunch"=> $ThursdayLunch,
            "thursdayDinner"=> $ThursdayDinner,
            "fridayBreakfast"=> $FridayBreakfast,
            "fridayLunch"=> $FridayLunch,
            "fridayDinner"=> $FridayDinner,
            "saturdayBreakfast"=> $SaturdayBreakfast,
            "saturdayLunch"=> $SaturdayLunch,
            "saturdayDinner"=> $SaturdayDinner,
            "sundayBreakfast"=> $SundayBreakfast,
            "sundayLunch"=> $SundayLunch,
            "sundayDinner"=> $SundayDinner

            

        ]
            // 'planners' => $plannerRepository->findAll(),
            
        );
    }

    #[Route('/planner/{id}', name: 'app_adminplanner_show', methods: ['GET'])]
    public function adminPlannerShow(Planner $planner): Response
    {
        return $this->render('admin/admin_plan/show.html.twig', [
            'planner' => $planner,
        ]);
    }

    #[Route('/planner/{id}/edit', name: 'app_adminplanner_edit', methods: ['GET', 'POST'])]
    public function adminPlannerEdit(Request $request, Planner $planner, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Planner1Type::class, $planner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_adminplanner_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_plan/edit.html.twig', [
            'planner' => $planner,
            'plan' => $form,
        ]);
    }

    #[Route('/planner/{id}', name: 'app_adminplanner_delete', methods: ['POST'])]
    public function adminPlannerDelete(Request $request, Planner $planner, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $planner->getId(), $request->request->get('_token'))) {
            $entityManager->remove($planner);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_adminplanner_index', [], Response::HTTP_SEE_OTHER);
    }
}
