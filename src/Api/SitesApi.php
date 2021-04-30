<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Api;

use SandwaveIo\BaseKit\Domain\Enum\ActivationStatusEnum;
use SandwaveIo\BaseKit\Domain\Enum\SiteTypeEnum;

class SitesApi extends abstractApi
{
    /**
     * @param int                  $accountHolderRef
     * @param int                  $brandRef
     * @param string               $domain
     * @param ActivationStatusEnum $activationStatus
     * @param SiteTypeEnum         $siteType
     * @param int|null             $templateRef
     */
    public function create(
        int $accountHolderRef,
        int $brandRef,
        string $domain,
        ActivationStatusEnum $activationStatus,
        SiteTypeEnum $siteType,
        ?int $templateRef = null
    ): void {
        $payload = [
            'accountHolderRef'  => $accountHolderRef,
            'brandRef'          => $brandRef,
            'domain'            => $domain,
            'activationStatus'  => $activationStatus,
            'siteType'          => $siteType,
        ];

        if ($templateRef) {
            $payload['templateRef'] = $templateRef;
        }

        $this->client->post('/sites', $payload);
    }
}
