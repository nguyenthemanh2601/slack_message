<?php

namespace ManhNT\Slack\Components;

use ManhNT\Slack\Contracts\{
    StringAble,
    MessageContent,
};

class TextContent implements MessageContent, StringAble
{
    public $content;

    public function __construct(string $content = null)
    {
        if ($content) {
            $this->setContent($content);
        }
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getContent()
    {
        return $this->__toString();
    }

    public function fromText(string $text): self
    {
        return $this->setContent($text);
    }

    public function __toString(): string
    {
        return $this->content;
    }

    public function toArray()
    {
        return [
            'text' => $this->__toString()
        ];
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }
}
