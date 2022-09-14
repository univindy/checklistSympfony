<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
     return $this->redirect('/gestion');
    }

    #[Route('/admin/tasks', name: 'adminTasks')]
    public function adminTasks(): Response
    {
                $routeBuilder = $this->container->get(AdminUrlGenerator::class);
                $url = $routeBuilder->setController(TaskCrudController::class)->generateUrl();
                return $this->redirect($url);
    }

    #[Route('/admin/users', name: 'adminUsers')]
    public function adminUsers(): Response
    {
                $routeBuilder = $this->container->get(AdminUrlGenerator::class);
                $url = $routeBuilder->setController(UsersCrudController::class)->generateUrl();
                return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ratata');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
