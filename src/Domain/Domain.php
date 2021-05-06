<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Domain;

final class Domain implements DomainObjectInterface
{
    public int $ref;
    public string $domainName;

    /**
     * Domain constructor.
     *
     * @param int    $ref
     * @param string $domainName
     */
    public function __construct(int $ref, string $domainName)
    {
        $this->ref = $ref;
        $this->domainName = $domainName;
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
            $json['ref'],
            $json['domainName']
        );
    }
}
