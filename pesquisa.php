<?php
header("Content-Type: application/json; charset=UTF-8");
include_once("conexaonormal.php");

$nome = isset($_GET['nome']) ? trim($_GET['nome']) : '';

if ($nome === '') {
    echo json_encode([]);
    exit;
}

$sql = "SELECT nome FROM conta WHERE nome LIKE ? LIMIT 20";
$stmt = $conexao->prepare($sql);
$termo = "%" . $nome . "%";
$stmt->bind_param("s", $termo);
$stmt->execute();
$result = $stmt->get_result();

$usuarios = [];
while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
}

echo json_encode($usuarios);
$stmt->close();
$conexao->close();
?>
