<?php

namespace App\Controller;



use App\Entity\Project;
use App\Form\AddProjectType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @Route("/edite/{id}", name="edite")
     */
    public function index(Request $request, ObjectManager $manager): Response
    {
        $repo = $this->getDoctrine()->getRepository(Project::class);
        $projects = $repo->findAll();

        $project = new Project();
        $form = $this->createForm(AddProjectType::class, $project);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($project);
            $manager->flush();
        }
       
        
        

        return $this->render('admin/index.html.twig', [
            'project' => $project,
            'addForm' => $form->createView(),
            'projects' => $projects
        ]);
    }

    /**
     * @Route("/edite/{id}", name="edite")
     * 
     */
    public function update(Request $request, ObjectManager $manager, Project $project): Response
    {
        $form = $this->createForm(AddProjectType::class, $project);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($project);
            $manager->flush();
            return $this->redirectToRoute('admin');
        }
       
        return $this->render('admin/update.html.twig', [
            'project' => $project,
            'upForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * 
     */
    public function delete(Request $request, ObjectManager $manager, Project $project): Response
    {
        $manager->remove($project);
        $manager->flush();
        return $this->redirectToRoute('admin');
    }
}
