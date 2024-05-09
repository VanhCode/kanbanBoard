<?php

namespace App\Events;

use App\Models\BoardDetail;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MemberGroup implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $groupId;
    public $member;
    public $user;

    public function __construct(BoardDetail $member, $groupId, $user)
    {
        $this->member = $member;
        $this->groupId = $groupId;
        $this->user = $user;
    }

    public function broadcastOn()
    {   
        // Log::debug($this->member);
        return new PrivateChannel('members.' . $this->groupId);
    }
}
