<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Tests\Api\LoginApi;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use SandwaveIo\BaseKit\Exceptions\UnexpectedValueException;
use SandwaveIo\BaseKit\Tests\Helpers\MockedClientFactory;

final class AutoLoginTest extends TestCase
{
    public function testAutoLogin(): void
    {
        $client = MockedClientFactory::makeSdk(
            200,
            (string) file_get_contents(__DIR__ . '/../data/users-auto-login.json'),
            MockedClientFactory::assertRoute('POST', '/users/12345/auto-login')
        );

        $response = $client->loginApi->autoLogin(12345);
        Assert::assertIsString($response);
        Assert::assertSame('0123456789abcdef', $response);
    }

    public function testAutoLoginInvlalid(): void
    {
        $client = MockedClientFactory::makeSdk(
            200,
            '{}',
            MockedClientFactory::assertRoute('POST', '/users/12345/auto-login')
        );

        $this->expectException(UnexpectedValueException::class);
        $client->loginApi->autoLogin(12345);
    }
}
