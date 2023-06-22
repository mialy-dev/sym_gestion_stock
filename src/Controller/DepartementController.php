<?php

namespace App\Controller;

use App\Entity\Tdepartement;
use App\Form\TdepartementType;
use App\Repository\TdepartementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/departement")
 */
class DepartementController extends AbstractController
{
    /**
     * @Route("/", name="app_departement_index", methods={"GET"})
     */
    public function index(TdepartementRepository $tdepartementRepository): Response
    {
        return $this->render('departement/index.html.twig', [
            'tdepartements' => $tdepartementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_departement_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TdepartementRepository $tdepartementRepository): Response
    {
        $tdepartement = new Tdepartement();
        $form = $this->createForm(TdepartementType::class, $tdepartement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tdepartementRepository->add($tdepartement, true);

            return $this->redirectToRoute('app_departement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('departement/new.html.twig', [
            'tdepartement' => $tdepartement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_departement_show", methods={"GET"})
     */
    public function show(Tdepartement $tdepartement): Response
    {
        return $this->render('departement/show.html.twig', [
            'tdepartement' => $tdepartement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_departement_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Tdepartement $tdepartement, TdepartementRepository $tdepartementRepository): Response
    {
        $form = $this->createForm(TdepartementType::class, $tdepartement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tdepartementRepository->add($tdepartement, true);

            return $this->redirectToRoute('app_departement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('departement/edit.html.twig', [
            'tdepartement' => $tdepartement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_departement_delete", methods={"POST"})
     */
    public function delete(Request $request, Tdepartement $tdepartement, TdepartementRepository $tdepartementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tdepartement->getId(), $request->request->get('_token'))) {
            $tdepartementRepository->remove($tdepartement, true);
        }

        return $this->redirectToRoute('app_departement_index', [], Response::HTTP_SEE_OTHER);
    }
}
