<?php

namespace ManhNT\Slack\Contracts;

interface InvokeAble
{
    /**
     * Trigger when a script tries to call this object as a function.
     */
    public function __invoke(...$parameters);
}
