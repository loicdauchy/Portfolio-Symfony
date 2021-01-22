<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    /**
     * @return Project[] Returns an array of Project objects
     */  
    public function findByTags($value): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 
            'SELECT * FROM project
            WHERE tags_id = :value';
        $search = $conn->prepare($sql);
        $search->execute(['value' => $value]);
        return $search->fetchAllAssociative();
    }

        /**
     * @return Project[] Returns an array of Project objects
     */  
    public function lastProject(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 
            'SELECT * FROM project
            ORDER BY id DESC LIMIT 3';
        $search = $conn->prepare($sql);
        $search->execute();
        return $search->fetchAllAssociative();
    }
    

    /*
    public function findOneBySomeField($value): ?Project
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
