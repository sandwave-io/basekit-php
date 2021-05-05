<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Domain;

interface DomainObjectInterface
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;

    /**
     * @param array<string, mixed> $json
     *
     * @return static
     */
    public static function fromArray(array $json);
}
