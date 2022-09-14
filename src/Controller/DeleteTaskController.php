<?php

namespace App\Controller;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteTaskController extends AbstractController
{
    #[Route('/delete/task/{id}', name: 'app_delete_task')]
    public function index(int $id, ?Task $task,TaskRepository $TaskRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $task = new Task();
        $task = $TaskRepository->findOneBy(array('id' => $id));
        $entityManager->remove($task);
        $entityManager->flush();
        return $this->redirectToRoute('app_home');
        }
}
