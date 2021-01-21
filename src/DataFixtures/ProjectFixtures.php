<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Project;
use App\Entity\Tags;

class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for($x = 1; $x <= 3; $x++){
            $tag = new Tags();
            $tag->setTagName("tag$x");

            $manager->persist($tag);
        
        for($i = 1; $i <= mt_rand(4, 6); $i++){
            $project = new Project();
            $project->setTitle("Project n°$i");
            $project->setDescription("<p>Description du Projet n°$i</p>");
            $project->setImage("https://picsum.photos/600");
            $project->setGithub("Lien github du projet n°$i");
            $project->setWeblink("Weblink du projet n°$i");
            $project->setTags($tag);

            $manager->persist($project);
        }
    }

        $manager->flush();
    }
}
