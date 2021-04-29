<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Api;

class UserApi extends abstractApi
{
    /**
     * @param int                        $brandRef
     * @param string                     $firstName
     * @param string                     $lastName
     * @param string                     $userName
     * @param string                     $passWord
     * @param string                     $email
     * @param string                     $languageCode
     * @param int|null                   $resellerRef
     * @param array<string, string>|null $metaData
     */
    public function create(
        int $brandRef,
        string $firstName,
        string $lastName,
        string $userName,
        string $passWord,
        string $email,
        string $languageCode,
        ?int $resellerRef = null,
        ?array $metaData = null
    ): void {
        $payload = [
            'brandRef'      => $brandRef,
            'firstName'     => $firstName,
            'lastName'      => $lastName,
            'username'      => $userName,
            'password'      => $passWord,
            'email'         => $email,
            'languageCode'  => $languageCode,
        ];

        if ($resellerRef) {
            $payload['resellerRef'] = $resellerRef;
        }

        if ($metaData) {
            $payload['metadata'] = $metaData;
        }

        $this->client->post('/users', $payload);
    }

    /**
     * This will only update the properties that have been included in the request.
     * All properties that are missing from the request will remain the same.
     *
     * @param int         $userRef
     * @param string|null $firstName
     * @param string|null $lastName
     * @param string|null $username
     * @param string|null $password
     * @param string|null $email
     * @param string|null $languageCode
     */
    public function update(
        int $userRef,
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $username = null,
        ?string $password = null,
        ?string $email = null,
        ?string $languageCode = null
    ): void {
        $payload = [];

        if ($firstName) {
            $payload['firstName'] = $firstName;
        }
        if ($lastName) {
            $payload['lastName'] = $lastName;
        }
        if ($username) {
            $payload['username'] = $username;
        }
        if ($password) {
            $payload['password'] = $password;
        }
        if ($email) {
            $payload['email'] = $email;
        }
        if ($languageCode) {
            $payload['languageCode'] = $languageCode;
        }

        $this->client->put("/users/{$userRef}", $payload);
    }

    // delete user
    // anaonymise user
}
