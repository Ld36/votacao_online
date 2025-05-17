<?php

namespace App\Jobs;

use App\Events\VoteRegistered;
use App\Models\PollOption;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessVote implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pollOption;

    public function __construct(PollOption $pollOption)
    {
        $this->pollOption = $pollOption;
    }

    public function handle()
    {
        $this->pollOption->increment('votos');
        
        event(new VoteRegistered(
            $this->pollOption->poll,
            $this->pollOption,
            $this->pollOption->votos
        ));
    }
}