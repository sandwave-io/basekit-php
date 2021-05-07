<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Api;

use SandwaveIo\BaseKit\Api\Interfaces\UserApiInterface;
use SandwaveIo\BaseKit\Domain\AccountHolder;
use SandwaveIo\BaseKit\Exceptions\UnexpectedValueException;

final class UserApi extends AbstractApi implements UserApiInterface
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
     *
     * @return AccountHolder
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
    ): AccountHolder {
        $payload = [
            'brandRef'      => $brandRef,
            'firstName'     => $firstName,
            'lastName'      => $lastName,
            'username'      => $userName,
            'password'      => $passWord,
            'email'         => $email,
            'languageCode'  => $languageCode,
        ];

        if ($resellerRef  !== null) {
            $payload['resellerRef'] = $resellerRef;
        }

        if ($metaData  !== null) {
            $payload['metadata'] = $metaData;
        }

        $response = $this->client->post('/users', $payload)->json();
        if (! array_key_exists('accountHolder', $response)) {
            throw new UnexpectedValueException('No account holder was provided by BaseKit.');
        }
        return AccountHolder::fromArray($response['accountHolder']);
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

        if ($firstName  !== null) {
            $payload['firstName'] = $firstName;
        }
        if ($lastName  !== null) {
            $payload['lastName'] = $lastName;
        }
        if ($username  !== null) {
            $payload['username'] = $username;
        }
        if ($password  !== null) {
            $payload['password'] = $password;
        }
        if ($email  !== null) {
            $payload['email'] = $email;
        }
        if ($languageCode  !== null) {
            $payload['languageCode'] = $languageCode;
        }

        $this->client->put("/users/{$userRef}", $payload);
    }

    /**
     * The user is not deleted from the database,
     * but it is marked for deletion and will not be included in further API calls unless deleted users are explicitly requested.
     *
     * @param int $userRef
     */
    public function delete(int $userRef): void
    {
        $this->client->delete("/users/{$userRef}");
    }

    /**
     * Anonymises the specified user, setting all personal details to “anonymised”.
     *
     * @param int $userRef
     */
    public function anonymiseUser(int $userRef): void
    {
        $this->client->post("/users/{$userRef}/anonymise");
    }
}
