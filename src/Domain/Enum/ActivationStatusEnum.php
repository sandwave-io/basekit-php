<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Domain\Enum;

class ActivationStatusEnum extends AbstractEnum
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    /**
     * @var array|string[]
     */
    protected static array $values = [
        ActivationStatusEnum::STATUS_ACTIVE,
        ActivationStatusEnum::STATUS_INACTIVE,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        ActivationStatusEnum::assertValueValid($value);
    }
}
