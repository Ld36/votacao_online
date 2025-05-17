<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('poll.{id}', function ($user, $id) {
    return true; // Canal público para acompanhamento dos resultados
});