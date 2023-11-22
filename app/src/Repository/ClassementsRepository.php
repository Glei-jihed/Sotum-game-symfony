<?php

namespace App\Repository;

use App\Entity\Classements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Classements>
 *
 * @method Classements|null find($id, $lockMode = null, $lockVersion = null)
 * @method Classements|null findOneBy(array $criteria, array $orderBy = null)
 * @method Classements[]    findAll()
 * @method Classements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Classements::class);
    }

//    /**
//     * @return Classements[] Returns an array of Classements objects
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

//    public function findOneBySomeField($value): ?Classements
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
