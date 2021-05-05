<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Domain\Enum;

use SandwaveIo\BaseKit\Exceptions\InvalidArgumentException;

abstract class AbstractEnum
{
    /** @var array<string> */
    protected static array $values = [];

    /** @param string $value */
    abstract public static function validate($value): void;

    /** @param mixed $value */
    protected static function assertValueValid($value): void
    {
        if (! in_array($value, static::$values, true)) {
            throw new InvalidArgumentException(sprintf(
                'Unexpected ENUM value in in class %s: %s. Possible values: (%s)',
                static::class,
                $value,
                implode(', ', static::$values)
            ));
        }
    }
}
