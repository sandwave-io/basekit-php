<?php declare(strict_types = 1);

namespace SandaveIo\BaseKit\Domain;

interface DomainObjectInterface
{
    /**
     * @return array<mixed>
     */
    public function toArray(): array;

    /* @phpstan-ignore-next-line */
    public static function fromArray(array $json);
}
