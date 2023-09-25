<?php

namespace ManhNT\Slack\Components;

use ManhNT\Slack\Contracts\{
    StringAble,
    InvokeAble,
    MessageContent,
};
use Illuminate\Support\Str;

class BlockQuote implements MessageContent, StringAble, InvokeAble
{
    public string|null $object;

    public function __construct(string $content = null)
    {
        if ($content) {
            $this->setContent($content);
        }
    }

    public function setContent(string $value): self
    {
        $this->object = Str::replace("\n", "\n>", $value);
        $this->object = Str::startsWith($this->object, ">") ? $this->object : ">{$this->object}";

        return $this;
    }

    public function getContent()
    {
        return $this->__toString();
    }

    public function toArray()
    {
        return [
            'text' => $this->__toString()
        ];
    }

    public function toJson($options = 0)
    {
        return json_encode($this->getContent(), $options);
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
