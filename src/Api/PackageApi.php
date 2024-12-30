<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Api;

use SandwaveIo\BaseKit\Api\Interfaces\PackagesApiInterface;

final class PackageApi extends AbstractApi implements PackagesApiInterface
{
    /**
     * @param int $userRef
     * @param int $packageRef
     * @param int $billingFrequency value is in months.
     */
    public function addUserPackage(
        int $userRef,
        int $packageRef,
        int $billingFrequency
    ): void {
        $payload = [
            'packageRef'        => $packageRef,
            'billingFrequency'  => $billingFrequency,
        ];

        $this->client->post("users/{$userRef}/account-packages", $payload);
    }
}
