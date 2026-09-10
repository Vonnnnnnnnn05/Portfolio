<?php

namespace Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ChatTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['services.groq.key' => 'test-key', 'app.debug' => false]);
        Http::preventStrayRequests();
    }

    public function test_chat_sends_prompt_and_trimmed_message_and_returns_reply(): void
    {
        Http::fake(['api.groq.com/*' => Http::response(['choices' => [['message' => ['content' => 'Von builds web systems.']]]])]);
        foreach (['/api/chat', '/api/chat.php'] as $url) {
            $this->postJson($url, ['message' => '  What does Von build?  '])
                ->assertOk()->assertExactJson(['reply' => 'Von builds web systems.']);
        }
        Http::assertSent(fn (Request $request) => $request->hasHeader('Authorization', 'Bearer test-key')
            && $request['messages'][0]['role'] === 'system'
            && str_contains($request['messages'][0]['content'], 'Scholarship Data Profiling')
            && $request['messages'][1] === ['role' => 'user', 'content' => 'What does Von build?']
            && $request['model'] === 'openai/gpt-oss-20b');
    }

    public static function invalidMessages(): array
    {
        return [[null], [''], ['   '], [123], [['text']], [str_repeat('a', 1001)], [str_repeat('界', 334)]];
    }

    #[DataProvider('invalidMessages')]
    public function test_invalid_input_is_rejected_without_provider_call(mixed $message): void
    {
        $this->postJson('/api/chat', ['message' => $message])->assertStatus(400)->assertJsonStructure(['error']);
        Http::assertNothingSent();
    }

    public function test_malformed_json_is_rejected(): void
    {
        $this->call('POST', '/api/chat', [], [], [], ['CONTENT_TYPE' => 'application/json'], '{')
            ->assertStatus(400)->assertJsonStructure(['error']);
        Http::assertNothingSent();
    }

    public function test_missing_key_returns_configuration_message(): void
    {
        config(['services.groq.key' => '']);
        $this->postJson('/api/chat', ['message' => 'Hello'])->assertStatus(503)->assertJsonStructure(['error']);
        Http::assertNothingSent();
    }

    public function test_cross_origin_request_is_rejected(): void
    {
        $this->withHeader('Origin', 'https://other.example')->postJson('/api/chat', ['message' => 'Hello'])
            ->assertStatus(403)->assertJsonStructure(['error']);
        Http::assertNothingSent();
    }

    public function test_same_origin_is_allowed(): void
    {
        Http::fake(['*' => Http::response(['choices' => [['message' => ['content' => 'Hello']]]])]);
        $this->withHeader('Origin', 'http://localhost')->postJson('/api/chat', ['message' => 'Hello'])->assertOk();
    }

    public function test_get_is_not_allowed(): void
    {
        $this->getJson('/api/chat')->assertStatus(405)->assertJsonStructure(['error']);
    }

    public function test_provider_failure_does_not_expose_internal_details(): void
    {
        Http::fake(['*' => Http::response(['error' => ['message' => 'Private provider detail']], 401)]);
        $this->postJson('/api/chat', ['message' => 'Hello'])->assertStatus(502)
            ->assertJsonStructure(['error'])->assertDontSee('Private provider detail');
    }

    public function test_connection_failure_returns_json(): void
    {
        Http::fake(['*' => Http::failedConnection()]);
        $this->postJson('/api/chat', ['message' => 'Hello'])->assertStatus(502)->assertJsonStructure(['error']);
    }

    public function test_non_json_provider_response_returns_error(): void
    {
        Http::fake(['*' => Http::response('<html>Gateway error</html>')]);
        $this->postJson('/api/chat', ['message' => 'Hello'])->assertStatus(502)->assertJsonStructure(['error']);
    }

    public function test_empty_reply_falls_back_to_contact(): void
    {
        Http::fake(['*' => Http::response(['choices' => []])]);
        $this->postJson('/api/chat', ['message' => 'Hello'])->assertOk()
            ->assertExactJson(['reply' => 'Please email Von directly for more details.']);
    }

    public function test_both_chat_urls_share_rate_limit(): void
    {
        Http::fake(['*' => Http::response(['choices' => []])]);
        for ($i = 0; $i < 20; $i++) {
            $this->postJson('/api/chat', ['message' => 'Hello'])->assertOk();
        }
        $this->postJson('/api/chat.php', ['message' => 'Hello'])->assertStatus(429)->assertJsonStructure(['error']);
    }
}
