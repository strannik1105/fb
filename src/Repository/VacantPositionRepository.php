<?php

namespace App\Repository;

use App\Entity\VacantPosition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VacantPosition|null find($id, $lockMode = null, $lockVersion = null)
 * @method VacantPosition|null findOneBy(array $criteria, array $orderBy = null)
 * @method VacantPosition[]    findAll()
 * @method VacantPosition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VacantPositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VacantPosition::class);
    }

    // /**
    //  * @return VacantPosition[] Returns an array of VacantPosition objects
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
    public function findOneBySomeField($value): ?VacantPosition
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
