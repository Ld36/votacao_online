<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessVote;
use App\Models\Poll;
use App\Models\PollOption;
use App\Http\Requests\VoteRequest;
use Illuminate\Http\JsonResponse;

class VoteController extends Controller
{
    public function store(VoteRequest $request, Poll $poll): JsonResponse
    {
        $option = PollOption::findOrFail($request->poll_option_id);
        
        // Verifica se a enquete está ativa
        if (!$poll->ativo || now()->lt($poll->data_inicio) || now()->gt($poll->data_fim)) {
            return response()->json(['message' => 'Esta enquete não está ativa.'], 403);
        }

        // Verifica restrição de voto
        if ($poll->tipo_restricao === 'ip') {
            $existingVote = $poll->votes()->where('ip_address', $request->ip())->exists();
        } else {
            $existingVote = $poll->votes()->where('token', $request->token)->exists();
        }

        if ($existingVote) {
            return response()->json(['message' => 'Você já votou nesta enquete.'], 403);
        }

        // Registra o voto
        $poll->votes()->create([
            'poll_option_id' => $option->id,
            'ip_address' => $request->ip(),
            'token' => $request->token
        ]);

        // Processa o voto em fila
        ProcessVote::dispatch($option);
        return response()->json(['message' => 'Voto registrado com sucesso.'], 201);
    }

    public function results(Poll $poll): JsonResponse
    {
        $results = $poll->options()
            ->select('id', 'titulo', 'votos')
            ->get();

        return response()->json($results);
    }
}