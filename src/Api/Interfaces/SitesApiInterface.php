<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Api\Interfaces;

interface SitesApiInterface
{
    public function create(
        int $accountHolderRef,
        int $brandRef,
        string $domain,
        ?string $activationStatus = null,
        ?string $siteType = null,
        ?int $templateRef = null
    ): void;
}
