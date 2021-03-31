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
use App\Repository\RoadbookRepository;
use App\Repository\ArticleRepository;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    protected $roadbookRepository;
    protected $userRepository;
    protected $articleRepository;

    public function __construct(
        RoadbookRepository $roadbookRepository,
        UserRepository $userRepository,
        ArticleRepository $articleRepository) {
            $this->roadbookRepository = $roadbookRepository;
            $this->userRepository = $userRepository;
            $this->articleRepository = $articleRepository;
    }
    /**
     * @Route("/admin", name="admin")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig', [
            'countAllUser' => $this->userRepository->countAllUser(),
            'countAllRoadbook' => $this->roadbookRepository->countAllRoadbook(),
            'articles' => $this->articleRepository->findAll()
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Motoo Planner Administration');
    }

    // ajouter une feuille de style personnalisé
    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('bundles/EasyAdmin/css/style.css');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Les articles', 'fas fa-newspaper', Article::class);
        yield MenuItem::linkToCrud('Les utilisateurs', 'fas fa-user-friends', User::class);
        yield MenuItem::linkToCrud('Les catégories', 'fas fa-book-open', Category::class);
        yield MenuItem::linkToCrud('Les suggestions', 'fas fa-question', Suggestion::class);
        yield MenuItem::linkToCrud('Les roadbooks', 'fas fa-road', Roadbook::class);
        yield MenuItem::linkToCrud('Les informations', 'fas fa-info', Information::class);
        yield MenuItem::linkToCrud('Les cheklists', 'fas fa-list-ol', Checklist::class);
        yield MenuItem::linkToCrud('Les étapes', 'fas fa-map-marked-alt', Step::class);
    }
}
