<?php

namespace ManhNT\Slack;

use ManhNT\Slack\Contracts\MessageContent;
use Illuminate\Http\Client\PendingRequest;
use ManhNT\Slack\Exceptions\ApiAccessTokenNotSetException;

class Message
{
    private const API_BASE_URL = 'https://slack.com';
    private const CHAT_ENDPOINT = 'api/chat.postMessage';

    /**
     * Slack bot access token
     *
     * @var string
     */
    private string $botAccessToken;

    public function __construct(
        private PendingRequest $client,
    ) {
        $this->client->baseUrl(self::API_BASE_URL);
    }

    /**
     * Set access token
     *
     * @param  string  $accessToken
     * @return self
     */
    public function setAccessToken(string $accessToken)
    {
        $this->botAccessToken = $accessToken;

        return $this;
    }

    protected function accessToken()
    {
        if (!isset($this->botAccessToken)) {
            throw new ApiAccessTokenNotSetException("Access token can not be empty");
        }

        return $this->botAccessToken;
    }

    public function send(MessageContent $message, string $channelId = '')
    {
        $response = $this->client
            ->withToken($this->accessToken())
            ->post(
                self::CHAT_ENDPOINT,
                array_merge(
                    ['channel' => $channelId],
                    $message->toArray(),
                )
            );

        if (!$response->successful()) {
            return false;
        }

        return $response->json();
    }
}
