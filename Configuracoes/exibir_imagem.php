<?php
session_start();
include("../conexao.php"); // $pdo

// 1. DEFINIÇÕES DE CAMINHO
// CONFIRA ESTES CAMINHOS!

// Caminho para a pasta SEGURA (onde as fotos são salvas)
// __DIR__ é a pasta atual (ex: /meu_site/config/)
// '/../../uploads/' significa "voltar 2 pastas e entrar em /uploads/"
$pasta_uploads_segura = __DIR__ . '/../../uploads/';

// Caminho para sua imagem PADRÃO (caso o usuário não tenha foto)
// '/../imagens/avatar_padrao.png' significa "voltar 1 pasta e entrar em /imagens/"
$imagem_padrao = __DIR__ . '/../arquivos/imagens/perfil/perfilpadrao.png';


// 2. VERIFICAR LOGIN (Usando a sessão correta: $_SESSION['user'])
if (!isset($_SESSION['user'])) {
    http_response_code(403); // Proibido
    // Se não estiver logado, tenta mostrar uma imagem de acesso negado
    if (file_exists($imagem_padrao)) { // Reutiliza a padrão por segurança
         header("Content-Type: " . mime_content_type($imagem_padrao));
         readfile($imagem_padrao);
    }
    exit;
}

// 3. PEGAR O ID DO USUÁRIO (De dentro do array $_SESSION['user'])
$codconta = $_SESSION['user']['codconta'];

// 4. BUSCAR NOME DO ARQUIVO NO BANCO
// (Lembre-se de criar a coluna 'foto_arquivo' na sua tabela 'conta')
$sql = "SELECT foto_arquivo FROM conta WHERE codconta = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$codconta]);
$nome_arquivo = $stmt->fetchColumn();

// 5. DETERMINAR O CAMINHO FINAL
$caminho_final = $imagem_padrao; // Começa com o padrão

if ($nome_arquivo) { // Se o usuário tiver um nome de foto no banco
    $caminho_usuario = $pasta_uploads_segura . $nome_arquivo;
    if (file_exists($caminho_usuario)) {
        $caminho_final = $caminho_usuario; // Usa a foto do usuário se ela existir
    }
}

// 6. VERIFICAR SE A IMAGEM FINAL (padrão ou do usuário) EXISTE
if (!file_exists($caminho_final)) {
    http_response_code(404); // Not Found
    die("Erro: Arquivo de imagem não encontrado.");
}

// 7. SERVIR A IMAGEM AO NAVEGADOR
$mime_type = mime_content_type($caminho_final);
header("Content-Type: " . $mime_type);
header("Content-Length: " . filesize($caminho_final));

// Limpar qualquer saída anterior (warnings, etc)
ob_clean();
flush();

readfile($caminho_final);
exit;
?>