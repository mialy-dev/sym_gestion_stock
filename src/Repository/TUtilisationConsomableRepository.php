<?php

namespace App\Repository;

use App\Entity\TUtilisationConsomable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TUtilisationConsomable>
 *
 * @method TUtilisationConsomable|null find($id, $lockMode = null, $lockVersion = null)
 * @method TUtilisationConsomable|null findOneBy(array $criteria, array $orderBy = null)
 * @method TUtilisationConsomable[]    findAll()
 * @method TUtilisationConsomable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TUtilisationConsomableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TUtilisationConsomable::class);
    }

    public function add(TUtilisationConsomable $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TUtilisationConsomable $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TUtilisationConsomable[] Returns an array of TUtilisationConsomable objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TUtilisationConsomable
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
