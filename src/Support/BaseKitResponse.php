<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Support;

use SandwaveIo\BaseKit\Exceptions\UnexpectedValueException;

final class BaseKitResponse
{
    /** @var string */
    private $response;

    public function __construct(string $response)
    {
        $this->response = $response;
    }

    public function __toString(): string
    {
        return $this->text();
    }

    public static function fromString(string $response): BaseKitResponse
    {
        return new BaseKitResponse($response);
    }

    /**
     * @return array<string, mixed>
     */
    public function json(): array
    {
        $json = json_decode($this->response, true);

        if (json_last_error() > 0|| $json === false) {
            throw new UnexpectedValueException("Could not parse JSON response body: \n" . $this->response);
        }

        return $json;
    }

    public function text(): string
    {
        return $this->response;
    }
}
