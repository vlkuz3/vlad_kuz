<?php

namespace App\Repository;

use App\Entity\Payment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Payment>
 */
class PaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Payment::class);
    }

    public function filter(array $filters): QueryBuilder
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.rental', 'r')
            ->addSelect('r')
            ->leftJoin('r.customer', 'c')
            ->addSelect('c');

        if (!empty($filters['customer'])) {
            $qb->andWhere('c.name LIKE :customer')
                ->setParameter('customer', '%' . $filters['customer'] . '%');
        }

        if (!empty($filters['paymentDate'])) {
            $qb->andWhere('p.paymentDate = :paymentDate')
                ->setParameter('paymentDate', new \DateTime($filters['paymentDate']));
        }

        return $qb;
    }

    //    /**
    //     * @return Payment[] Returns an array of Payment objects
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

    //    public function findOneBySomeField($value): ?Payment
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
