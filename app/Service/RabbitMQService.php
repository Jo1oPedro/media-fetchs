<?php

namespace App\Service;

use PhpAmqpLib\Channel\AMQPChannel;
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

        $this->connection = new AMQPStreamConnection(
            config('amqp.host'),
            config('amqp.port'),
            config('amqp.user'),
            config('amqp.password'),
            config('amqp.vhost')
        );

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
