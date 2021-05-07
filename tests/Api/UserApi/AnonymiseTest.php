<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Tests\Api\UserApi;

use PHPUnit\Framework\TestCase;
use SandwaveIo\BaseKit\Tests\Helpers\MockedClientFactory;

final class AnonymiseTest extends TestCase
{
    public function testAnonymise(): void
    {
        $client = MockedClientFactory::makeSdk(
            204,
            '',
            MockedClientFactory::assertRoute('POST', '/users/1234/anonymise')
        );

        $client->userApi->anonymiseUser(1234);
    }
}
