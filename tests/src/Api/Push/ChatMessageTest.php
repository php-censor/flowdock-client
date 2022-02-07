<?php

/*
 * (c) Rémi Marseille <marseille.remi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FlowdockClient\Tests\Api\Push;

use GuzzleHttp\Psr7\Response;

use FlowdockClient\Api\Push\ChatMessage;

/**
 * Tests the ChatMessage class
 *
 * @author Rémi Marseille <marseille.remi@gmail.com>
 */
class ChatMessageTest extends BaseMessageTest
{
    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->message = new ChatMessage;
    }

    /**
     * {@inheritdoc}
     */
    public function testGetData()
    {
        $this->message
            ->setContent('Hello world!')
            ->setExternalUserName('mremi')
            ->addTag('tag1')
            ->addTag('tag2')
            ->setMessageId(1)
            ->setResponse(new Response(200));

        $expected = array(
            'content'            => $this->message->getContent(),
            'external_user_name' => $this->message->getExternalUserName(),
            'tags'               => $this->message->getTags(),
            'message_id'         => $this->message->getMessageId(),
        );

        $this->assertEquals($expected, $this->message->getData());
    }

    /**
     * {@inheritdoc}
     */
    public function testToArray()
    {
        $this->message
            ->setContent('Hello world!')
            ->setExternalUserName('mremi')
            ->addTag('tag1')
            ->addTag('tag2')
            ->setMessageId(1)
            ->setResponse(new Response(200));

        $expected = array(
            'content'            => $this->message->getContent(),
            'external_user_name' => $this->message->getExternalUserName(),
            'tags'               => $this->message->getTags(),
            'message_id'         => $this->message->getMessageId(),
            'response'           => $this->message->getResponse(),
        );

        $this->assertEquals($expected, $this->message->toArray());
    }
}
