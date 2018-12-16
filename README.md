Flowdock Client
===============

This library allows you to interact with the [Flowdock](https://www.flowdock.com/) API. Flowdock client is fork of 
[Flowdock](https://github.com/mremi/Flowdock).

**Basic Docs**

* [Installation](#installation)
* [Push API](#push-api)
* [Contribution](#contribution)

<a name="installation"></a>

## Installation

Only 1 step:

### Download Flowdock using composer

Add Flowdock in your composer.json:

```js
{
    "require": {
        "php-censor/flowdock-client": "dev-master"
    }
}
```

Now tell composer to download the library by running the command:

``` bash
$ php composer.phar update php-censor/flowdock-client
```

Composer will install the library to your project's `vendor/php-censor` directory.

<a name="push-api"></a>

## Push API

### Chat

```php
<?php

use FlowdockClient\Api\Push\ChatMessage;
use FlowdockClient\Api\Push\Push;

$message = ChatMessage::create()
    ->setContent('This message has been sent with php-censor/flowdock-client PHP library')
    ->setExternalUserName('php-censor)
    ->addTag('#hello-world');

$push = new Push('your_flow_api_token');

if (!$push->sendChatMessage($message, array('connect_timeout' => 1, 'timeout' => 1))) {
    // handle errors...
    $message->getResponseErrors();
}
```

You can also do it in your console, look at the help message:

```bash
$ bin/flowdock send-chat-message --help
```

Some arguments are mandatory:

```bash
$ bin/flowdock send-chat-message your_flow_api_token "This message has been sent with php-censor/flowdock-client PHP library" php-censor
```

Some options are available:

```bash
$ bin/flowdock send-chat-message your_flow_api_token "This message has been sent with php-censor/flowdock-client PHP library" php-censor --message-id=12 --tags="#hello" --tags="#world" --options='{"connect_timeout":1,"timeout":1}'
```

### Team Inbox

```php
<?php

use FlowdockClient\Api\Push\Push;
use FlowdockClient\Api\Push\TeamInboxMessage;

$message = TeamInboxMessage::create()
    ->setSource('source')
    ->setFromAddress('test@test.com')
    ->setSubject('subject')
    ->setContent('This message has been sent with php-censor/flowdock-client PHP library');

$push = new Push('your_flow_api_token');

if (!$push->sendTeamInboxMessage($message, array('connect_timeout' => 1, 'timeout' => 1))) {
    // handle errors...
    $message->getResponseErrors();
}
```

You can also do it in your console, look at the help message:

```bash
$ bin/flowdock send-team-inbox-message --help
```

Some arguments are mandatory:

```bash
$ bin/flowdock send-team-inbox-message your_flow_api_token source "test@test.com" subject "This message has been sent with php-censor/flowdock-client PHP library"
```

Some options are available:

```bash
$ bin/flowdock send-team-inbox-message your_flow_api_token source "test@test.com" subject "This message has been sent with php-censor/flowdock-client PHP library" --from-name=php-censor --reply-to="test@test.com" --project=project --format=html --link="http://www.flowdock.com/" --tags="#hello" --tags="#world" --options='{"connect_timeout":1,"timeout":1}'
```

...and more features coming soon...

<a name="contribution"></a>

## Contribution

Any question or feedback? Open an issue and I will try to reply quickly.

A feature is missing here? Feel free to create a pull request to solve it!

I hope this has been useful and has helped you. If so, share it and recommend
it! :)
