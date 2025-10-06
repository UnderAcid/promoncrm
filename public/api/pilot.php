<?php

declare(strict_types=1);

require __DIR__ . '/../../src/bootstrap.php';

header('Content-Type: application/json; charset=utf-8');

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'error' => 'Method not allowed',
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$name = trim((string) ($_POST['name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$company = trim((string) ($_POST['company'] ?? ''));
$automation = trim((string) ($_POST['automation_goal'] ?? ''));
$participate = isset($_POST['participate']);
$locale = trim((string) ($_POST['locale'] ?? ''));

$isEnglish = stripos($locale, 'en') === 0;
$messages = [
    'name_required' => $isEnglish ? 'Name is required' : 'Имя обязательно',
    'automation_required' => $isEnglish ? 'Describe what you want to automate' : 'Опишите задачу автоматизации',
    'email_invalid' => $isEnglish ? 'Enter a valid email' : 'Укажите корректный email',
    'participate_required' => $isEnglish ? 'Please confirm participation' : 'Необходимо согласие на участие',
    'form_error' => $isEnglish ? 'Please fill in the required fields' : 'Заполните обязательные поля',
];
$errors = [];
if ($name === '') {
    $errors['name'] = $messages['name_required'];
}
if ($automation === '') {
    $errors['automation_goal'] = $messages['automation_required'];
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = $messages['email_invalid'];
}
if (!$participate) {
    $errors['participate'] = $messages['participate_required'];
}

if ($errors !== []) {
    http_response_code(422);
    echo json_encode([
        'error' => $messages['form_error'],
        'fields' => $errors,
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$utms = [
    'utm_source' => trim((string) ($_POST['utm_source'] ?? '')),
    'utm_medium' => trim((string) ($_POST['utm_medium'] ?? '')),
    'utm_campaign' => trim((string) ($_POST['utm_campaign'] ?? '')),
    'utm_content' => trim((string) ($_POST['utm_content'] ?? '')),
    'utm_term' => trim((string) ($_POST['utm_term'] ?? '')),
];
$utms = array_filter($utms, static fn ($value) => $value !== '');

$entry = [
    'timestamp' => gmdate('c'),
    'name' => $name,
    'email' => $email,
    'company' => $company,
    'automation_goal' => $automation,
    'participate' => true,
    'locale' => $locale,
    'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
    'utm' => $utms,
];

$storageDir = BASE_PATH . '/storage';
if (!is_dir($storageDir)) {
    mkdir($storageDir, 0775, true);
}
$logPath = $storageDir . '/pilot-submissions.log';
$logLine = json_encode($entry, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
if ($logLine !== false) {
    file_put_contents($logPath, $logLine . PHP_EOL, FILE_APPEND | LOCK_EX);
}

$message = 'Спасибо! Мы свяжемся с вами в течение дня.';
if (stripos($locale, 'en') === 0) {
    $message = 'Thank you! We will contact you shortly.';
}

echo json_encode([
    'message' => $message,
], JSON_UNESCAPED_UNICODE);
