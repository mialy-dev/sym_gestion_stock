<?php

namespace App\Repository;

use App\Entity\Tstock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tstock>
 *
 * @method Tstock|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tstock|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tstock[]    findAll()
 * @method Tstock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TstockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tstock::class);
    }

    public function add(Tstock $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Tstock $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Tstock[] Returns an array of Tstock objects
    */
    public function rechercheTout()
    {
        $entityManager = $this->getEntityManager();

        return $entityManager->createQueryBuilder()
            ->select('st','f','u','t')
            ->from('App\Entity\Tstock', 'st')
            ->leftJoin('st.id_famille', 'f')
            ->leftJoin('st.id_unite', 'u')
            ->leftJoin('st.id_type', 't')
            ->getQuery()
            ->getResult();
    }



    /**
    * @return Tstock[] Returns an array of Tstock objects
    */
    public function rechercheToutOutils()
    {
        $entityManager = $this->getEntityManager();

        return $entityManager->createQueryBuilder()
            ->select('st','f','u','t')
            ->from('App\Entity\Tstock', 'st')
            ->leftJoin('st.id_famille', 'f')
            ->leftJoin('st.id_unite', 'u')
            ->leftJoin('st.id_type', 't')
            ->where('t.id = 2')
            ->getQuery()
            ->getResult();
    }

    /**
    * @return Tstock[] Returns an array of Tstock objects
    */
    public function rechercheToutUtiliser()
    {
        $entityManager = $this->getEntityManager();

        return $entityManager->createQueryBuilder()
            ->select('st','f','u','t')
            ->from('App\Entity\Tstock', 'st')
            ->leftJoin('st.id_famille', 'f')
            ->leftJoin('st.id_unite', 'u')
            ->leftJoin('st.id_type', 't')
            ->where('t.id = 1')
            ->getQuery()
            ->getResult();
    }

//    public function findOneBySomeField($value): ?Tstock
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
