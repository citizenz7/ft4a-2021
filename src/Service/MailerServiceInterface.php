<?php

namespace App\Service;

/**
 * Interface MailerServiceInterface
 * @package App\Service
 */
interface MailerServiceInterface
{
    /**
     * @param string $to
     * @param string $htmlTemplate
     * @param string $textTemplate
     * @param array $params
     */
    public function send(string $to, string $htmlTemplate,string $textTemplate, array $params): void;
}
