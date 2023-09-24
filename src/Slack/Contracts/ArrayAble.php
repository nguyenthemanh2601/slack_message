<?php

namespace ManhNT\Slack\Contracts;

/**
 * @template TKey of array-key
 * @template TValue
 */
interface ArrayAble
{
    /**
     * Get the instance as an array.
     *
     * @return array<TKey, TValue>
     */
    public function toArray();
}
