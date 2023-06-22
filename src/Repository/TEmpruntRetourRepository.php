<?php

namespace App\Repository;

use App\Entity\TEmpruntRetour;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TEmpruntRetour>
 *
 * @method TEmpruntRetour|null find($id, $lockMode = null, $lockVersion = null)
 * @method TEmpruntRetour|null findOneBy(array $criteria, array $orderBy = null)
 * @method TEmpruntRetour[]    findAll()
 * @method TEmpruntRetour[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TEmpruntRetourRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TEmpruntRetour::class);
    }

    public function add(TEmpruntRetour $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TEmpruntRetour $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    /**
    * @return TEmpruntRetour[] Returns an array of Tstock objects
    */
    public function rechercheToutEmprunt($id,$ids)
    {
        $entityManager = $this->getEntityManager();

        return $entityManager->createQueryBuilder()
            ->select('emr')
            ->from('App\Entity\TEmpruntRetour', 'emr')
            ->where('emr.id_personnel = :value1')
            ->andWhere('emr.id_stock = :value2')
            ->setParameter('value1', $id)
            ->setParameter('value2', $ids)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return TEmpruntRetour[] Returns an array of TEmpruntRetour objects
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

//    public function findOneBySomeField($value): ?TEmpruntRetour
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
