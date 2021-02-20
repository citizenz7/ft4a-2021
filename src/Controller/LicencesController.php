<?php

namespace App\Controller;

use App\Entity\Licences;
use App\Form\LicencesType;
use App\Repository\LicencesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/licences")
 */
class LicencesController extends AbstractController
{
    /**
     * @Route("/", name="licences_index", methods={"GET"})
     * @param LicencesRepository $licencesRepository
     * @return Response
     */
    public function index(LicencesRepository $licencesRepository): Response
    {
        return $this->render('licences/index.html.twig', [
            'licences' => $licencesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="licences_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $licence = new Licences();
        $form = $this->createForm(LicencesType::class, $licence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($licence);
            $entityManager->flush();

            return $this->redirectToRoute('licences_index');
        }

        return $this->render('licences/new.html.twig', [
            'licence' => $licence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="licences_show", methods={"GET"})
     * @param Licences $licence
     * @return Response
     */
    public function show(Licences $licence): Response
    {
        return $this->render('licences/show.html.twig', [
            'licence' => $licence,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="licences_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Licences $licence
     * @return Response
     */
    public function edit(Request $request, Licences $licence): Response
    {
        $form = $this->createForm(LicencesType::class, $licence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('licences_index');
        }

        return $this->render('licences/edit.html.twig', [
            'licence' => $licence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="licences_delete", methods={"DELETE"})
     * @param Request $request
     * @param Licences $licence
     * @return Response
     */
    public function delete(Request $request, Licences $licence): Response
    {
        if ($this->isCsrfTokenValid('delete'.$licence->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($licence);
            $entityManager->flush();
        }

        return $this->redirectToRoute('licences_index');
    }
}
