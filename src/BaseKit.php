<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit;

use Psr\Log\LoggerInterface;
use SandwaveIo\BaseKit\Api\LoginApi;
use SandwaveIo\BaseKit\Api\PackageApi;
use SandwaveIo\BaseKit\Api\SitesApi;
use SandwaveIo\BaseKit\Api\UserApi;
use SandwaveIo\BaseKit\Support\AuthorizedClient;

final class BaseKit
{
    const BASE_URL = 'https://example.com';

    public UserApi $userApi;
    public LoginApi $loginApi;
    public SitesApi $sitesApi;
    public PackageApi $packageApi;

    public function __construct(string $username, string $password, ?string $baseUrl = null, ?LoggerInterface $logger = null)
    {
        $url = $baseUrl ?: BaseKit::BASE_URL;
        $this->setClient(new AuthorizedClient($url, $username, $password, [], $logger));
    }

    public function setClient(AuthorizedClient $client): void
    {
        $this->userApi = new UserApi($client);
        $this->loginApi = new LoginApi($client);
        $this->sitesApi = new SitesApi($client);
        $this->packageApi = new PackageApi($client);
    }
}
