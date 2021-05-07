<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Tests;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use SandwaveIo\BaseKit\Exceptions\UnexpectedValueException;
use SandwaveIo\BaseKit\Support\BaseKitResponse;

final class BaseKitResponseTest extends TestCase
{
    public function testTextResponse(): void
    {
        $response = new BaseKitResponse('this is text');
        Assert::assertSame('this is text', $response->text());
        Assert::assertSame('this is text', (string) $response);

        $this->expectException(UnexpectedValueException::class);
        $response->json();
    }

    public function testJsonResponse(): void
    {
        $response = new BaseKitResponse('{"foo": "bar"}');
        Assert::assertSame('{"foo": "bar"}', $response->text());
        Assert::assertSame('{"foo": "bar"}', (string) $response);
        Assert::assertSame(['foo' => 'bar'], $response->json());
    }
}
