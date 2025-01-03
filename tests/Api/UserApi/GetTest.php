<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Tests\Api\UserApi;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use SandwaveIo\BaseKit\Domain\AccountHolder;
use SandwaveIo\BaseKit\Domain\Capabilities;
use SandwaveIo\BaseKit\Exceptions\UnexpectedValueException;
use SandwaveIo\BaseKit\Tests\Helpers\MockedClientFactory;

final class GetTest extends TestCase
{
    /**
     * @param array<string, string>|null $expectedCreated
     * @param array<string, string>|null $expectedLastLogin
     */
    #[DataProvider('userGetProvider')]
    public function testGet(
        string $jsonResponse,
        int $expectedRef,
        int $expectedBrandRef,
        string $expectedFirstName,
        string $expectedLastName,
        string $expectedUsername,
        string $expectedEmail,
        int $expectedSuspended,
        bool $expectedBeta,
        string $expectedLanguageCode,
        ?string $expectedPhoneNumber,
        string $expectedAddress1,
        string $expectedAddress2,
        string $expectedCity,
        string $expectedPostcode,
        string $expectedCountry,
        int $expectedNewsletter,
        int $expectedCurrencyRef,
        string $expectedState,
        Capabilities $expectedCapabilities,
        ?int $expectedAccountPaymentMethodRef,
        ?string $expectedCpfNumber,
        int $expectedCpfCompany,
        string $expectedCompany,
        bool $expectedDeleted,
        int $expectedStorageBytesUsed,
        ?array $expectedCreated,
        ?array $expectedLastLogin,
        string $expectedAccountStatus,
        int $expectedResellerRef,
    ): void {
        $client = MockedClientFactory::makeSdk(
            200,
            $jsonResponse,
            MockedClientFactory::assertRoute('GET', '/users/1')
        );

        $accountHolder = $client->userApi->get(1);

        self::assertInstanceOf(AccountHolder::class, $accountHolder);
        self::assertSame($expectedRef, $accountHolder->ref);
        self::assertSame($expectedBrandRef, $accountHolder->brandRef);
        self::assertSame($expectedFirstName, $accountHolder->firstName);
        self::assertSame($expectedLastName, $accountHolder->lastName);
        self::assertSame($expectedUsername, $accountHolder->username);
        self::assertSame($expectedEmail, $accountHolder->email);
        self::assertSame($expectedSuspended, $accountHolder->suspended);
        self::assertSame($expectedBeta, $accountHolder->beta);
        self::assertSame($expectedLanguageCode, $accountHolder->languageCode);
        self::assertSame($expectedPhoneNumber, $accountHolder->phoneNumber);
        self::assertSame($expectedAddress1, $accountHolder->address1);
        self::assertSame($expectedAddress2, $accountHolder->address2);
        self::assertSame($expectedCity, $accountHolder->city);
        self::assertSame($expectedPostcode, $accountHolder->postcode);
        self::assertSame($expectedCountry, $accountHolder->country);
        self::assertSame($expectedNewsletter, $accountHolder->newsletter);
        self::assertSame($expectedCurrencyRef, $accountHolder->currencyRef);
        self::assertSame($expectedState, $accountHolder->state);
        self::assertSame($expectedCapabilities->allowUsers, $accountHolder->capabilities->allowUsers);
        self::assertSame($expectedCapabilities->cdnEnabled, $accountHolder->capabilities->cdnEnabled);
        self::assertSame($expectedCapabilities->cssEditing, $accountHolder->capabilities->cssEditing);
        self::assertSame($expectedCapabilities->themeLevel, $accountHolder->capabilities->themeLevel);
        self::assertSame($expectedCapabilities->freeDomains, $accountHolder->capabilities->freeDomains);
        self::assertSame($expectedCapabilities->htmlEditing, $accountHolder->capabilities->htmlEditing);
        self::assertSame($expectedCapabilities->pagesLimited, $accountHolder->capabilities->pagesLimited);
        self::assertSame($expectedCapabilities->storageLimit, $accountHolder->capabilities->storageLimit);
        self::assertSame($expectedCapabilities->templateTier, $accountHolder->capabilities->templateTier);
        self::assertSame($expectedCapabilities->domainMapping, $accountHolder->capabilities->domainMapping);
        self::assertSame($expectedCapabilities->googleAnalytics, $accountHolder->capabilities->googleAnalytics);
        self::assertSame($expectedCapabilities->ecommerceAllowed, $accountHolder->capabilities->ecommerceAllowed);
        self::assertSame($expectedCapabilities->googleAdWordVoucher, $accountHolder->capabilities->googleAdWordVoucher);
        self::assertSame($expectedCapabilities->allowExternalRedirects, $accountHolder->capabilities->allowExternalRedirects);
        self::assertSame($expectedCapabilities->allowTemplateSave, $accountHolder->capabilities->allowTemplateSave);
        self::assertSame($expectedCapabilities->mailboxes, $accountHolder->capabilities->mailboxes);
        self::assertSame($expectedCapabilities->mobile, $accountHolder->capabilities->mobile);
        self::assertSame($expectedCapabilities->mobileSites, $accountHolder->capabilities->mobileSites);
        self::assertSame($expectedCapabilities->mobilePublishing, $accountHolder->capabilities->mobilePublishing);
        self::assertSame($expectedCapabilities->restrictPagesOnPublish, $accountHolder->capabilities->restrictPagesOnPublish);
        self::assertSame($expectedAccountPaymentMethodRef, $accountHolder->accountPaymentMethodRef);
        self::assertSame($expectedCpfNumber, $accountHolder->cpfNumber);
        self::assertSame($expectedCpfCompany, $accountHolder->cpfCompany);
        self::assertSame($expectedCompany, $accountHolder->company);
        self::assertSame($expectedDeleted, $accountHolder->deleted);
        self::assertSame($expectedStorageBytesUsed, $accountHolder->storageBytesUsed);
        self::assertSame($expectedCreated, $accountHolder->created);
        self::assertSame($expectedLastLogin, $accountHolder->lastLogin);
        self::assertSame($expectedAccountStatus, $accountHolder->accountStatus);
        self::assertSame($expectedResellerRef, $accountHolder->resellerRef);
    }

