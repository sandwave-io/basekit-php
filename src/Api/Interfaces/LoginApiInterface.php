<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Api\Interfaces;

interface LoginApiInterface
{
    public function autoLogin(int $userRef): string;
}
