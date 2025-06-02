<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header('Location: protected.php');
        exit;
    } else {
        $log = "[" . date('Y-m-d H:i:s') . "] Ошибка входа для пользователя: $username\n";
        file_put_contents('auth_failures.log', $log, FILE_APPEND);

        echo "Неверный логин или пароль. <a href='login.php'>Попробовать снова</a>";
    }
} else {
    echo "Неверный метод запроса.";
}
?>
