<?php
session_start();
require 'csrf.php';

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['csrf_token']) || !validateCsrfToken($input['csrf_token'])) {
    echo json_encode(['success' => false, 'error' => 'Invalid CSRF token']);
    exit;
}

if (!isset($input['mock']) || !$input['mock']) {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
    exit;
}

$user_id = 123456;
$username = 'vk_user_' . $user_id;

require 'db.php';

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if (!$user) {
    $stmt = $pdo->prepare("INSERT INTO users (username, role) VALUES (?, 'vk_user')");
    $stmt->execute([$username]);
    $user_id_in_db = $pdo->lastInsertId();
} else {
    $user_id_in_db = $user['id'];
}

$_SESSION['user_id'] = $user_id_in_db;
$_SESSION['role'] = 'vk_user';

echo json_encode(['success' => true]);
exit;
