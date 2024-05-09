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

class TaskUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $groupId;

    public $taskId;

    public $taskData;

    public function __construct($groupId, $taskId, $taskData)
    {
        $this->groupId = $groupId;
        $this->taskId = $taskId;
        $this->taskData = $taskData;
    }

    public function broadcastOn()
    {
        Log::debug($this->groupId.$this->taskData.$this->taskId);
        return new PrivateChannel('tasks.' . $this->groupId);
    }
}
