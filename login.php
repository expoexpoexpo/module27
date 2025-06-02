<?php
session_start();
require 'csrf.php';

$csrf_token = generateCsrfToken();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8" />
<title>Вход</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

<div class="container py-5" style="max-width: 480px;">
    <h2 class="mb-4 text-center">Вход с логином и паролем</h2>

    <form action="login_handler.php" method="post" class="border p-4 rounded bg-white shadow-sm">
        <input type="hidden" name="csrf_token" value="<?=htmlspecialchars($csrf_token)?>" />
        <div class="mb-3">
            <label for="username" class="form-label">Логин</label>
            <input type="text" id="username" name="username" required class="form-control" />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" id="password" name="password" required class="form-control" />
        </div>
        <button type="submit" class="btn btn-primary w-100">Войти</button>
        <button type="button" onclick="window.location.href='register.php'" class="btn btn-secondary w-100 mt-3">Зарегистрироваться</button>
    </form>

    <hr class="my-5" />

    <h3 class="text-center mb-4">Или войдите через VK ID:</h3>
    <div class="d-flex justify-content-center">
        <button id="mock_vk_login" class="btn btn-outline-primary px-4">Авторизоваться через VK</button>
    </div>
</div>

<script>
const csrfToken = '<?= $csrf_token ?>';

document.getElementById('mock_vk_login').addEventListener('click', function() {
    fetch('vk_callback.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({mock: true, csrf_token: csrfToken})
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            window.location.href = 'protected.php';
        } else {
            alert('Ошибка имитации входа через VK: ' + (data.error || 'Unknown'));
        }
    })
    .catch(() => alert('Ошибка имитации входа через VK'));
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
