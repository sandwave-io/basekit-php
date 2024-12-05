<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Tests\Api\UserApi;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use SandwaveIo\BaseKit\Domain\AccountHolder;
use SandwaveIo\BaseKit\Exceptions\UnexpectedValueException;
use SandwaveIo\BaseKit\Tests\Helpers\MockedClientFactory;

final class GetTest extends TestCase
{
    public function testCreate(): void
    {
        $client = MockedClientFactory::makeSdk(
            200,
            (string) file_get_contents(__DIR__ . '/../data/users-get.json'),
            MockedClientFactory::assertRoute('GET', '/users/1')
        );

        $accountHolder = $client->userApi->get(1);
        Assert::assertInstanceOf(AccountHolder::class, $accountHolder);
        Assert::assertSame('Kees', $accountHolder->lastName);
        Assert::assertIsArray($accountHolder->toArray());
    }

    public function testCreateWithInvalidResponse(): void
    {
        $client = MockedClientFactory::makeSdk(
            200,
            '[]',
            MockedClientFactory::assertRoute('GET', '/users/1')
        );
        $this->expectException(UnexpectedValueException::class);
        $client->userApi->get(1);
    }
}
