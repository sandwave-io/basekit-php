<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Api;

use SandwaveIo\BaseKit\Api\Interfaces\LoginApiInterface;

final class LoginApi extends AbstractApi implements LoginApiInterface
{
    /**
     * This method will return a secret hash string that can be used to provide a login URL to the user.
     *
     * @param int $userRef
     *
     * @return string
     */
    public function autoLogin(int $userRef): string
    {
        $response = $this->client->post("/users/{$userRef}/auto-login");
        return $response->text();
    }
}
