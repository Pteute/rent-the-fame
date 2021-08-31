<?php

namespace App\Repository;

use App\Entity\Celebrite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Celebrite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Celebrite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Celebrite[]    findAll()
 * @method Celebrite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CelebriteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Celebrite::class);
    }

    public function findAllCelebrities(){
        return $this->createQueryBuilder('c')
        ->getQuery()
        ->getArrayResult()
        ;
    }
    // /**
    //  * @return Celebrite[] Returns an array of Celebrite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Celebrite
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
