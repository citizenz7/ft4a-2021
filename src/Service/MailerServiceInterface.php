<?php

namespace App\Service;

/**
 * Interface MailerServiceInterface
 * @package App\Service
 */
interface MailerServiceInterface
{
    /**
     * @param array $from
     * @param string $to
     * @param string $subject
     * @param string $mjmlTemplate
     * @param string $textTemplate
     * @param array $params
     */
    public function send(array $from, string $to, string $subject, string $mjmlTemplate, string $textTemplate, array $params): void;
}
