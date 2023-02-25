<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $users = [];

    if (file_exists('users.txt')) {
        $users = unserialize(file_get_contents('users.txt'));
    }

    if (array_key_exists($username, $users)) {
        $_SESSION['error'] = 'Este nome de usuário já está sendo utilizado.';
        header('Location: register.php');
        exit;
    }

    $users[$username] = $password;

    file_put_contents('users.txt', serialize($users));

    $_SESSION['success'] = 'Usuário cadastrado com sucesso!';
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
</head>
<body>
    <h1>Cadastro</h1>

    <?php if (isset($_SESSION['error'])): ?>
        <p><?php echo $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <p><?php echo $_SESSION['success']; ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <form method="post">
        <label for="username">Nome de usuário:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
