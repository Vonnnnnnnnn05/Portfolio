<?php
// Groq-powered portfolio chat assistant.
// Handles POST /api/chat on the VPS (see README "Deploy to a VPS" for Nginx setup).
// The API key lives in api/config.php (gitignored) or the GROQ_API_KEY environment variable.
//
// Debugging: every failure is logged via error_log() (visible in your PHP error log),
// and if APP_DEBUG is enabled in config.php the real error message is also returned to
// the chat widget. Keep APP_DEBUG off in production.

if (file_exists(__DIR__ . '/config.php')) {
    require_once __DIR__ . '/config.php';
}

const GROQ_URL = 'https://api.groq.com/openai/v1/chat/completions';
const GROQ_MODEL = 'openai/gpt-oss-20b';
const MAX_MESSAGE_BYTES = 1000;

$systemPrompt = <<<'PROMPT'
You are Von Esson A. Vergara's portfolio assistant. Answer visitors' questions about Von using only the facts below. Be warm, clear, and concise (normally 2-4 sentences). Do not invent dates, employers, project metrics, availability, credentials, or links. If an answer is not covered, say that the visitor can email Von directly at von.vergara.399@gmail.com.

Who Von is:
- Von Esson A. Vergara is an Information Technology student and developer.
- He builds practical web systems and connected hardware/IoT projects that make workflows clearer, faster, and more reliable.
- His interests include web systems, databases, automation, Arduino integration, and connecting people, data, and hardware.

Tech stack:
- Web and backend: PHP, JavaScript, HTML, CSS, CodeIgniter 4, Laravel, Bootstrap, and Tailwind CSS.
- Data and workflow: MySQL, reporting, data management, inventory systems, tracking, and automation.
- Hardware and IoT: Arduino, RFID, sensors, RGB LEDs, LCD displays, WiFi modules, and database-connected prototypes.
- Tools: Composer, Git, and XAMPP.
- Deployment and server tools: Microsoft Azure, Nginx, and Ubuntu.
- Recent portfolio work includes server deployment, cloud hosting, and Groq-powered AI/API integration.

Selected work:
- Scholarship Data Profiling: a PHP, MySQL, and Chart.js web system for centralized scholar records, reporting, visual analytics, monitoring, and program compliance.
- Carwash CRM: a PHP, MySQL, and JavaScript system for customer records, service transactions, visit history, and operational workflow.
- Attendance Management: a PHP, MySQL, and QR Code API system for QR attendance tracking, real-time monitoring, automated reporting, and analytics.
- Other web projects include product management, scholarship eligibility checking, weather forecasting, boarding-house management, healthcare management, and inventory management.
- Other Arduino/IoT projects include RFID attendance, a smart mousetrap, a mood lamp controller, and interactive memory games.

Experience and education:
- Von has worked as an Encoder / Inventory Manager at Alocada Enterprises, managing inventory data and stock-management workflows.
- He has experience as an independent System Developer creating custom web and hardware-integrated solutions, and as an academic Team Leader coordinating software and hardware project teams.
- He is pursuing a BS in Information Technology at Sultan Kudarat State University and has received Dean's List and President's List recognition.
- He completed the STEM track with honors at Sto. Niño National High School.

Contact and links:
- Email: von.vergara.399@gmail.com
- GitHub: https://github.com/Vonnnnnnnnn05
- LinkedIn: https://ph.linkedin.com/in/von-esson-vergara-8454063b8
- Facebook: https://www.facebook.com/Vonnnnnnnnnnnnnnnnn29
- A resume is available from the portfolio's View Resume link.

For hiring, collaboration, or project inquiries, invite visitors to email Von. Do not claim that Von is currently available, employed, or accepting work unless the visitor asks how to contact him.
PROMPT;

function jsonResponse($status, $payload)
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

