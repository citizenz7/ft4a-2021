<?php

namespace App\Controller;

use App\Entity\Torrents;
use App\Form\TorrentsType;
use App\Repository\TorrentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/torrents")
 */
class TorrentsController extends AbstractController
{
    /**
     * @Route("/", name="torrents_index", methods={"GET"})
     * @param TorrentsRepository $torrentsRepository
     * @return Response
     */
    public function index(TorrentsRepository $torrentsRepository): Response
    {
        return $this->render('torrents/index.html.twig', [
            'torrents' => $torrentsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="torrents_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $torrent = new Torrents();
        $form = $this->createForm(TorrentsType::class, $torrent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            // Set the datetime
            $torrent->setDate(new \DateTime());

            // Set the connected member
            $torrent->setAuthor($this->getUser());

            // Set number of views to 1 when creating torrent
            $torrent->setViews('1');

            $entityManager->persist($torrent);
            $entityManager->flush();

            return $this->redirectToRoute('torrents_index');
        }

        return $this->render('torrents/new.html.twig', [
            'torrent' => $torrent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="torrents_show", methods={"GET"})
     * @param Torrents $torrent
     * @return Response
     */
    public function show(Torrents $torrent): Response
    {
        // Views: +1 for each visit
        $read = $torrent->getViews() + 1;
        $torrent->setViews($read);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($torrent);
        $entityManager->flush();

        return $this->render('torrents/show.html.twig', [
            'torrent' => $torrent,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="torrents_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Torrents $torrent
     * @return Response
     */
    public function edit(Request $request, Torrents $torrent): Response
    {
        $form = $this->createForm(TorrentsType::class, $torrent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('torrents_index');
        }

        return $this->render('torrents/edit.html.twig', [
            'torrent' => $torrent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="torrents_delete", methods={"DELETE"})
     * @param Request $request
     * @param Torrents $torrent
     * @return Response
     */
    public function delete(Request $request, Torrents $torrent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$torrent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($torrent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('torrents_index');
    }
}
