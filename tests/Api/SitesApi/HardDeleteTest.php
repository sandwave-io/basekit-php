<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Tests\Api\SitesApi;

use PHPUnit\Framework\TestCase;
use SandwaveIo\BaseKit\Tests\Helpers\MockedClientFactory;

final class HardDeleteTest extends TestCase
{
    public function testDelete(): void
    {
        $client = MockedClientFactory::makeSdk(
            204,
            '',
            MockedClientFactory::assertRoute('POST', '/sites/1234/hard-delete')
        );

        $client->sitesApi->hardDelete(1234);
    }
}
