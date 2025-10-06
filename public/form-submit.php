<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

if (strtoupper($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed.',
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$rawBody = trim(file_get_contents('php://input') ?: '');
$data = [];
if ($rawBody !== '') {
    $decoded = json_decode($rawBody, true);
    if (is_array($decoded)) {
        $data = $decoded;
    }
}

if ($data === []) {
    $data = $_POST;
}

$clean = static function (array $source, string $key): string {
    $value = $source[$key] ?? '';
    if (!is_string($value)) {
        $value = (string) $value;
    }
    $value = trim($value);
    if ($value === '') {
        return '';
    }

    $value = preg_replace('/\s+/u', ' ', $value) ?: $value;
    return mb_substr($value, 0, 5000);
};

$name = $clean($data, 'name');
$email = $clean($data, 'email');
$company = $clean($data, 'company');
$needs = $clean($data, 'needs');
$consentRaw = $data['consent'] ?? '';
$consent = in_array($consentRaw, ['1', 1, true, 'true', 'on'], true);
$locale = $clean($data, 'locale');

$errors = [];

if ($name === '') {
    $errors['name'] = 'Name is required.';
}

if ($email === '' || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $errors['email'] = 'Valid email is required.';
}

if ($needs === '') {
    $errors['needs'] = 'Please describe the automation goal.';
}

if (!$consent) {
    $errors['consent'] = 'Consent is required to join the pilot.';
}

if ($errors !== []) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'errors' => $errors,
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$submission = [
    'name' => $name,
    'email' => $email,
    'company' => $company,
    'needs' => $needs,
    'consent' => $consent,
    'locale' => $locale,
    'submitted_at' => gmdate('c'),
    'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
];

$logDirectory = BASE_PATH . '/storage';
if (!is_dir($logDirectory)) {
    @mkdir($logDirectory, 0775, true);
}
$logFile = $logDirectory . '/pilot-submissions.log';
$logEntry = json_encode($submission, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL;
@file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);

echo json_encode([
    'success' => true,
    'message' => 'Submission saved.',
], JSON_UNESCAPED_UNICODE);

