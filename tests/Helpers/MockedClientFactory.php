<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Tests\Helpers;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerInterface;
use SandwaveIo\BaseKit\BaseKit;
use SandwaveIo\BaseKit\Support\AuthorizedClient;

class MockedClientFactory
{
    const USERNAME = 'test';
    const PASSWORD = 'bigseretdonttellanyone';
    const BASE_URL = 'https://example.com';

    public static function assertRoute(string $method, string $route, TestCase $testCase): callable
    {
        return function (RequestInterface $request) use ($method, $route, $testCase) {
            $testCase->assertSame(strtoupper($method), strtoupper($request->getMethod()));
            $testCase->assertSame($route, $request->getUri()->getPath());
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

        if ($assertClosure) {
            $handlerStack->push(function (callable $handler) use ($assertClosure) {
                return function (RequestInterface $request, $options) use ($handler, $assertClosure) {
                    $assertClosure($request);
                    return $handler($request, $options);
                };
            });
        }

        return $fakeClient;
    }
}
