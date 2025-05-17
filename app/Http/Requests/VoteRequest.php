<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $poll = $this->route('poll');
        
        return [
            'poll_option_id' => 'required|exists:poll_options,id',
            'token' => $poll && $poll->tipo_restricao === 'token' ? 'required|string' : 'nullable'
        ];
    }

    public function messages(): array
    {
        return [
            'poll_option_id.required' => 'É necessário selecionar uma opção',
            'poll_option_id.exists' => 'A opção selecionada é inválida',
            'token.required' => 'Token é obrigatório para esta enquete'
        ];
    }
}