<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Api\Interfaces;

interface SslApiInterface
{
    /**
     * @param string        $domain
     * @param string        $privateKey
     * @param string        $certificate
     * @param array<string> $domains
     * @param array<string> $intermediates
     */
    public function addSsl(
        string $domain,
        string $privateKey,
        string $certificate,
        array $domains = [],
        array $intermediates = []
    ): void;
}
