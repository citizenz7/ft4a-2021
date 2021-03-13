<?php

namespace App\Controller;

use App\Form\SearchTorrentsType;
use App\Repository\TorrentRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SearchController
 * @package App\Controller
 */
class SearchController extends AbstractController
{
    /**
     * @Route("/recherche", name="recherche", methods={"GET","POST"})
     * @param Request $request
     * @param TorrentRepository $repo
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, TorrentRepository $repo, PaginatorInterface $paginator): Response
    {
        $searchForm = $this->createForm(SearchTorrentsType::class);
        $searchForm->handleRequest($request);

        $donnees = $repo->findTorrents();

        if ($searchForm->isSubmitted() && $searchForm->isValid())
        {
            $title = $searchForm->getData()->getTitle();
            $donnees = $repo->search($title);
        }

        // Paginate the results of the query
        $torrents = $paginator->paginate(
            $donnees, // Doctrine Query, not results
            $request->query->getInt('page', 1), // Define the page parameter
            7 // Items per page
        );

        return $this->render('search/index.html.twig', [
            'torrents' => $torrents,
            'searchForm' => $searchForm->createView()
        ]);
    }
}
