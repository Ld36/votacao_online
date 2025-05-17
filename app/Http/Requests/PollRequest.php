<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_inicio' => 'required|date|after_or_equal:today',
            'data_fim' => 'required|date|after:data_inicio',
            'ativo' => 'boolean',
            'tipo_restricao' => 'required|in:ip,token',
            'options' => 'sometimes|required|array|min:2',
            'options.*.titulo' => 'required|string|max:255',
            'options.*.descricao' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O título da enquete é obrigatório',
            'data_inicio.required' => 'A data de início é obrigatória',
            'data_fim.required' => 'A data de término é obrigatória',
            'data_inicio.after_or_equal' => 'A data de início deve ser hoje ou uma data futura',
            'data_fim.after' => 'A data de término deve ser posterior à data de início',
            'options.min' => 'A enquete deve ter pelo menos 2 opções',
            'options.*.titulo.required' => 'Todas as opções devem ter um título'
        ];
    }
}