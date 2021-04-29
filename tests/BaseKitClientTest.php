<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Tests;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use SandwaveIo\BaseKit\Api\UserApi;
use SandwaveIo\BaseKit\BaseKit;

class BaseKitClientTest extends TestCase
{
    public function testConstruct(): void
    {
        $client = new BaseKit('bigsecretdonttellanyone', 'https://example.com/api/');

        Assert::assertInstanceOf(BaseKit::class, $client, 'The client could not be instantiated.');
        Assert::assertInstanceOf(UserApi::class, $client->user, 'The User api could not be instantiated.');
    }
}
