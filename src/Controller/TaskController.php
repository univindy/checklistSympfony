<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TaskController extends AbstractController
{
    #[Route('/task', name: 'app_task')]
    public function index(Request $request): Response
    {
      $greet = '';
       if ($name = $request->query->get('hello')) {
           $greet = sprintf('<h1>Hello %s!</h1>', htmlspecialchars($name));
       }
        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);
    }
}
