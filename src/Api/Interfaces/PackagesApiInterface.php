<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Api\Interfaces;

interface PackagesApiInterface
{
    public function addUserPackage(
        int $userRef,
        int $packageRef,
        int $billingFrequency
    ): void;
}
