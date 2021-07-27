<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit;

use Psr\Log\LoggerInterface;
use SandwaveIo\BaseKit\Api\Interfaces\LoginApiInterface;
use SandwaveIo\BaseKit\Api\Interfaces\PackagesApiInterface;
use SandwaveIo\BaseKit\Api\Interfaces\SitesApiInterface;
use SandwaveIo\BaseKit\Api\Interfaces\SslApiInterface;
use SandwaveIo\BaseKit\Api\Interfaces\UserApiInterface;
use SandwaveIo\BaseKit\Api\LoginApi;
use SandwaveIo\BaseKit\Api\PackageApi;
use SandwaveIo\BaseKit\Api\SitesApi;
use SandwaveIo\BaseKit\Api\SslApi;
use SandwaveIo\BaseKit\Api\UserApi;
use SandwaveIo\BaseKit\Support\AuthorizedClient;

final class BaseKit
{
    const BASE_URL = 'https://example.com';

    public UserApiInterface $userApi;

    public LoginApiInterface $loginApi;

    public SitesApiInterface $sitesApi;

    public PackagesApiInterface $packageApi;

    public SslApiInterface $sslApi;

    public function __construct(string $username, string $password, ?string $baseUrl = null, ?LoggerInterface $logger = null)
    {
        $url = $baseUrl ?? BaseKit::BASE_URL;
        $this->setClient(new AuthorizedClient($url, $username, $password, [], $logger));
    }

    public function setClient(AuthorizedClient $client): void
    {
        $this->userApi = new UserApi($client);
        $this->loginApi = new LoginApi($client);
        $this->sitesApi = new SitesApi($client);
        $this->packageApi = new PackageApi($client);
        $this->sslApi = new SslApi($client);
    }
}
