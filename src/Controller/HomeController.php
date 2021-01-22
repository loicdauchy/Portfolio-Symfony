<?php

namespace App\Controller;

use App\Entity\Project;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {

        $lastProject = $this->getDoctrine()
                ->getRepository(Project::class)
                ->lastProject();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'lastProject' => $lastProject
        ]);
    }
}
