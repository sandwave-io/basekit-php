<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Api\Interfaces;

use SandwaveIo\BaseKit\Domain\AccountHolder;

interface UserApiInterface
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
    ): AccountHolder;

    /**
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
    ): void;

    /**
     * @param int $userRef
     */
    public function delete(int $userRef): void;

    /**
     * @param int $userRef
     */
    public function anonymiseUser(int $userRef): void;
}
