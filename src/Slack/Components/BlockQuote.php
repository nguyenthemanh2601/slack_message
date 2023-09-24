<?php

namespace ManhNT\Slack\Components;

use ManhNT\Slack\Contracts\{StringAble, InvokeAble};
use Illuminate\Support\Str;

class BlockQuote implements StringAble, InvokeAble
{
    public string|null $object;

    public function __construct(string $content = null)
    {
        if ($content) {
            $this->content($content);
        }
    }

    public function content(string $value)
    {
        $this->object = Str::replace("\n", ">", $value);

        return $this;
    }

    /**
     * Trigger when a script tries to call this object as a function.
     *
     * @return string
     */
    public function __invoke(...$parameters)
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        return $this->object;
    }
}
