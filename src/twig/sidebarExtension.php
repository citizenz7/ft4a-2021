<?php

namespace App\twig;

use App\Repository\LicenceRepository;
use App\Repository\TorrentRepository;
use App\Repository\TorrentsRepository;
use App\Repository\CategoryRepository;
use App\Repository\LicencesRepository;
use App\Repository\CommentRepository;
use App\Repository\MemberRepository;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class sidebarExtension extends AbstractExtension
{
    /**
     * @var TorrentRepository
     */
    private $torrentRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var LicenceRepository
     */
    private $licenceRepository;

    /**
     * @var MemberRepository
     */
    private $memberRepository;

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var Environment
     */
    private $environment;

    /**
     * sidebarExtension constructor.
     * @param TorrentRepository $torrentRepository
     * @param CategoryRepository $categoryRepository
     * @param LicenceRepository $licenceRepository
     * @param MemberRepository $memberRepository
     * @param CommentRepository $commentRepository
     * @param Environment $environment
     */
    public function __construct(
        TorrentRepository $torrentRepository,
        CategoryRepository $categoryRepository,
        LicenceRepository $licenceRepository,
        MemberRepository $memberRepository,
        CommentRepository $commentRepository,
        Environment $environment
    )
    {
        $this->torrentRepository = $torrentRepository;
        $this->categoryRepository = $categoryRepository;
        $this->licencesRepository = $licenceRepository;
        $this->memberRepository = $memberRepository;
        $this->commentRepository = $commentRepository;
        $this->environment = $environment;
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('sidebar', [$this, 'getSidebar'], ['is_safe' => ['html']])
        ];
    }

    /**
     * @return string
     */
    public function getSidebar(): string
    {
        $torrents = $this->torrentRepository->popularTorrents();
        $torrentsAll = $this->torrentRepository->findAll();
        $comments = $this->commentRepository->lastComments();
        $commentsAll = $this->commentRepository->findAll();
        $categories = $this->categoryRepository->findAll();
        //$licences = $this->licenceRepository->findAll();
        $members = $this->memberRepository->findAll();
        $views = $this->torrentRepository->totalViews();

        try {
            return $this->environment->render('home/_sidebar.html.twig',
                compact('torrents', 'torrentsAll', 'comments', 'commentsAll', 'categories', 'licences', 'members', 'views'));
        }
        catch (LoaderError | RuntimeError | SyntaxError $e) {
            // TODO : LOGGER
        }
    }
}
