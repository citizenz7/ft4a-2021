<?php

namespace App\twig;

use App\Repository\TorrentsRepository;
use App\Repository\CategoriesRepository;
use App\Repository\LicencesRepository;
use App\Repository\CommentsRepository;
use App\Repository\MembersRepository;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class sidebarExtension extends AbstractExtension
{
    /**
     * @var TorrentsRepository
     */
    private $torrentsRepository;

    /**
     * @var CategoriesRepository
     */
    private $categoriesRepository;

    /**
     * @var LicencesRepository
     */
    private $licencesRepository;

    /**
     * @var MembersRepository
     */
    private $membersRepository;

    /**
     * @var CommentsRepository
     */
    private $commentsRepository;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * sidebarExtension constructor.
     * @param TorrentsRepository $torrentsRepository
     * @param CategoriesRepository $categoriesRepository
     * @param LicencesRepository $licencesRepository
     * @param MembersRepository $membersRepository
     * @param CommentsRepository $commentsRepository
     * @param Environment $twig
     */
    public function __construct(
        TorrentsRepository $torrentsRepository,
        CategoriesRepository $categoriesRepository,
        LicencesRepository $licencesRepository,
        MembersRepository $membersRepository,
        CommentsRepository $commentsRepository,
        Environment $twig
    )
    {
        $this->torrentsRepository = $torrentsRepository;
        $this->categoriesRepository = $categoriesRepository;
        $this->licencesRepository = $licencesRepository;
        $this->membersRepository = $membersRepository;
        $this->commentsRepository = $commentsRepository;
        $this->twig = $twig;
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

    public function getSidebar(): string
    {
        $torrents = $this->torrentsRepository->popularTorrents();
        $torrentsAll = $this->torrentsRepository->findAll();
        $comments = $this->commentsRepository->lastComments();
        $commentsAll = $this->commentsRepository->findAll();
        $categories = $this->categoriesRepository->findAll();
        $licences = $this->licencesRepository->findAll();
        $members = $this->membersRepository->findAll();
        $views = $this->torrentsRepository->totalViews();

        try {
            return $this->twig->render('home/sidebar.html.twig',
                compact('torrents', 'torrentsAll', 'comments', 'commentsAll', 'categories', 'licences', 'members', 'views'));
        }
        catch (LoaderError | RuntimeError | SyntaxError $e) { }
    }
}
