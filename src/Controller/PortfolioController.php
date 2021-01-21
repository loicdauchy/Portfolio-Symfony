<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Project;

class PortfolioController extends AbstractController
{
    /**
     * @Route("/portfolio", name="portfolio")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Project::class);
        $projects = $repo->findAll();
        return $this->render('portfolio/index.html.twig', [
            'controller_name' => 'PortfolioController',
            'projects' => $projects
        ]);
    }

    /**
     * @Route("/portfolio/{id}", name="portfolio_show")
     */
    public function show($id){
        $repo = $this->getDoctrine()->getRepository(Project::class);
        $project = $repo->find($id);
        return $this->render('portfolio/show.html.twig', [
            'project' => $project
        ]);
    }
}
