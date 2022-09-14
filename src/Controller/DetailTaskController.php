<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DetailTaskController extends AbstractController
{
    #[Route('/detail/task/{id}', name: 'app_detail_task')]
    public function index(TaskRepository $repo, int $id): Response
    {
      $task = $repo->findBy(['id'=>$id]);
return $this->render('detail_task/index.html.twig', ['task' => $task]);
}
}
