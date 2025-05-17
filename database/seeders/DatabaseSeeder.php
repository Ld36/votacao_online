<?php

namespace Database\Seeders;

use App\Models\Poll;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Criar uma enquete de exemplo
        $poll = Poll::create([
            'titulo' => 'Qual sua linguagem de programação favorita?',
            'descricao' => 'Vote na sua linguagem de programação preferida',
            'data_inicio' => now(),
            'data_fim' => now()->addDays(7),
            'ativo' => true,
            'tipo_restricao' => 'ip'
        ]);

        // Criar opções para a enquete
        $poll->options()->createMany([
            [
                'titulo' => 'PHP',
                'descricao' => 'PHP é uma linguagem de script server-side'
            ],
            [
                'titulo' => 'JavaScript',
                'descricao' => 'JavaScript é a linguagem da web'
            ],
            [
                'titulo' => 'Python',
                'descricao' => 'Python é conhecido por sua simplicidade'
            ],
            [
                'titulo' => 'Java',
                'descricao' => 'Java é usado em muitas aplicações empresariais'
            ]
        ]);
    }
}