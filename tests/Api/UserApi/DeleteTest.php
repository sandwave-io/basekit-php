<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Tests\Api\UserApi;

use PHPUnit\Framework\TestCase;
use SandwaveIo\BaseKit\Tests\Helpers\MockedClientFactory;

final class DeleteTest extends TestCase
{
    public function testDelete(): void
    {
        $client = MockedClientFactory::makeSdk(
            204,
            '',
            MockedClientFactory::assertRoute('DELETE', '/users/1234')
        );

        $client->userApi->delete(1234);
    }
}
