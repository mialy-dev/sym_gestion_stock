<?php

namespace App\Controller;

use App\Entity\Tdepartement;
use App\Entity\Tpersonnel;
use App\Repository\TdepartementRepository;
use App\Repository\TpersonnelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonnelController extends AbstractController
{
    /**
     * @Route("/personnel", name="app_personnel")
     */
    public function index(TdepartementRepository $tdepartementRepository,Request $request,EntityManagerInterface $em): Response
    {
        $requette = $tdepartementRepository->findAll();
        if (isset($_POST['enregistrer'])) {
            $data = $request->request->all();
            if (!empty($data)) {
                $personnel = new Tpersonnel();
                $personnel->setNom($data['nom']);
                $personnel->setPrenom($data['prenom']);
                $personnel->setEmail($data['email']);
                $id_departement = $em->getReference(Tdepartement::class,$data['departement']);
                $personnel->setIdDepartement($id_departement);
                $em->persist($personnel);
                $em->flush();
            }
            
        }

        $context = [
            'listes'=>$requette
        ];

        return $this->render('personnel/index.html.twig',$context);
    }


    /**
     * @Route("/personnel/listes", name="app_personnel_listes")
     */
    public function listes(TpersonnelRepository $tpersonnelRepository): Response
    {
        $requette = $tpersonnelRepository->findAll();
        
        $context = [
            'listes'=>$requette
        ];

        return $this->render('personnel/listes.html.twig',$context);
    }


}
