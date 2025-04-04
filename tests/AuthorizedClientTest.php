<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use SandwaveIo\BaseKit\Exceptions\BadRequestException;
use SandwaveIo\BaseKit\Exceptions\BaseKitClientException;
use SandwaveIo\BaseKit\Exceptions\BaseKitRequestException;
use SandwaveIo\BaseKit\Exceptions\ForbiddenException;
use SandwaveIo\BaseKit\Exceptions\UnauthorizedException;
use SandwaveIo\BaseKit\Support\AuthorizedClient;
use SandwaveIo\BaseKit\Tests\Helpers\MockedClientFactory;

final class AuthorizedClientTest extends TestCase
{
    public function testConstruct(): void
    {
        $client = new AuthorizedClient('https://example.com', 'test', 'bigsecretdontellanyone');
        Assert::assertInstanceOf(AuthorizedClient::class, $client);
    }

    /**
     * @psalm-param class-string<\Throwable>|null $exception
     *
     * @dataProvider requestVariants
     */
    public function testHttpMethods(string $method, string $endpoint, int $responseCode, ?string $exception): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('debug');

        $client = MockedClientFactory::makeAuthorizedClient(
            $responseCode,
            '',
            MockedClientFactory::assertRoute($method, $endpoint),
            $logger
        );

        if ($exception !== null) {
            $this->expectException($exception);
        }

        if ($method === 'post') {
            //@phpstan-ignore-next-line
            $client->{$method}('test', ['foo' => 'bar']);
        } else {
            //@phpstan-ignore-next-line
            $client->{$method}('test');
        }
    }

    /**
     * @covers \SandwaveIo\BaseKit\Support\AuthorizedClient::request
     *
     * @throws \SandwaveIo\BaseKit\Exceptions\BaseKitRequestException
     */
    public function testTimeoutException(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('debug');

        $mock = new MockHandler([
            new ConnectException(
                'cURL error 28: Operation timed out',
                new Request('GET', '/test')
            ),
        ]);
        $handler = HandlerStack::create($mock);
        $guzzleClient = new Client(['handler' => $handler]);

        $client = new AuthorizedClient('https://example.com', 'test', 'bigsecretdontellanyone');
        $client->setClient($guzzleClient);

        $this->expectException(BaseKitRequestException::class);
        $client->get('/test');
    }

    /**
     * @covers \SandwaveIo\BaseKit\Support\AuthorizedClient::request
     *
     * @throws \SandwaveIo\BaseKit\Exceptions\BaseKitRequestException
     */
    public function testNotResolvableHostException(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('debug');

        $mock = new MockHandler([
            new ConnectException(
                'cURL error 6: Could not resolve host',
                new Request('GET', '/test')
            ),
        ]);
        $handler = HandlerStack::create($mock);
        $guzzleClient = new Client(['handler' => $handler]);

        $client = new AuthorizedClient('https://example.com', 'test', 'bigsecretdontellanyone');
        $client->setClient($guzzleClient);

        $this->expectException(BaseKitRequestException::class);
        $client->get('/test');
    }

    /**
     * @return array<array<mixed>>
     */
    public static function requestVariants(): array
    {
        return [
            'GET request: success'  => ['get', '/test', 200, null],
            'GET request: bad request'  => ['get', '/test', 400, BadRequestException::class],
            'GET request: unauthorized'  => ['get', '/test', 401, UnauthorizedException::class],
            'GET request: forbidden'  => ['get', '/test', 403, ForbiddenException::class],
            'GET request: not found'  => ['get', '/test', 404, BadRequestException::class],
            'GET request: error'  => ['get', '/test', 500, BaseKitClientException::class],
            'GET request: bad gateway'  => ['get', '/test', 502, BaseKitClientException::class],
            'GET request: service unavailable'  => ['get', '/test', 503, BaseKitClientException::class],

            'POST request: success'  => ['post', '/test', 200, null],
            'POST request: bad request'  => ['post', '/test', 400, BadRequestException::class],
            'POST request: unauthorized'  => ['post', '/test', 401, UnauthorizedException::class],
            'POST request: forbidden'  => ['post', '/test', 403, ForbiddenException::class],
            'POST request: not found'  => ['post', '/test', 404, BadRequestException::class],
            'POST request: error'  => ['post', '/test', 500, BaseKitClientException::class],
            'POST request: bad gateway'  => ['post', '/test', 502, BaseKitClientException::class],
            'POST request: service unavailable'  => ['post', '/test', 503, BaseKitClientException::class],

            'PUT request: success'  => ['put', '/test', 200, null],
            'PUT request: bad request'  => ['put', '/test', 400, BadRequestException::class],
            'PUT request: unauthorized'  => ['put', '/test', 401, UnauthorizedException::class],
            'PUT request: forbidden'  => ['put', '/test', 403, ForbiddenException::class],
            'PUT request: not found'  => ['put', '/test', 404, BadRequestException::class],
            'PUT request: error'  => ['put', '/test', 500, BaseKitClientException::class],
            'PUT request: bad gateway'  => ['put', '/test', 502, BaseKitClientException::class],
            'PUT request: service unavailable'  => ['put', '/test', 503, BaseKitClientException::class],

            'DELETE request: success'  => ['delete', '/test',  200, null],
            'DELETE request: bad request'  => ['delete', '/test',  400, BadRequestException::class],
            'DELETE request: unauthorized'  => ['delete', '/test',  401, UnauthorizedException::class],
            'DELETE request: forbidden'  => ['delete', '/test',  403, ForbiddenException::class],
            'DELETE request: not found'  => ['delete', '/test',  404, BadRequestException::class],
            'DELETE request: error'  => ['delete', '/test',  500, BaseKitClientException::class],
            'DELETE request: bad gateway'  => ['delete', '/test',  502, BaseKitClientException::class],
            'DELETE request: service unavailable'  => ['delete', '/test',  503, BaseKitClientException::class],

        ];
    }
}
