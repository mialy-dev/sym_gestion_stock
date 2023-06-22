<?php

namespace App\Repository;

use App\Entity\TEntrerSortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TEntrerSortie>
 *
 * @method TEntrerSortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method TEntrerSortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method TEntrerSortie[]    findAll()
 * @method TEntrerSortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TEntrerSortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TEntrerSortie::class);
    }

    public function add(TEntrerSortie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TEntrerSortie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return TEntrerSortie[] Returns an array of TEntrerSortie objects
    */
    public function rechercheTout()
    {
        $entityManager = $this->getEntityManager();

        return $entityManager->createQueryBuilder()
            ->select('es','p','c')
            ->from('App\Entity\TEntrerSortie', 'es')
            ->leftJoin('es.id_personnel', 'p')
            ->leftJoin('es.id_cle', 'c')
            ->getQuery()
            ->getResult();
    }

//    public function findOneBySomeField($value): ?TEntrerSortie
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
