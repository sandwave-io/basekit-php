<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Api;

use SandwaveIo\BaseKit\Api\Interfaces\LoginApiInterface;
use SandwaveIo\BaseKit\Exceptions\UnexpectedValueException;

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
        $response = $this->client->post("users/{$userRef}/auto-login")->json();
        if (! array_key_exists('hash', $response)) {
            throw new UnexpectedValueException('No auto-login hash was provided by BaseKit.');
        }
        return $response['hash'];
    }
}
