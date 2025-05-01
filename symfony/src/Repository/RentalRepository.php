<?php

namespace App\Repository;

use App\Entity\Rental;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rental>
 */
class RentalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rental::class);
    }

    public function filter(array $filters): QueryBuilder
    {
        $qb = $this->createQueryBuilder('r')
            ->leftJoin('r.customer', 'c')
            ->addSelect('c')
            ->leftJoin('r.car', 'car')
            ->addSelect('car');

        if (!empty($filters['customer'])) {
            $qb->andWhere('c.name LIKE :customer')
                ->setParameter('customer', '%' . $filters['customer'] . '%');
        }

        if (!empty($filters['startDate'])) {
            $startDate = \DateTime::createFromFormat('Y-m-d', $filters['startDate']);
            if ($startDate) {
                $qb->andWhere('r.startDate >= :startDate')
                    ->setParameter('startDate', $startDate->format('Y-m-d'));
            }
        }

        if (!empty($filters['endDate'])) {
            $endDate = \DateTime::createFromFormat('Y-m-d', $filters['endDate']);
            if ($endDate) {
                $qb->andWhere('r.endDate <= :endDate')
                    ->setParameter('endDate', $endDate->format('Y-m-d'));
            }
        }

        if (!empty($filters['car'])) {
            $qb->andWhere('car.model LIKE :car')
                ->setParameter('car', '%' . $filters['car'] . '%');
        }

        return $qb;
    }

    //    /**
    //     * @return Rental[] Returns an array of Rental objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Rental
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
