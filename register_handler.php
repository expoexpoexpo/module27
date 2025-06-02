<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (strlen($username) < 3 || strlen($password) < 4) {
        die('Логин должен быть от 3 символов, пароль — от 4.');
    }

    // Проверка, есть ли такой логин
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->fetch()) {
        die("Пользователь с таким логином уже существует.");
    }

    // Хешируем пароль
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Вставляем в БД
    $stmt = $pdo->prepare("INSERT INTO users (username, password_hash, role) VALUES (?, ?, 'user')");
    $stmt->execute([$username, $password_hash]);

    echo "Регистрация успешна! <a href='login.php'>Войти</a>";
} else {
    echo "Неверный метод запроса.";
}
?>
