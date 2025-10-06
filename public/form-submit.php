<?php

declare(strict_types=1);

header('Cache-Control: no-store, max-age=0');

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$accept = $_SERVER['HTTP_ACCEPT'] ?? '';
$wantsJson = stripos($accept, 'application/json') !== false;

if ($method !== 'POST') {
    http_response_code(405);
    if ($wantsJson) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => false, 'error' => 'Method not allowed'], JSON_UNESCAPED_UNICODE);
    } else {
        header('Content-Type: text/plain; charset=utf-8');
        echo 'Method not allowed';
    }
    exit;
}

$name = trim((string) ($_POST['name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$company = trim((string) ($_POST['company'] ?? ''));
$automation = trim((string) ($_POST['automation'] ?? ''));
$pilot = isset($_POST['pilot']);

$errors = [];
if ($name === '') {
    $errors['name'] = 'Required field';
}
if ($email === '' || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $errors['email'] = 'Invalid email';
}
if ($automation === '') {
    $errors['automation'] = 'Required field';
}
if (!$pilot) {
    $errors['pilot'] = 'Consent required';
}

if ($errors !== []) {
    http_response_code(422);
    if ($wantsJson) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => false, 'errors' => $errors], JSON_UNESCAPED_UNICODE);
    } else {
        header('Content-Type: text/html; charset=utf-8');
        echo '<!DOCTYPE html><html lang="ru"><head><meta charset="utf-8"><title>Ошибка</title></head><body><p>Не удалось отправить заявку. Вернитесь и попробуйте ещё раз.</p></body></html>';
    }
    exit;
}

$payload = [
    'timestamp' => gmdate('c'),
    'name' => $name,
    'email' => $email,
    'company' => $company,
    'automation' => $automation,
    'pilot' => $pilot,
    'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
];

error_log('nERP pilot form: ' . json_encode($payload, JSON_UNESCAPED_UNICODE));

if ($wantsJson) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => true], JSON_UNESCAPED_UNICODE);
    exit;
}

header('Content-Type: text/html; charset=utf-8');
echo '<!DOCTYPE html><html lang="ru"><head><meta charset="utf-8"><meta http-equiv="refresh" content="2;url=/"><title>Спасибо!</title></head><body><p>Спасибо! Мы свяжемся с вами.</p></body></html>';
