<?php

namespace App\Controller;

use App\Entity\Torrent;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Repository\LicenceRepository;
use App\Repository\MemberRepository;
use App\Repository\TorrentRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    /**
     * @var TorrentRepository
     */
    private $torrentRepository;
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * HomeController constructor.
     * @param TorrentRepository $torrentRepository
     * @param CommentRepository $commentRepository
     */
    public function __construct(TorrentRepository $torrentRepository, CommentRepository $commentRepository)
    {
        $this->torrentRepository = $torrentRepository;
        $this->commentRepository = $commentRepository;
    }

    /**
     * @Route("/", name="app_home", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $data = $this->torrentRepository->findBy([],['date' => 'desc']);

        $torrents = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('home/index.html.twig', [
            'torrents' => $torrents,
        ]);
    }

    /**
     * @param int $max
     * @return Response
     */
    public function getPopularsTorrents(int $max): Response
    {
        return $this->render('sidebar/_populars_torrents.block.html.twig', [
            'torrents' => $this->torrentRepository->popularTorrents($max),
        ]);
    }

    /**
     * @param int $max
     * @return Response
     */
    public function getLastComments(int $max): Response
    {
        return $this->render('sidebar/_last_comments.block.html.twig', [
            'comments' => $this->commentRepository->lastComments($max),
        ]);
    }

    /**
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function getCategories(CategoryRepository $categoryRepository): Response
    {
        return $this->render('sidebar/_categories.block.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    /**
     * @param LicenceRepository $licenceRepository
     * @return Response
     */
    public function getLicences(LicenceRepository $licenceRepository): Response
    {
        return $this->render('sidebar/_licences.block.html.twig', [
            'licences' => $licenceRepository->findAll(),
        ]);
    }

    /**
     * @param MemberRepository $memberRepository
     * @return Response
     */
    public function getStatSite(MemberRepository $memberRepository): Response
    {
        return $this->render('sidebar/_stat_site.block.html.twig', [
            'comments' => $this->commentRepository->findAll(),
            'members' => $memberRepository->findAll(),
            'views' => $this->torrentRepository->totalViews(),
        ]);
    }
}
