<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Tests\Api\UserApi;

use PHPUnit\Framework\TestCase;
use SandwaveIo\BaseKit\Tests\Helpers\MockedClientFactory;

final class UpdateTest extends TestCase
{
    public function testUpdate(): void
    {
        $client = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('PUT', '/users/123')
        );

        $client->userApi->update(123, 'Henk');
    }
}
