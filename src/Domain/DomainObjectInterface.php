<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Domain;

interface DomainObjectInterface
{
    /**
     * @return array<mixed>
     */
    public function toArray(): array;

    /**
     * @param array<mixed> $json
     *
     * @return static
     */
    public static function fromArray(array $json);
}
