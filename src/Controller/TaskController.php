<?php

namespace App\Controller;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TaskController extends AbstractController
{
        #[Route('/task', name: 'app_task')]
        public function index(TaskRepository $TaskRepository): Response
        {
            $tasks = $TaskRepository->findAll();
    return $this->render('task\index.html.twig', ['tasks' => $tasks]);
    }
}
