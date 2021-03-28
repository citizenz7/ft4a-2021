<?php

namespace App\Service\Mjml;

use RuntimeException;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Class RendererMjmlService
 * @package App\Service\Mjml
 */
class RendererMjmlService implements RendererMjmlServiceInterface
{
    private $bin;

    /**
     * BinaryRenderer constructor.
     * @param string $bin
     */
    public function __construct(string $bin)
    {
        $this->bin = $bin;
    }


    /**
     * @inheritDoc
     */
    public function render(string $content): string
    {
        $this->checkExistBin();

        $arguments = [
            $this->bin,
            '-i',
            '-s',
            '--config.validationLevel',
            '--config.minify'
        ];

        $process = new Process($arguments);
        $process->setInput($content);

        try {
            $process->mustRun();
        } catch (ProcessFailedException $exception) {
            throw new RuntimeException('Unable to compile MJML. Stack error: ' . $exception->getMessage());
        }

        return $process->getOutput();
    }

    /**
     * @return bool
     */
    private function checkExistBin(): bool
    {
        if (file_exists($this->bin)) {
            return true;
        } else {
            throw new RuntimeException('The file does not exist, please install it with the command `npm install mjml` or `yarn add mjml`.');
        }
    }
}
