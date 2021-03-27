<?php

namespace App\EventListener;

use App\Service\Maintenance\MaintenanceModeServiceInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class MaintenanceListener
 * @package App\EventListener
 */
class MaintenanceListener
{
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var MaintenanceModeServiceInterface
     */
    private $mode;

    /**
     * MaintenanceListener constructor.
     * @param Environment $twig
     * @param MaintenanceModeServiceInterface $mode
     */
    public function __construct(Environment $twig, MaintenanceModeServiceInterface $mode)
    {
        $this->twig = $twig;
        $this->mode = $mode;
    }

    /**
     * @param RequestEvent $event
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$this->mode->isEnabled()) {
            return;
        }

        $event->setResponse(new Response(
            $this->twig->render('maintenance/maintenance.html.twig'),
            Response::HTTP_SERVICE_UNAVAILABLE
        ));
    }
}
