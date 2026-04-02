<?php

namespace App\Service;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPConnectionConfig;
use PhpAmqpLib\Connection\AMQPConnectionFactory;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    protected AMQPStreamConnection $connection;
    protected AMQPChannel $channel;

    protected string $queue;

    public function __construct()
    {
        $this->queue = config("amqp.queue");

        $amqpConfig = new AMQPConnectionConfig();
        $amqpConfig->setHost(config('amqp.host'));
        $amqpConfig->setPort(config('amqp.port'));
        $amqpConfig->setUser(config('amqp.user'));
        $amqpConfig->setPassword(config('amqp.password'));
        $amqpConfig->setVhost(config('amqp.vhost'));

        if(config('app.env') === 'production') {
            $amqpConfig->setIsSecure(true);
        }

        $this->connection = AMQPConnectionFactory::create($amqpConfig);

        $this->channel = $this->connection->channel();

        $this->channel->queue_declare(
            $this->queue,
            false,
            config('amqp.durable', true),
            false,
            false
        );
    }

    public function getChannel()
    {
        return $this->channel;
    }

    public function publish(string $message): void
    {
        $msg = new AMQPMessage(
            $message,
            /*['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]*/
        );
        $this->channel->basic_publish($msg, '', $this->queue);
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
