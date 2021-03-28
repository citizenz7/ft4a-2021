<?php

namespace App\Service\Mjml;

/**
 * Interface RendererMjmlServiceInterface
 * @package App\Service\Mjml
 */
interface RendererMjmlServiceInterface
{
    /**
     * Renderer MJML to HTML content
     * @param string $content The MJML content
     * @return string The generated HTML
     */
    public function render(string $content): string;

}
