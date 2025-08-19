<?php
require_once 'conexao.php';
session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $name = trim($_POST['name']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $created_at = date('Y-m-d H:i:s'); // Não há coluna de data na tabela 'conta', mas você pode usar se quiser

    // Validações
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Formato de email inválido';
    }
    if (empty($name)) {
        $errors['name'] = 'Nome é obrigatório';
    }
    if (strlen($password) < 8) {
        $errors['password'] = 'Senha deve ter pelo menos 8 caracteres';
    }
    if ($password !== $confirmPassword) {
        $errors['confirm_password'] = 'Senha não coincide';
    }

    // Verifica se email ou nome já existem
    $stmt = $pdo->prepare("SELECT * FROM conta WHERE email = :email OR nome = :nome");
    $stmt->execute(['email' => $email, 'nome' => $name]);
    if ($stmt->fetch()) {
        $errors['user_exist'] = 'Email ou nome já cadastrado';
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: register.php');
        exit();
    }

    // Insere no banco
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("INSERT INTO conta (nome, senha, email) VALUES (:nome, :senha, :email)");
    $stmt->execute([
        'nome' => $name,
        'senha' => $hashedPassword,
        'email' => $email
    ]);

    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signin'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Formato de email inválido';
    }
    if (empty($password)) {
        $errors['password'] = 'Senha é obrigatória';
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: index.php');
        exit();
    }

    // Consulta usuário
    $stmt = $pdo->prepare("SELECT * FROM conta WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['senha'])) {
        $_SESSION['user'] = [
            'codconta' => $user['codconta'],
            'nome' => $user['nome'],
            'email' => $user['email'],
            'foto' => $user['foto'] ?? null
        ];

        header('Location: inicio.php');
        exit();
    } else {
        $errors['login'] = 'Email ou senha inválidos';
        $_SESSION['errors'] = $errors;
        header('Location: index.php');
        exit();
    }
}
