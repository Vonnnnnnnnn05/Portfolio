<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $origin = $request->header('Origin');
        if ($origin !== null && rtrim($origin, '/') !== $request->getSchemeAndHttpHost()) {
            return response()->json(['error' => 'Request origin is not allowed.'], 403);
        }

        $key = trim((string) config('services.groq.key'));
        if ($key === '') {
            return response()->json(['error' => 'The assistant is being configured. Please email Von directly.'], 503);
        }

        $body = json_decode($request->getContent(), true);
        $message = is_array($body) ? ($body['message'] ?? null) : null;
        if (! is_string($message) || trim($message) === '' || strlen($message) > 1000) {
            return response()->json(['error' => 'Please enter a shorter message.'], 400);
        }

        try {
            $response = Http::withToken($key)->acceptJson()->connectTimeout(10)->timeout(30)
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => config('services.groq.model'),
                    'temperature' => 0.5,
                    'max_tokens' => 220,
                    'messages' => [
                        ['role' => 'system', 'content' => file_get_contents(resource_path('prompts/portfolio.txt'))],
                        ['role' => 'user', 'content' => trim($message)],
                    ],
                ]);
        } catch (ConnectionException $e) {
            // Do not log request headers or credentials from exception details.
            Log::warning('Portfolio chat could not connect to Groq.');

            return $this->unavailable();
        }

        if (! $response->successful() || ! is_array($response->json())) {
            Log::warning('Portfolio chat received an invalid Groq response.', ['status' => $response->status()]);

            return $this->unavailable();
        }

        $reply = $response->json('choices.0.message.content');

        return response()->json([
            'reply' => is_string($reply) && trim($reply) !== ''
                ? $reply
                : 'Please email Von directly for more details.',
        ]);
    }

    private function unavailable(): JsonResponse
    {
        return response()->json(['error' => 'The assistant is temporarily unavailable. Please try again later.'], 502);
    }
}