// Returns [httpStatus, decodedJson]. Throws a RuntimeException with a specific
// reason if Groq is unreachable or the response is not valid JSON.
function groqRequest($key, $payload): array
{
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\nAuthorization: Bearer {$key}\r\n",
            'content' => $payload,
            'ignore_errors' => true,
            'timeout' => 30,
        ],
    ]);

    // Suppress the PHP warning so it can't corrupt our JSON response;
    // error_get_last() captures the real failure reason instead.
    $responseBody = @file_get_contents(GROQ_URL, false, $context);

    if ($responseBody === false) {
        $lastError = error_get_last();
        $detail = is_array($lastError) ? ($lastError['message'] ?? 'unknown error') : 'unknown error';
        throw new RuntimeException('Could not reach the Groq API: ' . $detail);
    }

    $statusCode = 500;
    if (isset($http_response_header[0]) && preg_match('#\s(\d{3})\s#', $http_response_header[0], $m)) {
        $statusCode = (int) $m[1];
    }

    $data = json_decode($responseBody, true);
    if (!is_array($data)) {
        throw new RuntimeException(sprintf(
            'Groq returned a non-JSON response (HTTP %d): %s',
            $statusCode,
            substr($responseBody, 0, 200)
        ));
    }

    return [$statusCode, $data];
}

function debugMode(): bool
{
    return defined('APP_DEBUG') && APP_DEBUG;
}

// Writes to api/logs/chat.log (gitignored, reliable on XAMPP) AND to the
// standard PHP error log (PHP-FPM/journalctl on the VPS).
function logChat(string $message): void
{
    $logDir = __DIR__ . '/logs';
    if (!is_dir($logDir)) {
        @mkdir($logDir, 0775, true);
    }
    @error_log('[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL, 3, $logDir . '/chat.log');
    error_log('[portfolio chat] ' . $message);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    jsonResponse(405, ['error' => 'Method not allowed']);
}

$key = trim((string) (getenv('GROQ_API_KEY') ?: (defined('GROQ_API_KEY') ? GROQ_API_KEY : '')));
if ($key === '') {
    jsonResponse(503, ['error' => 'The assistant is being configured. Please email Von directly.']);
}

$raw = file_get_contents('php://input');
$body = json_decode($raw !== false ? $raw : '', true);
$message = is_array($body) ? ($body['message'] ?? null) : null;

if (!is_string($message) || trim($message) === '' || strlen($message) > MAX_MESSAGE_BYTES) {
    jsonResponse(400, ['error' => 'Please enter a shorter message.']);
}
if (!preg_match('//u', $message)) {
    jsonResponse(400, ['error' => 'Please enter a valid message.']);
}

// The assistant is only served from this site, so reject cross-origin requests.
// Compare bare hostnames (strip any port) so localhost:8000 and 127.0.0.1:8099 both pass.
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if ($origin !== '') {
    $originHost = parse_url($origin, PHP_URL_HOST);
    $host = parse_url('http://' . ($_SERVER['HTTP_HOST'] ?? ''), PHP_URL_HOST);
    if (!is_string($originHost) || !is_string($host) || $originHost !== $host) {
        jsonResponse(403, ['error' => 'Request origin is not allowed.']);
    }
}

$payload = json_encode([
    'model' => GROQ_MODEL,
    'temperature' => 0.5,
    'max_tokens' => 220,
    'messages' => [
        ['role' => 'system', 'content' => $systemPrompt],
        ['role' => 'user', 'content' => trim($message)],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

try {
    [$statusCode, $data] = groqRequest($key, $payload);
} catch (Throwable $e) {
    logChat($e->getMessage());
    $error = debugMode()
        ? $e->getMessage()
        : 'The assistant is temporarily unavailable. Please try again later.';
    jsonResponse(502, ['error' => $error]);
}

if ($statusCode >= 400) {
    $groqError = is_array($data) && isset($data['error']['message'])
        ? $data['error']['message']
        : 'The assistant is unavailable.';
    logChat("Groq returned HTTP {$statusCode}: " . $groqError);
    jsonResponse($statusCode, ['error' => $groqError]);
}

$reply = is_array($data) ? ($data['choices'][0]['message']['content'] ?? '') : '';
if ($reply === '') {
    jsonResponse(200, ['reply' => 'Please email Von directly for more details.']);
}
jsonResponse(200, ['reply' => $reply]);
