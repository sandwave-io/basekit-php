<?php declare(strict_types = 1);

namespace SandaveIo\BaseKit\Domain;

class Capabilities implements DomainObjectInterface
{
    public string $liveSites;
    public string $allowUsers;
    public string $cdnEnabled;
    public string $cssEditing;
    public string $themeLevel;
    public string $freeDomains;
    public string $htmlEditing;
    public string $pagesLimited;
    public string $storageLimit;
    public string $templateTier;
    public string $domainMapping;
    public string $googleAnalytics;
    public string $ecommerceAllowed;
    public string $googleAdWordVoucher;
    public string $allowExternalRedirects;
    public string $allowTemplateSave;
    public string $mailboxes;
    public string $mobile;
    public string $siteLock;
    public string $mobileSites;
    public int $mobilePublishing;
    public string $restrictPagesOnPublish;

    /**
     * Capabilities constructor.
     *
     * @param string $liveSites
     * @param string $allowUsers
     * @param string $cdnEnabled
     * @param string $cssEditing
     * @param string $themeLevel
     * @param string $freeDomains
     * @param string $htmlEditing
     * @param string $pagesLimited
     * @param string $storageLimit
     * @param string $templateTier
     * @param string $domainMapping
     * @param string $googleAnalytics
     * @param string $ecommerceAllowed
     * @param string $googleAdWordVoucher
     * @param string $allowExternalRedirects
     * @param string $allowTemplateSave
     * @param string $mailboxes
     * @param string $mobile
     * @param string $siteLock
     * @param string $mobileSites
     * @param int    $mobilePublishing
     * @param string $restrictPagesOnPublish
     */
    public function __construct(
        string $liveSites,
        string $allowUsers,
        string $cdnEnabled,
        string $cssEditing,
        string $themeLevel,
        string $freeDomains,
        string $htmlEditing,
        string $pagesLimited,
        string $storageLimit,
        string $templateTier,
        string $domainMapping,
        string $googleAnalytics,
        string $ecommerceAllowed,
        string $googleAdWordVoucher,
        string $allowExternalRedirects,
        string $allowTemplateSave,
        string $mailboxes,
        string $mobile,
        string $siteLock,
        string $mobileSites,
        int $mobilePublishing,
        string $restrictPagesOnPublish
    ) {
        $this->liveSites = $liveSites;
        $this->allowUsers = $allowUsers;
        $this->cdnEnabled = $cdnEnabled;
        $this->cssEditing = $cssEditing;
        $this->themeLevel = $themeLevel;
        $this->freeDomains = $freeDomains;
        $this->htmlEditing = $htmlEditing;
        $this->pagesLimited = $pagesLimited;
        $this->storageLimit = $storageLimit;
        $this->templateTier = $templateTier;
        $this->domainMapping = $domainMapping;
        $this->googleAnalytics = $googleAnalytics;
        $this->ecommerceAllowed = $ecommerceAllowed;
        $this->googleAdWordVoucher = $googleAdWordVoucher;
        $this->allowExternalRedirects = $allowExternalRedirects;
        $this->allowTemplateSave = $allowTemplateSave;
        $this->mailboxes = $mailboxes;
        $this->mobile = $mobile;
        $this->siteLock = $siteLock;
        $this->mobileSites = $mobileSites;
        $this->mobilePublishing = $mobilePublishing;
        $this->restrictPagesOnPublish = $restrictPagesOnPublish;
    }

    /**
     * @param array<mixed> $json
     *
     * @return Capabilities
     */
    public static function fromArray(array $json): Capabilities
    {
        return new Capabilities(
            $json['liveSites'],
            $json['allowUsers'],
            $json['cdnEnabled'],
            $json['cssEditing'],
            $json['themeLevel'],
            $json['freeDomains'],
            $json['htmlEditing'],
            $json['pagesLimited'],
            $json['storageLimit'],
            $json['templateTier'],
            $json['domainMapping'],
            $json['googleAnalytics'],
            $json['ecommerceAllowed'],
            $json['googleAdWordVoucher'],
            $json['allowExternalRedirects'],
            $json['allowTemplateSave'],
            $json['mailboxes'],
            $json['mobile'],
            $json['siteLock'],
            $json['mobileSites'],
            $json['mobilePublishing'],
            $json['restrictPagesOnPublish'],
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
