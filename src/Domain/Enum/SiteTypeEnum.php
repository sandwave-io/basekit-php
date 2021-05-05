<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Domain\Enum;

final class SiteTypeEnum extends AbstractEnum
{
    const TYPE_DESKTOP = 'desktop';
    const TYPE_RESPONSIVE = 'responsive';

    /**
     * @var array|string[]
     */
    protected static array $values = [
      SiteTypeEnum::TYPE_DESKTOP,
      SiteTypeEnum::TYPE_RESPONSIVE,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        SiteTypeEnum::assertValueValid($value);
    }
}
