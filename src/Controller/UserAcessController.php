<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserAcessController extends AbstractController
{
    #[Route('/user', name: 'app_user_acess')]
    public function index(): Response
    {
        return $this->render('user_acess/index.html.twig', [
            'controller_name' => 'UserAcessController',
        ]);
    }
}
