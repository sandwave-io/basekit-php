<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Api;

use SandwaveIo\BaseKit\Support\AuthorizedClient;

abstract class AbstractApi
{
    protected AuthorizedClient $client;

    public function __construct(AuthorizedClient $client)
    {
        $this->client = $client;
    }
}
