<?php

namespace App\Controller;

use App\Entity\TCle;
use App\Entity\TEntrerSortie;
use App\Entity\Tpersonnel;
use App\Repository\TCleRepository;
use App\Repository\TEntrerSortieRepository;
use App\Repository\TpersonnelRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CleEntrerRetourController extends AbstractController
{
    /**
     * @Route("/cle/entrer/retour", name="app_cle_entrer_retour")
     */
    public function index(Request $request, TCleRepository $tCleRepository, TpersonnelRepository $tpersonnelRepository, EntityManagerInterface $em): Response
    {
        $listes_personnel = $tpersonnelRepository->findAll();
        $listes_cle = $tCleRepository->findAll();
        if (isset($_POST['enregistrer'])) {
            $data = $request->request->all();
            if (!empty($data)) {
                $emprunt = new TEntrerSortie();
                $emprunt->setDatePrise(new DateTime($data['date_prise']));
                $id_personnel = $em->getReference(Tpersonnel::class, $data['personnel']);
                $id_cle = $em->getReference(TCle::class, $data['cle']);
                $emprunt->setIdPersonnel($id_personnel);
                $emprunt->setIdCle($id_cle);
                $emprunt->setHeureSortie(new DateTime($data['heure_sortie']));
                $em->persist($emprunt);
                $em->flush();
            }
        }
        $context = [
            'listeP' => $listes_personnel,
            'listeC' => $listes_cle
        ];
        return $this->render('cle_entrer_retour/index.html.twig', $context);
    }

    /**
     * @Route("/cle/entrer/retour/listes", name="app_cle_entrer_retour_liste")
     */
    public function listes(TEntrerSortieRepository $tEntrerSortieRepository): Response
    {
        $listes = $tEntrerSortieRepository->rechercheTout();
        $context = [
            'listes' => $listes
        ];
        return $this->render('cle_entrer_retour/listes.html.twig', $context);
    }

    /**
     * @Route("/cle/entrer/retour/retourner/{id}", name="app_cle_entrer_retour_retourner")
     */
    public function retour($id,Request $request,EntityManagerInterface $em,TEntrerSortieRepository $tEntrerSortieRepository): Response
    {
        if (isset($_POST['enregistrer'])) {
            $data = $request->request->all();
            if (!empty($data)) {
               $req = $tEntrerSortieRepository->find($id);
               $req->setHeureRetour(new DateTime($data['heure_retour']));
               $em->persist($req);
               $em->flush();
               return $this->redirectToRoute('app_cle_entrer_retour_liste');
            }
        }
        return $this->render('cle_entrer_retour/retour.html.twig');
    }
}
