<?php
require "./vendor/autoload.php";

$container = new Illuminate\Container\Container;
$mention = $container->make(ManhNT\Slack\Components\Mention::class, ["object" => "C05T8NVRAQ7", "type" => ManhNT\Slack\Enums\MentionType::USER])->everyone();
$text = $container->make(ManhNT\Slack\Components\TextContent::class, ["content" => "Xin lỗi $mention, tôi nhầm channel"]);

$slack = $container->make(ManhNT\Slack\Message::class)
    ->setAccessToken("xoxb-5747361720098-5749852140148-45OU5UqoslhxNlQsxQ4736OB")
    ->send($text, "C05T8NVRAQ7");