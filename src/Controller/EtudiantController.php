<?php

namespace App\Controller;

use App\Entity\Tclasse;
use App\Entity\Tetudiant;
use App\Repository\TclasseRepository;
use App\Repository\TetudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/etudiant", name="app_etudiant")
     */
    public function index(Request $request,TclasseRepository $tclasseRepository,EntityManagerInterface $em): Response
    {
        $listeC = $tclasseRepository->findAll();

        if (isset($_POST['enregistrer'])) {
            $data = $request->request->all();
            if (!empty($data)) {
                $etudiant = new Tetudiant();
                $etudiant->setNom($data['nom']);
                $etudiant->setPrenom($data['prenom']);
                $etudiant->setMatricule($data['matricule']);
                $id_classe = $em->getReference(Tclasse::class,$data['classe']);
                $etudiant->setIdClasse($id_classe);
                $em->persist($etudiant);
                $em->flush();
            }
        }
        $context=[
            'listeC'=>$listeC
        ];
        return $this->render('etudiant/index.html.twig',$context);
    }


    /**
     * @Route("/etudiant/listes", name="app_etudiant_liste")
     */
    public function listes(TetudiantRepository $tetudiantRepository): Response
    {
        $listeC = $tetudiantRepository->rechercheTout();

        $context=[
            'listes'=>$listeC
        ];
        return $this->render('etudiant/listes.html.twig',$context);
    }

}
