<?php

namespace App\Repository;

use App\Entity\Miamlist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Miamlist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Miamlist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Miamlist[]    findAll()
 * @method Miamlist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MiamlistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Miamlist::class);
    }

    // /**
    //  * @return Miamlist[] Returns an array of Miamlist objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Miamlist
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
