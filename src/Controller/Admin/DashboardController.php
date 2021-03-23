<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Checklist;
use App\Entity\Information;
use App\Entity\Roadbook;
use App\Entity\Step;
use App\Entity\Suggestion;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Motoo Planner Api');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Les articles', 'fas fa-list', Article::class);
        yield MenuItem::linkToCrud('Les utilisateurs', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Les catégories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Les suggestions', 'fas fa-list', Suggestion::class);
        yield MenuItem::linkToCrud('Les roadbooks', 'fas fa-list', Roadbook::class);
        yield MenuItem::linkToCrud('Les informations', 'fas fa-list', Information::class);
        yield MenuItem::linkToCrud('Les cheklists', 'fas fa-list', Checklist::class);
        yield MenuItem::linkToCrud('Les étapes', 'fas fa-list', Step::class);
    }
}
