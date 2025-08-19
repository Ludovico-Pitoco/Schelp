<?php
session_start();
$errors = [];
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta</title>
    <link rel="stylesheet" href="css/Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container" id="signup">
        <h1 class="form-title">Criar Conta</h1>

        <?php
        if (isset($errors['user_exist'])) {
            echo '<div class="error-main">
                    <p>' . $errors['user_exist'] . '</p>
                  </div>';
            unset($errors['user_exist']);
        }
        ?>

        <form method="POST" action="user-account.php">
            <!-- Nome -->
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="name" id="name" placeholder="Nome" required>
                <?php
                if (isset($errors['name'])) {
                    echo '<div class="error"><p>' . $errors['name'] . '</p></div>';
                    unset($errors['name']);
                }
                ?>
            </div>

            <!-- Email -->
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <?php
                if (isset($errors['email'])) {
                    echo '<div class="error"><p>' . $errors['email'] . '</p></div>';
                    unset($errors['email']);
                }
                ?>
            </div>

            <!-- Senha -->
            <div class="input-group password">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Senha" required>
                <i id="eye" class="fa fa-eye"></i>
                <?php
                if (isset($errors['password'])) {
                    echo '<div class="error"><p>' . $errors['password'] . '</p></div>';
                    unset($errors['password']);
                }
                ?>
            </div>

            <!-- Confirma Senha -->
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="confirm_password" placeholder="Confirma Senha" required>
                <?php
                if (isset($errors['confirm_password'])) {
                    echo '<div class="error"><p>' . $errors['confirm_password'] . '</p></div>';
                    unset($errors['confirm_password']);
                }
                ?>
            </div>

            <input type="submit" class="btn" value="Registrar" name="signup">
        </form>

        <div class="links">
            <a href="login.php">Login</a>
        </div>
    </div>

    <script src="script/Login.js"></script>
</body>

</html>

<?php
if (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}
?>