    /**
     * @return iterable<mixed>
     */
    public static function userGetProvider(): iterable
    {
        yield 'User get' => [
            'jsonResponse' => (string) file_get_contents(__DIR__ . '/../data/users-get.json'),
            'expectedRef' => 1,
            'expectedBrandRef' => 123,
            'expectedFirstName' => 'Test',
            'expectedLastName' => 'Kees',
            'expectedUsername' => 'testkees',
            'expectedEmail' => 'test.kees@sandwave.io',
            'expectedSuspended' => 0,
            'expectedBeta' => false,
            'expectedLanguageCode' => 'NL',
            'expectedPhoneNumber' => null,
            'expectedAddress1' => '',
            'expectedAddress2' => '',
            'expectedCity' => '',
            'expectedPostcode' => '',
            'expectedCountry' => '',
            'expectedNewsletter' => 0,
            'expectedCurrencyRef' => 1,
            'expectedState' => '',
            'expectedCapabilities' => new Capabilities(
                liveSites: '5',
                allowUsers: '1',
                cdnEnabled: 'N',
                cssEditing: '1',
                themeLevel: '1',
                freeDomains: '0',
                htmlEditing: '0',
                pagesLimited: '100',
                storageLimit: '10485760',
                templateTier: '2',
                domainMapping: '0',
                googleAnalytics: '1',
                ecommerceAllowed: '1',
                googleAdWordVoucher: '0',
                allowExternalRedirects: '0',
                allowTemplateSave: '0',
                mailboxes: '0',
                mobile: '0',
                siteLock: null,
                mobileSites: '0',
                mobilePublishing: '0',
                restrictPagesOnPublish: '0',
            ),
            'expectedAccountPaymentMethodRef' => null,
            'expectedCpfNumber' => null,
            'expectedCpfCompany' => 0,
            'expectedCompany' => '',
            'expectedDeleted' => false,
            'expectedStorageBytesUsed' => 1234,
            'expectedCreated' => null,
            'expectedLastLogin' => null,
            'expectedAccountStatus' => 'allowed',
            'expectedResellerRef' => 789,
        ];

        // See example on: https://basekit.stoplight.io/docs/basekit/z4c6lauro9mqs-get-user
        yield 'User get example from API docs' => [
            'jsonResponse' => (string) file_get_contents(__DIR__ . '/../data/users-get-doc-example.json'),
            'expectedRef' => 28,
            'expectedBrandRef' => 23,
            'expectedFirstName' => 'Test',
            'expectedLastName' => 'User',
            'expectedUsername' => 'test.user',
            'expectedEmail' => 'test.user@example.com',
            'expectedSuspended' => 1,
            'expectedBeta' => true,
            'expectedLanguageCode' => 'en',
            'expectedPhoneNumber' => '0123456789',
            'expectedAddress1' => '123 Example Street',
            'expectedAddress2' => 'Example Town',
            'expectedCity' => 'Example City',
            'expectedPostcode' => 'EX1 2PL',
            'expectedCountry' => 'United Kingdom',
            'expectedNewsletter' => 1,
            'expectedCurrencyRef' => 23,
            'expectedState' => 'Example State',
            'expectedCapabilities' => new Capabilities(
                storageLimit: '10485760',
            ),
            'expectedAccountPaymentMethodRef' => 12,
            'expectedCpfNumber' => '13.339.532/0001-09',
            'expectedCpfCompany' => 1,
            'expectedCompany' => 'Example Company',
            'expectedDeleted' => true,
            'expectedStorageBytesUsed' => 10485760,
            'expectedCreated' => [
                'date' => '2023-08-23 14:57:48.704403',
                'timezone_type' => 3,
                'timezone' => 'Europe/London',
            ],
            'expectedLastLogin' => [
                'date' => '2023-08-23 14:57:48.704403',
                'timezone_type' => 3,
                'timezone' => 'Europe/London',
            ],
            'expectedAccountStatus' => 'allowed',
            'expectedResellerRef' => 12,
        ];
    }

    public function testGetWithInvalidResponse(): void
    {
        $client = MockedClientFactory::makeSdk(
            200,
            '[]',
            MockedClientFactory::assertRoute('GET', '/users/1')
        );
        $this->expectException(UnexpectedValueException::class);
        $client->userApi->get(1);
    }
}
