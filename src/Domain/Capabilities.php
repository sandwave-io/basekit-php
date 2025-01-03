<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Domain;

final class Capabilities implements DomainObjectInterface
{
    public function __construct(
        public ?string $liveSites = null,
        public ?string $allowUsers = null,
        public ?string $cdnEnabled = null,
        public ?string $cssEditing = null,
        public ?string $themeLevel = null,
        public ?string $freeDomains = null,
        public ?string $htmlEditing = null,
        public ?string $pagesLimited = null,
        public ?string $storageLimit = null,
        public ?string $templateTier = null,
        public ?string $domainMapping = null,
        public ?string $googleAnalytics = null,
        public ?string $ecommerceAllowed = null,
        public ?string $googleAdWordVoucher = null,
        public ?string $allowExternalRedirects = null,
        public ?string $allowTemplateSave = null,
        public ?string $mailboxes = null,
        public ?string $mobile = null,
        public ?string $siteLock = null,
        public ?string $mobileSites = null,
        public ?string $mobilePublishing = null,
        public ?string $restrictPagesOnPublish = null,
    ) {
    }

    /**
     * @param array<string,mixed> $json
     *
     * @return Capabilities
     */
    public static function fromArray(array $json): Capabilities
    {
        return new Capabilities(
            liveSites: $json['liveSites'],
            allowUsers: $json['allowUsers'],
            cdnEnabled: $json['cdnEnabled'],
            cssEditing: $json['cssEditing'],
            themeLevel: $json['themeLevel'],
            freeDomains: $json['freeDomains'],
            htmlEditing: $json['htmlEditing'],
            pagesLimited: $json['pagesLimited'],
            storageLimit: $json['storageLimit'],
            templateTier: $json['templateTier'],
            domainMapping: $json['domainMapping'],
            googleAnalytics: $json['googleAnalytics'],
            ecommerceAllowed: $json['ecommerceAllowed'],
            googleAdWordVoucher: $json['googleAdWordVoucher'],
            allowExternalRedirects: $json['allowExternalRedirects'],
            allowTemplateSave: $json['allowTemplateSave'],
            mailboxes: $json['mailboxes'],
            mobile: $json['mobile'],
            siteLock: $json['siteLock'] ?? null,
            mobileSites: $json['mobileSites'],
            mobilePublishing: $json['mobilePublishing'],
            restrictPagesOnPublish: $json['restrictPagesOnPublish'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'liveSites' => $this->liveSites,
            'allowUsers' => $this->allowUsers,
            'cdnEnabled' => $this->cdnEnabled,
            'cssEditing' => $this->cssEditing,
            'themeLevel' => $this->themeLevel,
            'freeDomains' => $this->freeDomains,
            'htmlEditing' => $this->htmlEditing,
            'pagesLimited' => $this->pagesLimited,
            'storageLimit' => $this->storageLimit,
            'templateTier' => $this->templateTier,
            'domainMapping' => $this->domainMapping,
            'googleAnalytics' => $this->googleAnalytics,
            'ecommerceAllowed' => $this->ecommerceAllowed,
            'googleAdWordVoucher' => $this->googleAdWordVoucher,
            'allowExternalRedirects' => $this->allowExternalRedirects,
            'allowTemplateSave' => $this->allowTemplateSave,
            'mailboxes' => $this->mailboxes,
            'mobile' => $this->mobile,
            'siteLock' => $this->siteLock,
            'mobileSites' => $this->mobileSites,
            'mobilePublishing' => $this->mobilePublishing,
            'restrictPagesOnPublish' => $this->restrictPagesOnPublish,
        ];
    }
}
