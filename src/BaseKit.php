<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit;

use Psr\Log\LoggerInterface;
use SandwaveIo\BaseKit\Support\AuthorizedClient;

final class BaseKit
{
    const BASE_URL = 'https://example.com';

    public function __construct(string $apiKey, ?string $baseUrl = null, ?LoggerInterface $logger = null)
    {
        $url = $baseUrl ?: BaseKit::BASE_URL;
        $this->setClient(new AuthorizedClient($url, $apiKey, [], $logger));
    }

    public function setClient(AuthorizedClient $client): void
    {
    }
}
