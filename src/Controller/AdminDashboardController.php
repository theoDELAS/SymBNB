<?php

namespace App\Controller;

use App\Service\StatsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(EntityManagerInterface $manager, StatsService $statsService)
    {
        $stats = $statsService->getStats();

        $bestAds = $statsService->getAdsStats('DESC');
        $worstAds = $statsService->getAdsStats('ASC');

        $bestAds = $manager->createQuery(
            'SELECT AVG(c.rating) as note, a.title, a.id, u.firstName, u.lastName, u.picture
             FROM App\Entity\Comment c
             JOIN c.ad a
             JOIN a.author u
             GROUP BY a
             ORDER BY note DESC'
        )->setMaxResults(5)
        ->getResult();

        $worstAds = $manager->createQuery(
            'SELECT AVG(c.rating) as note, a.title, a.id, u.firstName, u.lastName, u.picture
             FROM App\Entity\Comment c
             JOIN c.ad a
             JOIN a.author u
             GROUP BY a
             ORDER BY note ASC'
        )->setMaxResults(5)
        ->getResult();


        return $this->render('admin/dashboard/index.html.twig', [
            'stats' => $stats,
            'bestAds' => $bestAds,
            'worstAds' => $worstAds
        ]);
    }
}
