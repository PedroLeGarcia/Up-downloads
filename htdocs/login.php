<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $users = [];

    if (file_exists('users.txt')) {
        $users = unserialize(file_get_contents('users.txt'));
    }

    if (!array_key_exists($username, $users) || !password_verify($password, $users[$username])) {
        $_SESSION['error'] = 'Nome de usuário ou senha inválidos.';
        header('Location: login.php');
        exit;
    }

    $_SESSION['username'] = $username;
    header('Location: upload.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php if (isset($_SESSION['error'])): ?>
        <p><?php echo $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form method="post">
        <label for="username">Nome de usuário:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Entrar</button>
    </form>
</body>
</html>
