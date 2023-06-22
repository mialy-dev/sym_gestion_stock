<?php

namespace App\Controller;

use App\Entity\Tfamille;
use App\Form\TfamilleType;
use App\Repository\TfamilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/famille")
 */
class FamilleController extends AbstractController
{
    /**
     * @Route("/", name="app_famille_index", methods={"GET"})
     */
    public function index(TfamilleRepository $tfamilleRepository): Response
    {
        return $this->render('famille/index.html.twig', [
            'tfamilles' => $tfamilleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_famille_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TfamilleRepository $tfamilleRepository): Response
    {
        $tfamille = new Tfamille();
        $form = $this->createForm(TfamilleType::class, $tfamille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tfamilleRepository->add($tfamille, true);

            return $this->redirectToRoute('app_famille_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('famille/new.html.twig', [
            'tfamille' => $tfamille,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_famille_show", methods={"GET"})
     */
    public function show(Tfamille $tfamille): Response
    {
        return $this->render('famille/show.html.twig', [
            'tfamille' => $tfamille,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_famille_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Tfamille $tfamille, TfamilleRepository $tfamilleRepository): Response
    {
        $form = $this->createForm(TfamilleType::class, $tfamille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tfamilleRepository->add($tfamille, true);

            return $this->redirectToRoute('app_famille_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('famille/edit.html.twig', [
            'tfamille' => $tfamille,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_famille_delete", methods={"POST"})
     */
    public function delete(Request $request, Tfamille $tfamille, TfamilleRepository $tfamilleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tfamille->getId(), $request->request->get('_token'))) {
            $tfamilleRepository->remove($tfamille, true);
        }

        return $this->redirectToRoute('app_famille_index', [], Response::HTTP_SEE_OTHER);
    }
}
