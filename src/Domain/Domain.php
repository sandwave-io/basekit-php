<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Domain;

final class Domain implements DomainObjectInterface
{
    public function __construct(
        public int $ref,
        public string $domainName,
    ) {
    }

    /**
     * @return array<string, int|string>
     */
    public function toArray(): array
    {
        return [
            'ref' => $this->ref,
            'domainName' => $this->domainName,
        ];
    }

    /**
     * @param array<string, mixed> $json
     *
     * @return Domain
     */
    public static function fromArray(array $json): Domain
    {
        return new Domain(
            ref: $json['ref'],
            domainName: $json['domainName']
        );
    }
}
