<?php

namespace App\Controller;

use App\Entity\Planner;
use App\Form\Planner1Type;
use App\Repository\PlannerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/planner1')]
class Planner1Controller extends AbstractController
{
    #[Route('/', name: 'app_planner1_index', methods: ['GET'])]
    public function index( Request $request, PlannerRepository $plannerRepository): Response
    { 
        $MondayBreakfast = [];
        $MondayLunch = [];
        $MondayDinner= [];
            
        $monday = $plannerRepository->findBy(['day' => "Monday", 'fk_user' => $this->getUser()->getId()]);
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
            $tuesday = $plannerRepository->findBy(['day' => "Tuesday", 'fk_user' => $this->getUser()->getId()]);
         
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
            $wednesday = $plannerRepository->findBy(['day' => "Wednesday", 'fk_user' => $this->getUser()->getId()]);
             
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
                    $thursday = $plannerRepository->findBy(['day' => "Thursday", 'fk_user' => $this->getUser()->getId()]);
                     
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
            $friday = $plannerRepository->findBy(['day' => "Friday", 'fk_user' => $this->getUser()->getId()]);
                 
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
                        $saturday = $plannerRepository->findBy(['day' => "Saturday", 'fk_user' => $this->getUser()->getId()]);
                             
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
                                    $sunday = $plannerRepository->findBy(['day' => "Sunday", 'fk_user' => $this->getUser()->getId()]);
                                         
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

// This section is not needed but is kept just in case
    // #[Route('/new', name: 'app_planner1_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $planner = new Planner();
    //     $plan = $this->createForm(Planner1Type::class, $planner);
    //     $plan->handleRequest($request);

    //     if ($plan->isSubmitted() && $plan->isValid()) {
    //         $entityManager->persist($planner);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_planner1_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('planner1/new.html.twig', [
    //         'planner' => $planner,
    //         'plan' => $plan,
    //     ]);
    // }

    #[Route('/{id}', name: 'app_planner1_show', methods: ['GET'])]
    public function show(Planner $planner): Response
    {
        
        return $this->render('planner1/show.html.twig', [
            'planner' => $planner,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_planner1_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Planner $planner, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Planner1Type::class, $planner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_planner1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('planner1/edit.html.twig', [
            'planner' => $planner,
            'plan' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_planner1_delete', methods: ['POST'])]
    public function delete(Request $request, Planner $planner, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planner->getId(), $request->request->get('_token'))) {
            $entityManager->remove($planner);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_planner1_index', [], Response::HTTP_SEE_OTHER);
    }
}
