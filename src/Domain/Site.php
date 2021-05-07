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
    public DateTime $lastPublished;
    public int $brandRef;
    public string $version;
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
     * @param DateTime    $lastPublished
     * @param int         $brandRef
     * @param string      $version
     * @param bool        $enabled
     * @param bool|null   $privateWidgets
     * @param int|null    $mobileSiteRef
     * @param bool        $mobile
     * @param int|null    $profileRef
     */
    public function __construct(int $ref, array $domains, ?string $contentMapSite, ?int $template, Domain $primaryDomain, DateTime $lastPublished, int $brandRef, string $version, bool $enabled, ?bool $privateWidgets, ?int $mobileSiteRef, bool $mobile, ?int $profileRef)
    {
        $this->ref = $ref;
        $this->domains = $domains;
        $this->contentMapSite = $contentMapSite;
        $this->template = $template;
        $this->primaryDomain = $primaryDomain;
        $this->lastPublished = $lastPublished;
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
            'lastPublished' => $this->lastPublished,
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
        $site = $json['site'];
        return new Site(
            $site['ref'],
            array_map(fn (array $domain): Domain => Domain::fromArray($domain), $site['domains']),
            $site['contentMapSite'] ?? null,
            $site['template'] ?? null,
            $site['primaryDomain'],
            $site['lastPublished'],
            $site['brandRef'],
            $site['version'],
            $site['enabled'],
            $site['privateWidgets'] ?? null,
            $site['mobileSiteRef'] ?? null,
            $site['mobile'],
            $site['profileRef'] ?? null,
        );
    }
}
