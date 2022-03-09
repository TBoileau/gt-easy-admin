<?php

namespace App\Repository;

use App\Entity\FeatureValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FeatureValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method FeatureValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method FeatureValue[]    findAll()
 * @method FeatureValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeatureValueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FeatureValue::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(FeatureValue $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(FeatureValue $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return FeatureValue[] Returns an array of FeatureValue objects
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
    public function findOneBySomeField($value): ?FeatureValue
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
