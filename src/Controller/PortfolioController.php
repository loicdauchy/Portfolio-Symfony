<?php

namespace App\Controller;

use App\Entity\Tags;
use App\Form\TagsType;
use App\Entity\Project;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PortfolioController extends AbstractController
{
    /**
     * @Route("/portfolio", name="portfolio")
     */
    public function index(Request $request, ObjectManager $manager): Response
    {

        $repo = $this->getDoctrine()->getRepository(Project::class);
        $projects = $repo->findAll();
        
        $tags = new Project();
        $form = $this->createForm(TagsType::class, $tags);
        $value = $request->get('tags');
        $value = $value['tags'];

        $tagName = $this->getDoctrine()
            ->getRepository(Tags::class)
            ->findTagName($value);

        
        $searchByTags = $this->getDoctrine()
                ->getRepository(Project::class)
                ->findByTags($value);

        return $this->render('portfolio/index.html.twig', [
            'controller_name' => 'PortfolioController',
            'projects' => $projects,
            'tagsForm' => $form->createView(),
            'formResult' => $value,
            'SearchByTags' => $searchByTags,
            'tagName' => $tagName
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
