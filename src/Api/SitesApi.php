<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Api;

use SandwaveIo\BaseKit\Api\Interfaces\SitesApiInterface;
use SandwaveIo\BaseKit\Domain\Site;
use SandwaveIo\BaseKit\Exceptions\UnexpectedValueException;

final class SitesApi extends AbstractApi implements SitesApiInterface
{
    /**
     * @param int         $accountHolderRef
     * @param int         $brandRef
     * @param string      $domain
     * @param string|null $activationStatus
     * @param string|null $siteType
     * @param int|null    $templateRef
     *
     * @return Site
     */
    public function create(
        int $accountHolderRef,
        int $brandRef,
        string $domain,
        ?string $activationStatus = null,
        ?string $siteType = null,
        ?int $templateRef = null
    ): Site {
        $payload = [
            'accountHolderRef'  => $accountHolderRef,
            'brandRef'          => $brandRef,
            'domain'            => $domain,
        ];

        if ($templateRef !== null) {
            $payload['templateRef'] = $templateRef;
        }

        if ($activationStatus  !== null) {
            $payload['activationStatus']  = $activationStatus;
        }

        if ($siteType  !== null) {
            $payload['siteType'] = $siteType;
        }

        $response = $this->client->post('/sites', $payload)->json();
        if (! array_key_exists('site', $response)) {
            throw new UnexpectedValueException('No site was provided by BaseKit.');
        }
        return Site::fromArray($response['site']);
    }

    public function delete(int $siteRef): void
    {
        $this->client->delete("/sites/{$siteRef}");
    }

    public function hardDelete(int $siteRef): void
    {
        $this->client->post("/sites/{$siteRef}/hard-delete");
    }
}
