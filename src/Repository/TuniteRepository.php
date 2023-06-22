<?php

namespace App\Repository;

use App\Entity\Tunite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
* @extends ServiceEntityRepository<Tunite>
*
* @method Tunite|null find( $id, $lockMode = null, $lockVersion = null )
* @method Tunite|null findOneBy( array $criteria, array $orderBy = null )
* @method Tunite[]    findAll()
* @method Tunite[]    findBy( array $criteria, array $orderBy = null, $limit = null, $offset = null )
*/

class TuniteRepository extends ServiceEntityRepository {
    public function __construct( ManagerRegistry $registry ) {
        parent::__construct( $registry, Tunite::class );
    }

    public function add( Tunite $entity, bool $flush = false ): void {
        $this->getEntityManager()->persist( $entity );

        if ( $flush ) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove( Tunite $entity, bool $flush = false ): void {
        $this->getEntityManager()->remove( $entity );

        if ( $flush ) {
            $this->getEntityManager()->flush();
        }
    }

    /**
    * @return Tunite[] Returns an array of Tunite objects
    */

    public function rechercheUnite( $unite ): array {
        return $this->createQueryBuilder( 'tu' )
        ->where( 'tu.unite = :val' )
        ->setParameter( 'val', $unite)
        ->getQuery()
        ->getResult()
        ;
    }

    //    /**
    //     * @return Tunite[] Returns an array of Tunite objects
    //     */
    //    public function findByExampleField( $value ): array
    // {
    //        return $this->createQueryBuilder( 't' )
    //            ->andWhere( 't.exampleField = :val' )
    //            ->setParameter( 'val', $value )
    //            ->orderBy( 't.id', 'ASC' )
    //            ->setMaxResults( 10 )
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField( $value ): ?Tunite
    // {
    //        return $this->createQueryBuilder( 't' )
    //            ->andWhere( 't.exampleField = :val' )
    //            ->setParameter( 'val', $value )
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
