<?php

namespace App\Controller;

use App\Entity\Tunite;
use App\Form\TuniteType;
use App\Repository\TuniteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/unite")
 */
class UniteController extends AbstractController
{
    /**
     * @Route("/", name="app_unite_index", methods={"GET","POST"})
     */
    public function index(TuniteRepository $tuniteRepository): Response
    {
        $requette = $tuniteRepository->findAll();

        if (isset($_POST['rechercher'])) {
            $element = $_POST['recherche'];
            $requette = $tuniteRepository->rechercheUnite($element);
        }

        $context = [
            'tunites' => $requette,
        ];
        return $this->render('unite/index.html.twig', $context);
    }

    /**
     * @Route("/new", name="app_unite_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TuniteRepository $tuniteRepository): Response
    {
        $tunite = new Tunite();
        $form = $this->createForm(TuniteType::class, $tunite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tuniteRepository->add($tunite, true);

            return $this->redirectToRoute('app_unite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('unite/new.html.twig', [
            'tunite' => $tunite,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_unite_show", methods={"GET"})
     */
    public function show(Tunite $tunite): Response
    {
        return $this->render('unite/show.html.twig', [
            'tunite' => $tunite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_unite_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Tunite $tunite, TuniteRepository $tuniteRepository): Response
    {
        $form = $this->createForm(TuniteType::class, $tunite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tuniteRepository->add($tunite, true);

            return $this->redirectToRoute('app_unite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('unite/edit.html.twig', [
            'tunite' => $tunite,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_unite_delete", methods={"POST"})
     */
    public function delete(Request $request, Tunite $tunite, TuniteRepository $tuniteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tunite->getId(), $request->request->get('_token'))) {
            $tuniteRepository->remove($tunite, true);
        }

        return $this->redirectToRoute('app_unite_index', [], Response::HTTP_SEE_OTHER);
    }
}
