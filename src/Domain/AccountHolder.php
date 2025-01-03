<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Domain;

final class AccountHolder implements DomainObjectInterface
{
    /**
     * @param array<mixed>|null              $created
     * @param array<string, string|int>|null $lastLogin
     */
    public function __construct(
        public int $ref,
        public int $brandRef,
        public string $firstName,
        public string $lastName,
        public string $username,
        public string $email,
        public int $suspended,
        public bool $beta,
        public string $languageCode,
        public ?string $phoneNumber,
        public ?string $address1,
        public ?string $address2,
        public ?string $city,
        public ?string $postcode,
        public ?string $country,
        public int $newsletter,
        public int $currencyRef,
        public ?string $state,
        public Capabilities $capabilities,
        public ?int $accountPaymentMethodRef,
        public ?string $cpfNumber,
        public int $cpfCompany,
        public string $company,
        public bool $deleted,
        public int $storageBytesUsed,
        public ?array $created,
        public ?array $lastLogin,
        public string $accountStatus,
        public ?int $resellerRef,
    ) {
    }

    /**
     * @param array<string, mixed> $json
     *
     * @return AccountHolder
     */
    public static function fromArray(array $json): AccountHolder
    {
        return new AccountHolder(
            ref: $json['ref'],
            brandRef: $json['brandRef'],
            firstName: $json['firstName'],
            lastName: $json['lastName'],
            username: $json['username'],
            email: $json['email'],
            suspended: $json['suspended'],
            beta: $json['beta'],
            languageCode: $json['languageCode'],
            phoneNumber: $json['phoneNumber'] ?? null,
            address1: $json['address1'] ??  null,
            address2: $json['address2'] ?? null,
            city: $json['city']?? null,
            postcode: $json['postcode'] ?? null,
            country: $json['country'] ?? null,
            newsletter: $json['newsletter'],
            currencyRef: $json['currencyRef'],
            state: $json['state'] ?? null,
            capabilities: Capabilities::fromArray($json['capabilities']),
            accountPaymentMethodRef: $json['accountPaymentMethodRef'] ?? null,
            cpfNumber: $json['cpfNumber'] ?? null,
            cpfCompany: $json['cpfCompany'],
            company: $json['company'],
            deleted: $json['deleted'],
            storageBytesUsed: (int) $json['storageBytesUsed'],
            created: $json['created'] ?? null,
            lastLogin: $json['lastLogin'] ?? null,
            accountStatus: $json['accountStatus'],
            resellerRef: $json['resellerRef'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'ref' => $this->ref,
            'brandRef' => $this->brandRef,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'username' => $this->username,
            'email' => $this->email,
            'suspended' => $this->suspended,
            'beta' => $this->beta,
            'languageCode' => $this->languageCode,
            'phoneNumber' => $this->phoneNumber,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'city' => $this->city,
            'postcode' => $this->postcode,
            'country' => $this->country,
            'newsletter' => $this->newsletter,
            'currencyRef' => $this->currencyRef,
            'state' => $this->state,
            'capabilities' => $this->capabilities->toArray(),
            'accountPaymentMethodRef' => $this->accountPaymentMethodRef,
            'cpfNumber' => $this->cpfNumber,
            'cpfCompany' => $this->cpfCompany,
            'deleted' => $this->deleted,
            'storageBytesUsed' => $this->storageBytesUsed,
            'created' => $this->created,
            'lastLogin' => $this->lastLogin,
            'accountStatus' => $this->accountStatus,
            'resellerRef' => $this->resellerRef,
        ];
    }
}
