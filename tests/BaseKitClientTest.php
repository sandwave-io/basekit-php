<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Tests;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use SandwaveIo\BaseKit\Api\LoginApi;
use SandwaveIo\BaseKit\Api\PackageApi;
use SandwaveIo\BaseKit\Api\SitesApi;
use SandwaveIo\BaseKit\Api\SslApi;
use SandwaveIo\BaseKit\Api\UserApi;
use SandwaveIo\BaseKit\BaseKit;

final class BaseKitClientTest extends TestCase
{
    public function testConstruct(): void
    {
        $client = new BaseKit('test', 'bigsecretdonttellanyone', 'https://example.com/api/');

        Assert::assertInstanceOf(BaseKit::class, $client, 'The client could not be instantiated.');
        Assert::assertInstanceOf(UserApi::class, $client->userApi, 'The User api could not be instantiated.');
        Assert::assertInstanceOf(LoginApi::class, $client->loginApi, 'The LoginApi could not be instantiated.');
        Assert::assertInstanceOf(SitesApi::class, $client->sitesApi, 'The SiteApi could not be instantiated.');
        Assert::assertInstanceOf(PackageApi::class, $client->packageApi, 'The PackageApi could not be instantiated.');
        Assert::assertInstanceOf(SslApi::class, $client->sslApi, 'The SslApi could not be instantiated.');
    }
}
