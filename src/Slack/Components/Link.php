<?php

namespace ManhNT\Slack\Components;

use ManhNT\Slack\{
    Exceptions\UnexpectedTypeException,
    Support\Validation\ValidatesAttributes,
};
use ManhNT\Slack\Contracts\{StringAble, InvokeAble};

class Link implements StringAble, InvokeAble
{
    public string|null $object;

    public function __construct(string $url = null, string $title = '')
    {
        if ($url) {
            $this->url($url, $title);
        }
    }

    public function url(string $url, string $title = '')
    {
        if (!ValidatesAttributes::validateUrl($url)) {
            throw new UnexpectedTypeException($url, 'url');
        }

        $this->object = sprintf("<{$url}%s>", $title ? "|{$title}" : '');

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
