<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Api\Interfaces;

use SandwaveIo\BaseKit\Domain\Site;

interface SitesApiInterface
{
    public function create(
        int $accountHolderRef,
        int $brandRef,
        string $domain,
        ?string $activationStatus = null,
        ?string $siteType = null,
        ?int $templateRef = null
    ): Site;

    public function get(int $siteRef): Site;

    public function delete(int $siteRef): void;

    public function hardDelete(int $siteRef): void;
}
