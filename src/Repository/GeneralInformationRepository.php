<?php

namespace App\Repository;

use App\Entity\GeneralInformation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GeneralInformation|null find($id, $lockMode = null, $lockVersion = null)
 * @method GeneralInformation|null findOneBy(array $criteria, array $orderBy = null)
 * @method GeneralInformation[]    findAll()
 * @method GeneralInformation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeneralInformationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeneralInformation::class);
    }

    // /**
    //  * @return GeneralInformation[] Returns an array of GeneralInformation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GeneralInformation
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
