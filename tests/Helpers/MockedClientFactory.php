<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Tests\Helpers;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Assert;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerInterface;
use SandwaveIo\BaseKit\BaseKit;
use SandwaveIo\BaseKit\Support\AuthorizedClient;

final class MockedClientFactory
{
    const USERNAME = 'test';

    const PASSWORD = 'bigseretdonttellanyone';

    const BASE_URL = 'https://example.com';

    public static function assertRoute(string $method, string $route): callable
    {
        return function (RequestInterface $request) use ($method, $route): void {
            Assert::assertSame(strtoupper($method), strtoupper($request->getMethod()));
            Assert::assertSame($route, $request->getUri()->getPath());
        };
    }

    public static function makeSdk(int $responseCode, string $responseBody, ?callable $assertClosure = null): BaseKit
    {
        $sdk = new BaseKit(self::USERNAME, self::PASSWORD, self::BASE_URL);
        $sdk->setClient(static::makeAuthorizedClient($responseCode, $responseBody, $assertClosure));
        return $sdk;
    }

    public static function makeAuthorizedClient(int $responseCode, string $responseBody, ?callable $assertClosure = null, ?LoggerInterface $logger = null): AuthorizedClient
    {
        $handlerStack = HandlerStack::create(new MockHandler([
            new Response($responseCode, [], $responseBody),
        ]));

        $fakeClient = new AuthorizedClient(
            self::BASE_URL,
            self::USERNAME,
            self::PASSWORD,
            ['handler' => $handlerStack],
            $logger
        );

        if ($assertClosure !== null) {
            $handlerStack->push(function (callable $handler) use ($assertClosure): callable {
                return function (RequestInterface $request, $options) use ($handler, $assertClosure) {
                    $assertClosure($request);
                    return $handler($request, $options);
                };
            });
        }

        return $fakeClient;
    }
}
