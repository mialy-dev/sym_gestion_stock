<?php

namespace App\Controller;

use App\Entity\TCle;
use App\Form\TCleType;
use App\Repository\TCleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cle")
 */
class CleController extends AbstractController
{
    /**
     * @Route("/", name="app_cle_index", methods={"GET"})
     */
    public function index(TCleRepository $tCleRepository): Response
    {
        return $this->render('cle/index.html.twig', [
            't_cles' => $tCleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_cle_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TCleRepository $tCleRepository): Response
    {
        $tCle = new TCle();
        $form = $this->createForm(TCleType::class, $tCle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tCleRepository->add($tCle, true);

            return $this->redirectToRoute('app_cle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cle/new.html.twig', [
            't_cle' => $tCle,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_cle_show", methods={"GET"})
     */
    public function show(TCle $tCle): Response
    {
        return $this->render('cle/show.html.twig', [
            't_cle' => $tCle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_cle_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, TCle $tCle, TCleRepository $tCleRepository): Response
    {
        $form = $this->createForm(TCleType::class, $tCle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tCleRepository->add($tCle, true);

            return $this->redirectToRoute('app_cle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cle/edit.html.twig', [
            't_cle' => $tCle,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_cle_delete", methods={"POST"})
     */
    public function delete(Request $request, TCle $tCle, TCleRepository $tCleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tCle->getId(), $request->request->get('_token'))) {
            $tCleRepository->remove($tCle, true);
        }

        return $this->redirectToRoute('app_cle_index', [], Response::HTTP_SEE_OTHER);
    }
}
