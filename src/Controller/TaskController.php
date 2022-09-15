<?php

namespace App\Controller;
use App\Entity\Task;
use App\Form\TaskFormType;
use Monolog\DateTimeImmutable;
use App\Repository\TaskRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TaskController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(?Task $task,TaskRepository $TaskRepository,UsersRepository $UsersRepository, Request $_request, EntityManagerInterface $entityManager): Response
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
                $Auteur = $UsersRepository->findOneBy(['name' => 'Admin']);
                $task->setAuteur($Auteur);
                $entityManager->persist($task);
            }else{
                $TaskRepository->findBy(['id' => $task->getId()]);
                dd($TaskRepository);
            }
            $entityManager->flush();
        }
        $tasks = $TaskRepository->findBy([], ['Stade' => 'DESC','CreatedAt' => 'DESC']);
        return $this->render('task\index.html.twig', ['tasks' => $tasks,'form' => $form->createView()]);
    }

    #[Route('/status/task/{id}', name: 'statut')]
    public function chageStatuts(TaskRepository $TaskRepository,int $id, EntityManagerInterface $entityManager)
    {
        $task = new Task();
        $form = $this->createForm(TaskFormType::class, $task);
        $task = $TaskRepository->findOneBy(array('id' => $id));
        if ($task->isStade()){
            $task->setStade(0);
        }else{
            $task->setStade(1);
        }
        $entityManager->persist($task);
        $entityManager->flush();
        $tasks = $TaskRepository->findBy([],  ['Stade' => 'DESC','CreatedAt' => 'DESC']);
        return $this->render('task\index.html.twig', ['tasks' => $tasks,'form' => $form->createView()]);
    }

}
