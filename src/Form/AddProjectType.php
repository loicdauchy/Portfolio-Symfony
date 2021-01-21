<?php

namespace App\Form;

use App\Entity\Tags;
use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('tags', EntityType::class, [
                'class' => Tags::class,
                'choice_label' => 'tagName'
            ])
            ->add('description', CKEditorType::class)
            ->add('image', ElFinderType::class, ['instance' => 'form', 'enable' => true])
            ->add('github')
            ->add('weblink')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
