<?php

namespace App\Repository;

use App\Entity\Planner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Planner>
 *
 * @method Planner|null find($id, $lockMode = null, $lockVersion = null)
 * @method Planner|null findOneBy(array $criteria, array $orderBy = null)
 * @method Planner[]    findAll()
 * @method Planner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlannerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Planner::class);
    }

//    /**
//     * @return Planner[] Returns an array of Planner objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Planner
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
