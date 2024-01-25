<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductImported
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $row;

    /**
     * Create a new event instance.
     *
     * @param array $row
     */
    public function __construct(array $row)
    {
        $this->row = $row;
    }
}
