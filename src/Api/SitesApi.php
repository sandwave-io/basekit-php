<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Api;

final class SitesApi extends AbstractApi
{
    /**
     * @param int         $accountHolderRef
     * @param int         $brandRef
     * @param string      $domain
     * @param string|null $activationStatus
     * @param string|null $siteType
     * @param int|null    $templateRef
     */
    public function create(
        int $accountHolderRef,
        int $brandRef,
        string $domain,
        ?string $activationStatus = null,
        ?string $siteType = null,
        ?int $templateRef = null
    ): void {
        $payload = [
            'accountHolderRef'  => $accountHolderRef,
            'brandRef'          => $brandRef,
            'domain'            => $domain,
        ];

        if ($templateRef) {
            $payload['templateRef'] = $templateRef;
        }

        if ($activationStatus) {
            $payload['activationStatus']  = $activationStatus;
        }

        if ($siteType) {
            $payload['siteType'] = $siteType;
        }

        $this->client->post('/sites', $payload);
    }
}
