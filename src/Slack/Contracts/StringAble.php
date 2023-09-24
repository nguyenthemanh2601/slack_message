<?php

namespace ManhNT\Slack\Contracts;

interface StringAble
{
    /**
     * Convert the object to its string.
     *
     * @return string
     */

    public function __toString(): string;
}
