<?php

namespace App\Events;

use App\Models\Poll;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VoteRegistered implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $poll;
    public $pollOption;
    public $currentVotes;

    public function __construct(Poll $poll, $pollOption, $currentVotes)
    {
        $this->poll = $poll;
        $this->pollOption = $pollOption;
        $this->currentVotes = $currentVotes;
    }

    public function broadcastOn()
    {
        return new Channel('poll.' . $this->poll->id);
    }
}