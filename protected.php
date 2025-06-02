<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$is_vk_user = isset($_SESSION['role']) && $_SESSION['role'] === 'vk_user';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Защищённая страница</title>
</head>
<body>

<h1>Добро пожаловать на защищённую страницу!</h1>

<?php if ($is_vk_user): ?>
    <!-- Показываем только картинку для пользователей VK -->
    <img src="vk_only_image.png" alt="Картинка для пользователей VK" style="max-width: 300px;">
<?php else: ?>
    <!-- Показываем только текст для обычных пользователей -->
    <p>Этот текст виден только авторизованным пользователям, вошедшим через логин и пароль.</p>
<?php endif; ?>

</body>
</html>
