<?php

namespace App\Events;

use App\Models\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TaskCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $groupId;
    public $taskData;
    public $userIdCreate;
    public function __construct(int $groupId, int $userIdCreate, Task $taskData)
    {
        $this->groupId = $groupId;
        $this->userIdCreate = $userIdCreate;
        $this->taskData = $taskData;
    }   

    public function broadcastOn()
    {
        // Log::debug($this->taskData);
        return new PrivateChannel('task.' . $this->groupId);
    }
}
