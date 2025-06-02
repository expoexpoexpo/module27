<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
</head>
<body>
    <h2>Регистрация</h2>
    <form action="register_handler.php" method="post">
        <label>Логин:</label>
        <input type="text" name="username" required><br><br>

        <label>Пароль:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Зарегистрироваться</button>
    </form>

    <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>
</body>
</html>
