<?php

declare(strict_types = 1);

namespace Api\SitesApi;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use SandwaveIo\BaseKit\Domain\Site;
use SandwaveIo\BaseKit\Exceptions\UnexpectedValueException;
use SandwaveIo\BaseKit\Tests\Helpers\MockedClientFactory;

final class GetTest extends TestCase
{
    public function testGet(): void
    {
        $client = MockedClientFactory::makeSdk(
            200,
            (string) file_get_contents(__DIR__ . '/../data/sites-get.json'),
            MockedClientFactory::assertRoute('GET', '/sites/1')
        );

        $site = $client->sitesApi->get(1);
        Assert::assertInstanceOf(Site::class, $site);
        Assert::assertSame('example.com', $site->primaryDomain->domainName);
        Assert::assertIsArray($site->toArray());
    }

    public function testGetInvalidJson(): void
    {
        $client = MockedClientFactory::makeSdk(
            200,
            '[]',
            MockedClientFactory::assertRoute('GET', '/sites/1')
        );

        $this->expectException(UnexpectedValueException::class);
        $client->sitesApi->get(1);
    }
}
