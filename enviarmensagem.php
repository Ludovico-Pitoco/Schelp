<?php
session_start();
include_once('conexaonormal.php');

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['user'];
$codusuario = (int)$usuario['codconta'];
$codequipe = (int)($_POST['codequipe'] ?? 0);
$conteudo = trim($_POST['conteudo'] ?? '');
$arquivos_nomes = [];

if (isset($_FILES['arquivo'])) {
    $totalArquivos = count($_FILES['arquivo']['name']);
    $permitidos = ['jpg','jpeg','png','gif','webp','pdf','doc','docx','xls','xlsx','ppt','pptx','txt','zip','rar'];
    $pasta = "uploads/";

    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }

    for ($i = 0; $i < $totalArquivos; $i++) {
        if ($_FILES['arquivo']['error'][$i] === UPLOAD_ERR_OK) {
            $extensao = strtolower(pathinfo($_FILES['arquivo']['name'][$i], PATHINFO_EXTENSION));
            if (in_array($extensao, $permitidos)) {
                $novoNome = uniqid('arq_', true) . '.' . $extensao;
                move_uploaded_file($_FILES['arquivo']['tmp_name'][$i], $pasta . $novoNome);
                $arquivos_nomes[] = $novoNome;
            }
        }
    }
}

// impede envio vazio
if (empty($conteudo) && empty($arquivos_nomes)) {
    header("Location: equipe.php?codequipe=" . $codequipe);
    exit;
}

// insere cada arquivo individualmente
if (!empty($arquivos_nomes)) {
    foreach ($arquivos_nomes as $arquivo_nome) {
        $stmt = $conexao->prepare("
            INSERT INTO mensagens (conteudo, datas, remetente, arquivo, codequipefk)
            VALUES (?, NOW(), ?, ?, ?)
        ");
        $stmt->bind_param("sisi", $conteudo, $codusuario, $arquivo_nome, $codequipe);
        $stmt->execute();
    }
} else {
    $stmt = $conexao->prepare("
        INSERT INTO mensagens (conteudo, datas, remetente, arquivo, codequipefk)
        VALUES (?, NOW(), ?, '', ?)
    ");
    $stmt->bind_param("sii", $conteudo, $codusuario, $codequipe);
    $stmt->execute();
}

header("Location: equipe.php?codequipe=" . $codequipe);
exit;
?>
