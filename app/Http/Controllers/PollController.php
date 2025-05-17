<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Http\Requests\PollRequest;
use Illuminate\Http\JsonResponse;

class PollController extends Controller
{
    public function index(): JsonResponse
    {
        $polls = Poll::with('options')->get();
        return response()->json($polls);
    }

    public function store(PollRequest $request): JsonResponse
    {
        $poll = Poll::create($request->validated());
        
        if ($request->has('options')) {
            $poll->options()->createMany($request->options);
        }

        return response()->json($poll->load('options'), 201);
    }

    public function show(Poll $poll): JsonResponse
    {
        return response()->json($poll->load('options'));
    }

    public function update(PollRequest $request, Poll $poll): JsonResponse
    {
        $poll->update($request->validated());
        return response()->json($poll->fresh());
    }

    public function destroy(Poll $poll): JsonResponse
    {
        $poll->delete();
        return response()->json(null, 204);
    }
}