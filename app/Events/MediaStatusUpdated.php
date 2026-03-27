<?php

namespace App\Events;

use App\Models\Media;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MediaStatusUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Media $media
    ) {
        Log::error("entrou 1234");
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        Log::error("entrou 123");
        return [
            new PrivateChannel('media.' . $this->media->id),
        ];
    }

    public function broadcastWith(): array
    {
        Log::error("entrou");
        return [
            'media' => [
                'id' => $this->media->id,
                'status' => $this->media->status,
                's3_url' => $this->media->s3_url,
            ],
        ];
    }
}
