<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Tests\Api\PackageApi;

use PHPUnit\Framework\TestCase;
use SandwaveIo\BaseKit\Tests\Helpers\MockedClientFactory;

final class AddUserPackageTest extends TestCase
{
    public function testAddUserPackage(): void
    {
        $client = MockedClientFactory::makeSdk(
            200,
            (string) file_get_contents(__DIR__ . '/../data/users-add-account-package.json'),
            MockedClientFactory::assertRoute('POST', '/users/12345/account-packages')
        );

        $client->packageApi->addUserPackage(12345, 567, 12);
    }
}
