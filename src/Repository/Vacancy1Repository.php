<?php

namespace App\Repository;

use App\Entity\Vacancy1;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vacancy1|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vacancy1|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vacancy1[]    findAll()
 * @method Vacancy1[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Vacancy1Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vacancy1::class);
    }

    // /**
    //  * @return Vacancy1[] Returns an array of Vacancy1 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vacancy1
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
