<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['user'];
$codusuario = (int) $usuario['codconta'];

// Verifica se o nome da equipe foi enviado
if (empty($_POST['nomeequipe'])) {
    header("Location: criarequipe.php?erro=camponulo");
    exit;
}

$nomeequipe = trim($_POST['nomeequipe']);

include_once('conexaonormal.php');

// === Inserir equipe de forma segura ===
$stmt = $conexao->prepare("INSERT INTO equipes (nome) VALUES (?)");
$stmt->bind_param("s", $nomeequipe);

if (!$stmt->execute()) {
    header("Location: criarequipe.php?erro=1");
    exit;
}

$codequipe = $conexao->insert_id;
$cargo = 'dono';

// === Inserir relação usuário-equipe ===
$stmt2 = $conexao->prepare("INSERT INTO equipescontas (codcontafk, codequipefk, cargo, datas) VALUES (?, ?, ?, NOW())");
$stmt2->bind_param("iis", $codusuario, $codequipe, $cargo);

if ($stmt2->execute()) {
    header("Location: equipes.php");
    exit;
} else {
    header("Location: criarequipe.php?erro=2");
    exit;
}

// Fecha conexões
$stmt->close();
$stmt2->close();
$conexao->close();
?>
