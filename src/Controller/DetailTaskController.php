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
    public function index(int $id, TaskRepository $TaskRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
      $task = new Task();
      $task = $TaskRepository->findOneBy(array('id' => $id));
      if (!$task){
        return $this->redirectToRoute('app_home');
      }
      $formulaire = $this->createForm(TaskFormTypeDetail::class,$task);
      try {
        $formulaire->handleRequest($request);
    } catch (\Exception $e) {
      var_dump ("failed : ".$e->getMessage());
    }
      if ($formulaire->isSubmitted() && $formulaire->isValid()){
      $data = $formulaire->getData();
              $task->setStade( $data->isStade());
              $task->setContent( $data->getContent());
              $task->setImportance($data->isImportance());
              $task->setModifiedAt(new DateTimeImmutable('now'));
              //$task.setUsers("Session.name");
              $entityManager->persist($task);
          $entityManager->flush();
          return $this->redirectToRoute('app_home');
      }
      return $this->render('detail_task/index.html.twig', ['task' => $task,'form' => $formulaire->createView()]);
    }
}
