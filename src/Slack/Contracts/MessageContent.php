<?php

namespace ManhNT\Slack\Contracts;

interface MessageContent extends ArrayAble, JsonAble
{
    /**
     * Set content
     */
    public function setContent(string $content): self;

    /**
     * Get content
     */
    public function getContent();
}
