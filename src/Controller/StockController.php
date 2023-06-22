<?php

namespace App\Controller;
use App\Entity\TEmpruntRetour;
use App\Entity\Tstock;
use App\Entity\Tunite;
use App\Entity\Tfamille;
use App\Entity\Tpersonnel;
use App\Entity\Ttype;
use App\Entity\TUtilisationConsomable;
use App\Repository\TEmpruntRetourRepository;
use App\Repository\TfamilleRepository;
use App\Repository\TpersonnelRepository;
use App\Repository\TuniteRepository;
use App\Repository\TtypeRepository;
use App\Repository\TstockRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;

class StockController extends AbstractController {

    #[ Route( '/stock', name: 'app_stock' ) ]

    public function index( Request $request, TfamilleRepository $tfamille, EntityManagerInterface $em, TuniteRepository $unite, TtypeRepository $type ): Response {
        $requette = $tfamille->findAll();
        $quette = $type->findAll();
        $req = $unite->findAll();
        if ( isset( $_POST[ 'enregistrer' ] ) ) {
            $data = $request->request->all();
            if ( !empty( $data ) ) {
                $stock = new Tstock();

                $stock->setDesignation( $data[ 'designation' ] );
                $stock->setIdentification( $data[ 'identification' ] );
                $stock->setQuantite( $data[ 'quantite' ] );
                $stock->setDateEntrer( new Datetime( $data[ 'date_entrer' ] ) );
                $stock->setRemarque( $data[ 'remarque' ] );

                $id_unite = $em->getReference( Tunite::class, $data[ 'unite' ] );
                $id_famille = $em->getReference( Tfamille::class, $data[ 'famille' ] );
                $id_type = $em->getReference( Ttype::class, $data[ 'type' ] );

                $stock->setIdUnite( $id_unite );
                $stock->setIdFamille( $id_famille );
                $stock->setIdType( $id_type );

                $em->persist( $stock );

                $em->flush();
            }
        }
        $context = [
            'listeF'=>$requette,
            'listety'=>$quette,
            'listeU'=>$req
        ];
        return $this->render( 'stock/index.html.twig', $context );
    }

    #[ Route( '/stock/listes', name: 'app_stock_listes' ) ]

    public function listes( TstockRepository $tstock ): Response {

        $requette = $tstock->rechercheTout();
        // dd( $requette );
        $context = [
            'listes'=>$requette,
        ];

        return $this->render( 'stock/listes.html.twig', $context );
    }

    #[ Route( '/stock/listes/emprunt', name: 'app_stock_listes_emprunt' ) ]

    public function listess( TstockRepository $tstock ): Response {

        $requette = $tstock->rechercheToutOutils();
        // dd( $requette );
        $context = [
            'listes'=>$requette,
        ];

        return $this->render( 'stock/emprunt_retour.html.twig', $context );
    }

    #[ Route( '/stock/listes/emprunt/{id}', name: 'app_stock_listes_emprunt_produit' ) ]

    public function emprunt( $id, Request $request, TpersonnelRepository $tpersonnelRepository, EntityManagerInterface $em ): Response {

        $requette = $tpersonnelRepository->findAll();

        if ( isset( $_POST[ 'enregistrer' ] ) ) {
            $data = $request->request->all();
            if ( !empty( $data ) ) {
                $emprunt = new TEmpruntRetour();
                $emprunt->setDateEmprunt( new DateTime( $data[ 'date' ] ) );
                $emprunt->setHeureEmprunt( new DateTime( $data[ 'heure' ] ) );
                $id_personnel = $em->getReference( Tpersonnel::class, $data[ 'personnel' ] );
                $emprunt->setIdPersonnel( $id_personnel );
                $id_stock = $em->getReference( Tstock::class, $id );
                $emprunt->setIdStock( $id_stock );
                $emprunt->setQuantite( $data[ 'quantite' ] );
                $em->persist( $emprunt );
                $em->flush();
            }
        }

        $context = [
            'listes'=>$requette,
        ];

        return $this->render( 'stock/emprunter.html.twig', $context );
    }

    #[ Route( '/stock/listes/emprunt/toutes/listes', name: 'app_stock_emprunter_tout' ) ]

    public function tout( TEmpruntRetourRepository $tEmpruntRetourRepository ): Response {

        $requette = $tEmpruntRetourRepository->findAll();

        $context = [
            'listes'=>$requette,
        ];

        return $this->render( 'stock/listes_emprunt.html.twig', $context );
    }

    #[ Route( '/stock/listes/emprunt/retour/{id}/{ids}', name: 'app_stock_listes_produit_retour' ) ]

    public function retour( $id, $ids, Request $request, EntityManagerInterface $em ): Response {
        $requette = $em->getRepository( TEmpruntRetour::class )->rechercheToutEmprunt( $id, $ids );

        $id_emr = $requette[ 0 ]->getId();
        $req = $em->getRepository( TEmpruntRetour::class )->find( $id_emr );
        if ( isset( $_POST[ 'enregistrer' ] ) ) {
            $data = $request->request->all();
            if ( !empty( $data ) ) {
                $remarque = $data[ 'remarque' ];
                $heure_retour = $data[ 'heure' ];
                $req->setRemarque( $remarque );
                $req->setHeureRetour( new DateTime( $heure_retour ) );
                $em->persist( $req );
                $em->flush();
                return $this->redirectToRoute( 'app_stock_emprunter_tout' );
            }
        }
        return $this->render( 'stock/retour.html.twig' );
    }

    #[ Route( '/stock/listes/utiliser', name: 'app_stock_listes_utiliser' ) ]

    public function lis( TstockRepository $tstock ): Response {

        $requette = $tstock->rechercheToutUtiliser();
        
        $context = [
            'listes'=>$requette,
        ];

        return $this->render( 'stock/utilisation_consomable.html.twig', $context );
    }

    #[ Route( '/stock/listes/utiliser/{id}', name: 'app_stock_utiliser' ) ]

    public function utiliser($id,TstockRepository $tstockRepository,Request $request,TpersonnelRepository $tpersonnelRepository,EntityManagerInterface $em): Response {

        $requette = $tpersonnelRepository->findAll();
        
        if (isset($_POST['enregistrer'])) {
            $data = $request->request->all();
            if (!empty($data)) {

                $req = $tstockRepository->find($id);
                $quantite_au = $req->getQuantite();
                $nouv_qte = $quantite_au - $data['qtel'];
                $req->setQuantite($nouv_qte);
                

                $utiliser = new TUtilisationConsomable();
                $utiliser->setDateLivraison(new DateTime($data['datel']));
                $id_personnel = $em->getReference(Tpersonnel::class,$data['personnel']);
                $id_stock = $em->getReference(Tstock::class,$id);
                $utiliser->setIdPersonnel($id_personnel);
                $utiliser->setIdStock($id_stock);
                $utiliser->setInstruction($data['instruction']);
                $utiliser->setQuantiteDemander($data['qted']);
                $utiliser->setQuantiteLivrer($data['qtel']);
                $utiliser->setReste($data['reste']);
                $em->persist($utiliser);

                $em->persist($req);
                $em->flush();
            }
        }


        $context = [
            'listes'=>$requette,
        ];

        return $this->render( 'stock/user.html.twig', $context );
    }

}
