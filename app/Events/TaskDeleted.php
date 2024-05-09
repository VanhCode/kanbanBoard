<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TaskDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $taskId;
    public $groupId;

    public function __construct($taskId, $groupId)
    {
        $this->taskId = $taskId;
        $this->groupId = $groupId;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('deleteTasks.' . $this->groupId);
    }
}
