<?php

namespace App\Repository;

use App\Entity\ReponsesUtilisateurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReponsesUtilisateurs>
 *
 * @method ReponsesUtilisateurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReponsesUtilisateurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReponsesUtilisateurs[]    findAll()
 * @method ReponsesUtilisateurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReponsesUtilisateursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReponsesUtilisateurs::class);
    }

//    /**
//     * @return ReponsesUtilisateurs[] Returns an array of ReponsesUtilisateurs objects
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

//    public function findOneBySomeField($value): ?ReponsesUtilisateurs
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
