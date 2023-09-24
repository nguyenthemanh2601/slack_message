<?php

namespace App\Enums;

use Illuminate\Support\Str;
use ManhNT\Slack\Exceptions\UnexpectedTypeException;

trait NormalizeTrait
{
    public function normalize()
    {
        return static::normalizeCase($this);
    }

    /**
     * Converts an all case into accepted values of Stripe.
     */
    public static function normalizes(): array
    {
        return array_map(fn ($case) => static::normalizeCase($case), self::cases());
    }

    /**
     * Normalize a case
     *
     * @param static $case
     */
    public static function normalizeCase($case): string
    {
        if (!$case instanceof static) {
            throw new UnexpectedTypeException($case, static::class);
        }

        return Str::snake($case->name);
    }
}
