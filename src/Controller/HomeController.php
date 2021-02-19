<?php

namespace App\Controller;

use App\Entity\Members;
use App\Entity\Torrents;
use App\Repository\TorrentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home", methods={"GET"})
     * @param TorrentsRepository $repo
     * @return Response
     */
    public function index(TorrentsRepository $repo): Response
    {
        $torrents = $this->getDoctrine()->getRepository(Torrents::class)->findAll();

        return $this->render('home/index.html.twig', [
            'torrents' => $torrents,
        ]);
    }
}
