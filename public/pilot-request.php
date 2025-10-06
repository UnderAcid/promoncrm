<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

function respond(int $status, array $payload): void
{
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

if (strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    respond(405, [
        'success' => false,
        'message' => 'Method not allowed',
    ]);
}

$input = [
    'name' => trim((string) ($_POST['name'] ?? '')),
    'email' => trim((string) ($_POST['email'] ?? '')),
    'company' => trim((string) ($_POST['company'] ?? '')),
    'goal' => trim((string) ($_POST['goal'] ?? '')),
    'participation' => isset($_POST['participation']),
    'lang' => trim((string) ($_POST['lang'] ?? '')),
];

$errors = [];
if ($input['name'] === '') {
    $errors['name'] = 'required';
}
if ($input['email'] === '' || filter_var($input['email'], FILTER_VALIDATE_EMAIL) === false) {
    $errors['email'] = 'email';
}
if ($input['goal'] === '') {
    $errors['goal'] = 'required';
}
if ($input['participation'] !== true) {
    $errors['participation'] = 'required';
}

if ($errors !== []) {
    respond(422, [
        'success' => false,
        'errors' => $errors,
    ]);
}

$logDir = dirname(__DIR__) . '/storage';
$logFile = $logDir . '/pilot-requests.log';

if (!is_dir($logDir)) {
    @mkdir($logDir, 0775, true);
}

$record = [
    'name' => $input['name'],
    'email' => $input['email'],
    'company' => $input['company'],
    'goal' => $input['goal'],
    'lang' => $input['lang'],
    'participation' => $input['participation'],
    'timestamp' => (new DateTimeImmutable('now', new DateTimeZone('UTC')))->format(DateTimeInterface::ATOM),
    'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
    'user_agent' => substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 500),
];

$logPayload = json_encode($record, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
if ($logPayload !== false) {
    @file_put_contents($logFile, $logPayload . PHP_EOL, FILE_APPEND | LOCK_EX);
}

respond(200, [
    'success' => true,
]);
