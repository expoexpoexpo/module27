<?php
session_start();
require 'db.php';

$input = json_decode(file_get_contents('php://input'), true);
$vk_user_id = $input['user_id'] ?? null;

if (!$vk_user_id) {
    echo json_encode(['success' => false]);
    exit;
}

$username = 'vk_' . $vk_user_id;

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
