<?php

namespace App\Repository;

use App\Entity\Meal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Meal>
 *
 * @method Meal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Meal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Meal[]    findAll()
 * @method Meal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MealRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Meal::class);
    }

    /**
     * @return Meal[] Returns an array of Meal objects
     */
    public function findApprovedMeals()
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.is_verified = :is_verified')
            ->setParameter('is_verified', true)
            ->getQuery()
            ->getResult();
    }
    public function findUnapprovedMeals()
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.is_verified = :is_verified')
            ->setParameter('is_verified', false)
            ->getQuery()
            ->getResult();
    }
    public function findMealsWithCaloriesUnder300()
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.calories < :maxCalories')
            ->setParameter('maxCalories', 300)
            ->getQuery()
            ->getResult();
    }
    public function findMealsWithCaloriesUnder400()
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.calories < :maxCalories')
            ->setParameter('maxCalories', 400)
            ->getQuery()
            ->getResult();
    }
    public function findMealsWithCaloriesUnder500()
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.calories < :maxCalories')
            ->setParameter('maxCalories', 500)
            ->getQuery()
            ->getResult();
    }
    public function findMealsWithCaloriesUnder600()
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.calories < :maxCalories')
            ->setParameter('maxCalories', 600)
            ->getQuery()
            ->getResult();
    }
    public function findMealsWithCaloriesUnder700()
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.calories < :maxCalories')
            ->setParameter('maxCalories', 700)
            ->getQuery()
            ->getResult();
    }
    public function findMealsWithCaloriesUnder800()
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.calories < :maxCalories')
            ->setParameter('maxCalories', 800)
            ->getQuery()
            ->getResult();
    }
    public function findMealsWithCaloriesUnder900()
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.calories < :maxCalories')
            ->setParameter('maxCalories', 900)
            ->getQuery()
            ->getResult();
    }
    public function findMealsWithCaloriesUnder1000()
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.calories < :maxCalories')
            ->setParameter('maxCalories', 1000)
            ->getQuery()
            ->getResult();
    }
    //    /**
    //     * @return Meal[] Returns an array of Meal objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Meal
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
