<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Tests\Api\SitesApi;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use SandwaveIo\BaseKit\Domain\Site;
use SandwaveIo\BaseKit\Exceptions\UnexpectedValueException;
use SandwaveIo\BaseKit\Tests\Helpers\MockedClientFactory;

final class CreateTest extends TestCase
{
    public function testCreate(): void
    {
        $client = MockedClientFactory::makeSdk(
            201,
            (string) file_get_contents(__DIR__ . '/../data/sites-create.json'),
            MockedClientFactory::assertRoute('POST', '/sites')
        );

        $site = $client->sitesApi->create(1, 1, 'example.com', 'active', 'abc', 123);
        Assert::assertInstanceOf(Site::class, $site);
        Assert::assertSame('example.com', $site->primaryDomain->domainName);
        Assert::assertIsArray($site->toArray());
    }

    public function testCreateInvalidJson(): void
    {
        $client = MockedClientFactory::makeSdk(
            201,
            '[]',
            MockedClientFactory::assertRoute('POST', '/sites')
        );

        $this->expectException(UnexpectedValueException::class);
        $client->sitesApi->create(1, 1, 'example.com', 'active', 'abc', 123);
    }
}
