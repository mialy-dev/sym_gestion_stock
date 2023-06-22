<?php

namespace App\Controller;

use App\Entity\Tclasse;
use App\Form\TclasseType;
use App\Repository\TclasseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/classe")
 */
class ClasseController extends AbstractController
{
    /**
     * @Route("/", name="app_classe_index", methods={"GET"})
     */
    public function index(TclasseRepository $tclasseRepository): Response
    {
        return $this->render('classe/index.html.twig', [
            'tclasses' => $tclasseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_classe_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TclasseRepository $tclasseRepository): Response
    {
        $tclasse = new Tclasse();
        $form = $this->createForm(TclasseType::class, $tclasse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tclasseRepository->add($tclasse, true);

            return $this->redirectToRoute('app_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('classe/new.html.twig', [
            'tclasse' => $tclasse,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_classe_show", methods={"GET"})
     */
    public function show(Tclasse $tclasse): Response
    {
        return $this->render('classe/show.html.twig', [
            'tclasse' => $tclasse,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_classe_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Tclasse $tclasse, TclasseRepository $tclasseRepository): Response
    {
        $form = $this->createForm(TclasseType::class, $tclasse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tclasseRepository->add($tclasse, true);

            return $this->redirectToRoute('app_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('classe/edit.html.twig', [
            'tclasse' => $tclasse,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_classe_delete", methods={"POST"})
     */
    public function delete(Request $request, Tclasse $tclasse, TclasseRepository $tclasseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tclasse->getId(), $request->request->get('_token'))) {
            $tclasseRepository->remove($tclasse, true);
        }

        return $this->redirectToRoute('app_classe_index', [], Response::HTTP_SEE_OTHER);
    }
}
