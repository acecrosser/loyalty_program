<?php

namespace App\Repository;

use App\Entity\Fiscals;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Fiscals|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fiscals|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fiscals[]    findAll()
 * @method Fiscals[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FiscalsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fiscals::class);
    }

    // /**
    //  * @return Fiscals[] Returns an array of Fiscals objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fiscals
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
