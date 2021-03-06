<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Domain;

use DateTime;

final class Site implements DomainObjectInterface
{
    public int $ref;

    /** @var Domain[] */
    public array $domains;

    public ?string $contentMapSite;

    public ?int $template;

    public Domain $primaryDomain;

    public ?DateTime $lastPublish;

    public int $brandRef;

    public int $version;

    public bool $enabled;

    public ?bool $privateWidgets;

    public ?int $mobileSiteRef;

    public bool $mobile;

    public ?int $profileRef;

    /**
     * Site constructor.
     *
     * @param int         $ref
     * @param Domain[]    $domains
     * @param string|null $contentMapSite
     * @param int|null    $template
     * @param Domain      $primaryDomain
     * @param ?DateTime   $lastPublish
     * @param int         $brandRef
     * @param int         $version
     * @param bool        $enabled
     * @param bool|null   $privateWidgets
     * @param int|null    $mobileSiteRef
     * @param bool        $mobile
     * @param int|null    $profileRef
     */
    public function __construct(int $ref, array $domains, ?string $contentMapSite, ?int $template, Domain $primaryDomain, ?DateTime $lastPublish, int $brandRef, int $version, bool $enabled, ?bool $privateWidgets, ?int $mobileSiteRef, bool $mobile, ?int $profileRef)
    {
        $this->ref = $ref;
        $this->domains = $domains;
        $this->contentMapSite = $contentMapSite;
        $this->template = $template;
        $this->primaryDomain = $primaryDomain;
        $this->lastPublish = $lastPublish;
        $this->brandRef = $brandRef;
        $this->version = $version;
        $this->enabled = $enabled;
        $this->privateWidgets = $privateWidgets;
        $this->mobileSiteRef = $mobileSiteRef;
        $this->mobile = $mobile;
        $this->profileRef = $profileRef;
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
        return new Site(
            $json['ref'],
            array_map(fn (array $domain): Domain => Domain::fromArray($domain), $json['domains']),
            $json['contentMapSite'] ?? null,
            $json['template'] ?? null,
            Domain::fromArray($json['primaryDomain']),
            $json['lastPublish'],
            $json['brandRef'],
            $json['version'],
            $json['enabled'],
            $json['privateWidgets'] ?? null,
            $json['mobileSiteRef'] ?? null,
            $json['mobile'],
            $json['profileRef'] ?? null,
        );
    }
}
