<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit;

use Psr\Log\LoggerInterface;
use SandwaveIo\BaseKit\Api\LoginApi;
use SandwaveIo\BaseKit\Api\UserApi;
use SandwaveIo\BaseKit\Support\AuthorizedClient;

final class BaseKit
{
    const BASE_URL = 'https://example.com';

    public UserApi $user;
    public LoginApi $loginApi;

    public function __construct(string $username, string $password, ?string $baseUrl = null, ?LoggerInterface $logger = null)
    {
        $url = $baseUrl ?: BaseKit::BASE_URL;
        $this->setClient(new AuthorizedClient($url, $username, $password, [], $logger));
    }

    public function setClient(AuthorizedClient $client): void
    {
        $this->user = new UserApi($client);
        $this->loginApi = new LoginApi($client);
    }
}
