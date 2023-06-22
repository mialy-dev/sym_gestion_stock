<?php

namespace App\Controller;

use App\Entity\Ttype;
use App\Form\TtypeType;
use App\Repository\TtypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type")
 */
class TypeController extends AbstractController
{
    /**
     * @Route("/", name="app_type_index", methods={"GET"})
     */
    public function index(TtypeRepository $ttypeRepository): Response
    {
        return $this->render('type/index.html.twig', [
            'ttypes' => $ttypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_type_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TtypeRepository $ttypeRepository): Response
    {
        $ttype = new Ttype();
        $form = $this->createForm(TtypeType::class, $ttype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ttypeRepository->add($ttype, true);

            return $this->redirectToRoute('app_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type/new.html.twig', [
            'ttype' => $ttype,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_type_show", methods={"GET"})
     */
    public function show(Ttype $ttype): Response
    {
        return $this->render('type/show.html.twig', [
            'ttype' => $ttype,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_type_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Ttype $ttype, TtypeRepository $ttypeRepository): Response
    {
        $form = $this->createForm(TtypeType::class, $ttype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ttypeRepository->add($ttype, true);

            return $this->redirectToRoute('app_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type/edit.html.twig', [
            'ttype' => $ttype,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_type_delete", methods={"POST"})
     */
    public function delete(Request $request, Ttype $ttype, TtypeRepository $ttypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ttype->getId(), $request->request->get('_token'))) {
            $ttypeRepository->remove($ttype, true);
        }

        return $this->redirectToRoute('app_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
