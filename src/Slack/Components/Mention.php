<?php

namespace ManhNT\Slack\Components;

use ManhNT\Slack\Enums\MentionType;
use ManhNT\Slack\Contracts\{StringAble, InvokeAble};

class Mention implements StringAble, InvokeAble
{
    public string|null $object;

    public function __construct(
        string|MentionType $object = null,
        public MentionType $type = MentionType::USER,
    ) {
        if ($object) {
            $this->to($object, $type);
        }
    }

    public function to(MentionType|string $object, MentionType $type = MentionType::USER): self
    {
        if ($object instanceof MentionType) {
            return $this->{$object->name}($object);
        }

        return match ($type) {
            MentionType::USER, MentionType::GROUP => $this->{$type->name}($object),
            default => $this->{$type->name}(),
        };
    }

    public function user(string $id): self
    {
        $this->object = "<@{$id}>";

        return $this;
    }

    public function here(): self
    {
        $this->object = "<!here>";

        return $this;
    }

    public function group(string $id): self
    {
        $this->object = "<!subteam^{$id}>";

        return $this;
    }

    public function channel(): self
    {
        $this->object = "<!channel>";

        return $this;
    }

    public function everyone(): self
    {
        $this->object = "<!everyone>";

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
