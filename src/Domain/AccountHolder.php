<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Domain;

final class AccountHolder implements DomainObjectInterface
{
    public int $ref;

    public string $firstName;

    public string $lastName;

    public string $username;

    public string $email;

    public int $suspended;

    public bool $beta;

    public string $languageCode;

    public ?string $phoneNumber;

    public ?string $address1;

    public ?string $address2;

    public ?string $city;

    public ?string $postcode;

    public ?string $country;

    public int $newsletter;

    public int $currencyRef;

    public ?string $state;

    public Capabilities $capabilities;

    public ?int  $accountPaymentMethodRef;

    public ?string $cpfNumber;

    public int $cpfCompany;

    public bool $deleted;

    public int $storageBytesUsed;

    /** @var array<mixed>|null */
    public ?array $created;

    public ?string $lastLogin;

    public string $accountStatus;

    /**
     * AccountHolder constructor.
     *
     * @param int               $ref
     * @param string            $firstName
     * @param string            $lastName
     * @param string            $username
     * @param string            $email
     * @param int               $suspended
     * @param bool              $beta
     * @param string            $languageCode
     * @param string|null       $phoneNumber
     * @param string|null       $address1
     * @param string|null       $address2
     * @param string|null       $city
     * @param string|null       $postcode
     * @param string|null       $country
     * @param int               $newsletter
     * @param int               $currencyRef
     * @param string|null       $state
     * @param Capabilities      $capabilities
     * @param int|null          $accountPaymentMethodRef
     * @param string|null       $cpfNumber
     * @param int               $cpfCompany
     * @param bool              $deleted
     * @param int               $storageBytesUsed
     * @param array<mixed>|null $created
     * @param string|null       $lastLogin
     * @param string            $accountStatus
     */
    public function __construct(
        int $ref,
        string $firstName,
        string $lastName,
        string $username,
        string $email,
        int $suspended,
        bool $beta,
        string $languageCode,
        ?string $phoneNumber,
        ?string $address1,
        ?string $address2,
        ?string $city,
        ?string $postcode,
        ?string $country,
        int $newsletter,
        int $currencyRef,
        ?string $state,
        Capabilities $capabilities,
        ?int $accountPaymentMethodRef,
        ?string $cpfNumber,
        int $cpfCompany,
        bool $deleted,
        int $storageBytesUsed,
        ?array $created,
        ?string $lastLogin,
        string $accountStatus
    ) {
        $this->ref = $ref;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->email = $email;
        $this->suspended = $suspended;
        $this->beta = $beta;
        $this->languageCode = $languageCode;
        $this->phoneNumber = $phoneNumber;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->city = $city;
        $this->postcode = $postcode;
        $this->country = $country;
        $this->newsletter = $newsletter;
        $this->currencyRef = $currencyRef;
        $this->state = $state;
        $this->capabilities = $capabilities;
        $this->accountPaymentMethodRef = $accountPaymentMethodRef;
        $this->cpfNumber = $cpfNumber;
        $this->cpfCompany = $cpfCompany;
        $this->deleted = $deleted;
        $this->storageBytesUsed = $storageBytesUsed;
        $this->created = $created;
        $this->lastLogin = $lastLogin;
        $this->accountStatus = $accountStatus;
    }

    /**
     * @param array<string, mixed> $json
     *
     * @return AccountHolder
     */
    public static function fromArray(array $json): AccountHolder
    {
        return new AccountHolder(
            $json['ref'],
            $json['firstName'],
            $json['lastName'],
            $json['username'],
            $json['email'],
            $json['suspended'],
            $json['beta'],
            $json['languageCode'],
            $json['phoneNumber'] ?? null,
            $json['address1'] ??  null,
            $json['address2'] ?? null,
            $json['city']?? null,
            $json['postcode']?? null,
            $json['country']?? null,
            $json['newsletter'],
            $json['currencyRef'],
            $json['state']?? null,
            Capabilities::fromArray($json['capabilities']),
            $json['accountPaymentMethodRef']?? null,
            $json['cpfNumber']?? null,
            $json['cpfCompany'],
            $json['deleted'],
            (int) $json['storageBytesUsed'],
            $json['created']?? null,
            $json['lastLogin']?? null,
            $json['accountStatus'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'ref' => $this->ref,
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
        ];
    }
}
