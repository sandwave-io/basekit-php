<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Tests\Api\UserApi;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use SandwaveIo\BaseKit\Domain\AccountHolder;
use SandwaveIo\BaseKit\Tests\Helpers\MockedClientFactory;

final class CreateTest extends TestCase
{
    public function testCreate(): void
    {
        $client = MockedClientFactory::makeSdk(
            201,
            (string) file_get_contents(__DIR__ . '/../data/users-create.json'),
            MockedClientFactory::assertRoute('POST', '/users')
        );

        $accountHolder = $client->userApi->create(1, 'Test', 'Kees', 'testkees', 'Welkom123', 'test.kees@sandwave.io', 'NL');
        Assert::assertInstanceOf(AccountHolder::class, $accountHolder);
        Assert::assertSame('Kees', $accountHolder->lastName);
        Assert::assertIsArray($accountHolder->toArray());
    }
}
