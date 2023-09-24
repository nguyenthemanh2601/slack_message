<?php

namespace ManhNT\Slack\Enums;

enum MentionType
{
    case USER;
    case HERE;
    case GROUP;
    case CHANNEL;
    case EVERYONE;
}
