<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Domain;

final class Site implements DomainObjectInterface
{
    /**
     * @param Domain[]                   $domains
     * @param ?array<string, string|int> $lastPublish
     */
    public function __construct(
        public int $ref,
        public array $domains,
        public ?int $contentMapSite,
        public ?int $template,
        public Domain $primaryDomain,
        public ?array $lastPublish,
        public int $brandRef,
        public int $version,
        public bool $enabled,
        public ?bool $privateWidgets,
        public ?int $mobileSiteRef,
        public bool $mobile,
        public ?int $profileRef,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'ref' => $this->ref,
            'domains' => array_map(fn (Domain $domain): array => $domain->toArray(), $this->domains),
            'contentMapSite' => $this->contentMapSite,
            'template' => $this->template,
            'primaryDomain' => $this->primaryDomain,
            'lastPublish' => $this->lastPublish,
            'brandRef' => $this->brandRef,
            'version' => $this->version,
            'enabled' => $this->enabled,
            'privateWidgets' => $this->privateWidgets,
            'mobileSiteRef' => $this->mobileSiteRef,
            'mobile' => $this->mobile,
            'profileRef' => $this->profileRef,
        ];
    }

    /**
     * @inheritDoc
     */
    public static function fromArray(array $json)
    {
        $domains = [];

        foreach ($json['domains'] as $id => $domain) {
            $domains[] = is_string($domain) ?
                new Domain($id, $domain) :
                Domain::fromArray($domain);
        }

        return new Site(
            ref: $json['ref'],
            domains: $domains,
            contentMapSite: $json['contentMapSite'] ?? null,
            template: $json['template'] ?? null,
            primaryDomain: Domain::fromArray($json['primaryDomain']),
            lastPublish: $json['lastPublish'],
            brandRef: $json['brandRef'],
            version: $json['version'],
            enabled: $json['enabled'],
            privateWidgets: is_numeric($json['privateWidgets']) ? (bool) $json['privateWidgets'] : null,
            mobileSiteRef: $json['mobileSiteRef'] ?? null,
            mobile: $json['mobile'],
            profileRef: $json['profileRef'] ?? null,
        );
    }
}
