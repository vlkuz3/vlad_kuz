<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function filter(array $filters): \Doctrine\ORM\QueryBuilder
    {
        $qb = $this->createQueryBuilder('c')
            ->leftJoin('c.carCategory', 'cat')
            ->addSelect('cat');

        if (!empty($filters['model'])) {
            $qb->andWhere('c.model LIKE :model')
                ->setParameter('model', '%' . $filters['model'] . '%');
        }

        if (!empty($filters['color'])) {
            $qb->andWhere('c.color LIKE :color')
                ->setParameter('color', '%' . $filters['color'] . '%');
        }

        if (!empty($filters['year'])) {
            $qb->andWhere('c.year = :year')
                ->setParameter('year', $filters['year']);
        }

        if (!empty($filters['carCategory'])) {
            $qb->andWhere('cat.id = :category')
                ->setParameter('category', $filters['carCategory']);
        }

        return $qb;
    }


    //    /**
    //     * @return Car[] Returns an array of Car objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Car
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
