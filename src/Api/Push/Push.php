<?php

/*
 * (c) Rémi Marseille <marseille.remi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FlowdockClient\Api\Push;

use GuzzleHttp\Client;

/**
 * Push class
 *
 * @author Rémi Marseille <marseille.remi@gmail.com>
 */
class Push implements PushInterface
{
    const BASE_CHAT_URL       = 'https://api.flowdock.com/v1/messages/chat';
    const BASE_TEAM_INBOX_URL = 'https://api.flowdock.com/v1/messages/team_inbox';

    /**
     * @var string
     */
    private $flowApiToken;

    /**
     * Constructor
     *
     * @param string $flowApiToken A flow API token
     */
    public function __construct($flowApiToken)
    {
        $this->flowApiToken = $flowApiToken;
    }

    /**
     * {@inheritdoc}
     */
    public function sendChatMessage(ChatMessageInterface $message, array $options = array())
    {
        return $this->sendMessage($message, self::BASE_CHAT_URL, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function sendTeamInboxMessage(TeamInboxMessageInterface $message, array $options = array())
    {
        return $this->sendMessage($message, self::BASE_TEAM_INBOX_URL, $options);
    }

    /**
     * Sends a message to a flow
     *
     * @param BaseMessageInterface $message A message instance to send
     * @param string               $baseUrl A base URL
     * @param array                $options An array of options used by request
     *
     * @return boolean
     */
    protected function sendMessage(BaseMessageInterface $message, $baseUrl, array $options = array())
    {
        $client = $this->createClient(sprintf('%s/%s', $baseUrl, $this->flowApiToken));

        $response = $client->post(null, array_merge(
            $options, [
                'headers' => ['Content-Type' => 'application/json'],
                'json'    => $message->getData()
            ]
        ));

        $message->setResponse($response);

        return !$message->hasResponseErrors();
    }

    /**
     * Creates a client to interact with Flowdock API
     *
     * @param string $url
     *
     * @return Client
     */
    protected function createClient($url)
    {
        return new Client($url);
    }
}
