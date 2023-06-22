<?php

namespace App\Repository;

use App\Entity\Tetudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tetudiant>
 *
 * @method Tetudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tetudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tetudiant[]    findAll()
 * @method Tetudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TetudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tetudiant::class);
    }

    public function add(Tetudiant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Tetudiant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    /**
    * @return TEtudiant[] Returns an array of TEntrerSortie objects
    */
    public function rechercheTout()
    {
        $entityManager = $this->getEntityManager();

        return $entityManager->createQueryBuilder()
            ->select('e','p')
            ->from('App\Entity\Tetudiant', 'e')
            ->leftJoin('e.id_classe', 'p')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Tetudiant[] Returns an array of Tetudiant objects
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

//    public function findOneBySomeField($value): ?Tetudiant
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
