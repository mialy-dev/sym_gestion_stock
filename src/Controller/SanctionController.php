<?php

namespace App\Controller;

use App\Entity\Tpersonnel;
use App\Entity\Tsanction;
use App\Entity\Tetudiant;
use App\Form\SanctionType;
use App\Repository\TetudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TsanctionRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TpersonnelRepository;

use DateTime;
class SanctionController extends AbstractController
{
    /**
     * @Route("/sanction/create",methods={"GET", "POST"}, name="app_sanction_create")
     */
    public function create
    (
        Request $request,
        TsanctionRepository $tsanctionRepository
    )
    {
        $sanction = new Tsanction();
        $form = $this->createForm(SanctionType::class, $sanction);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
             $tsanctionRepository->add($sanction);
             return $this->redirectToRoute("app_sanction_listes");           
        }
        # code...
        return $this->renderForm("sanction/create.html.twig", compact("form"));
    }



    /**
     * @Route("/sanction/listes", name="app_sanction_listes")
     */

     public function listes(TsanctionRepository  $tsactionRepository): Response
    {
        $requette = $tsactionRepository->findAll();
        
        $context = [
            'listes'=>$requette
        ];

        return $this->render('sanction/listes.html.twig',$context);
    }
}
