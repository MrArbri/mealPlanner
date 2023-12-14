<?php

namespace App\Controller;

use App\Entity\Planner;
use App\Form\PlannerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlannerController extends AbstractController
{
    #[Route('/planner', name: 'app_planner')]
    public function index(): Response
    {
        return $this->render('planner/index.html.twig', [
            'controller_name' => 'PlannerController',
        ]);
    }

//     public function form(Request $request, EntityManagerInterface $entityManager): Response
//     {
//         $plan = new Planner();
//         $plan->setFkUser();
//         $plan->setFkMeal();

//         $form = $this->createFormBuilder($plan)
//             ->add();

//     }
 }
