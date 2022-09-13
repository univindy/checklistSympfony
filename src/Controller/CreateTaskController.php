<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateTaskController extends AbstractController
{
    #[Route('/task/create', name: 'app_create_task')]
    public function index(): Response
    {
        return $this->render('create_task/index.html.twig', [
            'controller_name' => 'CreateTaskController',
        ]);
    }
}
