<?php

namespace App\Controller;

use App\Entity\Task;
use Monolog\DateTimeImmutable;
use App\Form\TaskFormTypeDetail;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DetailTaskController extends AbstractController
{
    #[Route('/detail/task/{id}', name: 'app_detail_task')]
    public function index(int $id, ?Task $task,TaskRepository $TaskRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
      $task = new Task();
      $task = $TaskRepository->findOneBy(array('id' => $id));
    $form = $this->createForm(TaskFormTypeDetail::class, $task);
    $form->handleRequest($request);
    $data = $form->getData();
    if ($form->isSubmitted() && $form->isValid()){
      dd($data);
               $task->setStade( $data->getStade());
              $task->setContent( $data->getContent());
              if(!$data->isImportance()){
                $task->setImportance("0");
              }else{
                $task->setImportance("1");
              }
              if(!$data->getCreatedAt()){
                $task->setCreatedAt(new DateTimeImmutable('now'));
              }
              $task->setCreatedAt($data->getCreatedAt());
              $task->setModifiedAt(new DateTimeImmutable('now'));
              //$task.setUsers("Session.name");
              $entityManager->persist($task);

          $entityManager->flush();
          return $this->redirectToRoute('app_home');
    }
    return $this->render('detail_task/index.html.twig', ['task' => $task,'form' => $form->createView()]);
}
}
