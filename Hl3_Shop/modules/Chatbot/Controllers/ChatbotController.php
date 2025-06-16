<?php

namespace Modules\Chatbot\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $userMessage = $request->input('message');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('TOGETHER_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.together.xyz/v1/chat/completions', [
            'model' => 'mistralai/Mistral-7B-Instruct-v0.1', // 'meta-llama/Llama-3-8b-chat-hf' 都可以
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => $userMessage],
            ],
            'temperature' => 0.7,
        ]);

        if ($response->successful()) {
            return response()->json([
                'reply' => $response['choices'][0]['message']['content'] ?? 'I need more information to response 🤔'
            ]);
        } else {
            \Log::error('Together API error: ' . $response->body());
            return response()->json([
                'reply' => 'Lỗi khi gọi Together AI.'
            ]);
        }
    }
}
