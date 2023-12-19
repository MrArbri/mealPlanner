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
            $monday = $plannerRepository->findBy(['day' => "Monday"]);
            $tuesday = $plannerRepository->findBy(['day' => "Tuesday"]);
            $sunday = $plannerRepository->findBy(['day' => "Sunday"]);
            
        return $this->render('planner1/index.html.twig', [
            'monday' => $monday,
            'tuesday' => $tuesday,
            'sunday' => $sunday,
            

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
