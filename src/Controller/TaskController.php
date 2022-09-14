<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskFormType;
use Monolog\DateTimeImmutable;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TaskController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(?Task $task,TaskRepository $TaskRepository, Request $_request, EntityManagerInterface $entityManager): Response
    {

        if(!$task){
            $task = new Task();
        }
        $form = $this->createForm(TaskFormType::class, $task);
        $form->handleRequest($_request);
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            //dd($data);
            if(!$task->getId()){
                $task->setStade("1");
                $task->setContent($data->getContent());
                if(!$data->isImportance()){
                    $task->setImportance("0");
                  }else{
                    $task->setImportance("1");
                  }
                $task->setCreatedAt(new DateTimeImmutable('now'));
                $task->setModifiedAt(new DateTimeImmutable('now'));
                //$task.setUsers("Session.name");
                $entityManager->persist($task);
            }else{
                $TaskRepository->findBy(['id' => $task->getId()]);
                dd($TaskRepository);
            }
            $entityManager->flush();
        }
        $tasks = $TaskRepository->findBy([], ['Stade' => 'DESC']);
        return $this->render('task\index.html.twig', ['tasks' => $tasks,'form' => $form->createView()]);
    }

}
