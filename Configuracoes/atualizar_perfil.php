<?php
// 1. INICIALIZAÇÃO
session_start();
include("../conexao.php"); // $pdo

// 2. VERIFICAR LOGIN
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php"); // Redireciona para o login
    exit;
}

// 3. OBTER DADOS DO USUÁRIO LOGADO
$codconta = $_SESSION['user']['codconta'];

// 4. VERIFICAR SE O FORMULÁRIO FOI ENVIADO (MÉTODO POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- DEFINIÇÕES E VARIÁVEIS DE CONTROLE ---
    
    // Caminho para a pasta de uploads (copiado do seu script de foto)
    $pasta_uploads_segura = __DIR__ . '/../../uploads/'; 
    
    // Pegar os dados (mesmo que venham vazios)
    $novo_nome = trim($_POST['novo_nome']);
    $arquivo_foto = $_FILES['foto'];

    // Para controlar o redirecionamento
    $sucesso_nome = false;
    $sucesso_foto = false;
    $erros_foto = [];
    $erro_nome = false;

    
    // --- LÓGICA 1: ATUALIZAR O NOME ---
    // Só executa se o campo 'novo_nome' NÃO estiver vazio
    if (!empty($novo_nome)) {
        try {
            $sql_nome = "UPDATE conta SET nome = ? WHERE codconta = ?";
            $stmt_nome = $pdo->prepare($sql_nome);
            
            if ($stmt_nome->execute([$novo_nome, $codconta]) && $stmt_nome->rowCount() > 0) {
                // Atualiza o nome na sessão também!
                $_SESSION['user']['nome'] = $novo_nome;
                $sucesso_nome = true;
            }
        } catch (PDOException $e) {
            $erro_nome = true;
            // error_log($e->getMessage()); // Para depuração
        }
    }

    
    // --- LÓGICA 2: ATUALIZAR A FOTO ---
    // Só executa se um arquivo foi enviado E não houve erro de upload (error == 0)
    if (isset($arquivo_foto) && $arquivo_foto['error'] == UPLOAD_ERR_OK) {
        
        // 5. VALIDAR TAMANHO (max 5MB)
        $max_size = 5 * 1024 * 1024; 
        if ($arquivo_foto['size'] > $max_size) {
            $erros_foto[] = "tamanho";
        }

        // 6. VALIDAR TIPO (MIME Type)
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $arquivo_foto['tmp_name']);
        finfo_close($finfo);
        
        $extensoes_permitidas = [
            'image/jpeg' => '.jpg',
            'image/png'  => '.png',
            'image/gif'  => '.gif'
        ];

        if (!array_key_exists($mime_type, $extensoes_permitidas)) {
            $erros_foto[] = "tipo";
        }

        // Se não houve erros de validação da foto, continua...
        if (empty($erros_foto)) {
            
            // 7. EXCLUIR FOTO ANTIGA
            try {
                $stmt_antiga = $pdo->prepare("SELECT foto_arquivo FROM conta WHERE codconta = ?");
                $stmt_antiga->execute([$codconta]);
                $foto_antiga = $stmt_antiga->fetchColumn();
                
                if ($foto_antiga && file_exists($pasta_uploads_segura . $foto_antiga)) {
                    @unlink($pasta_uploads_segura . $foto_antiga); // Apaga o arquivo antigo
                }
            } catch (PDOException $e) {
                // Não é um erro fatal, mas bom registrar
                // error_log("Erro ao buscar foto antiga: " . $e->getMessage());
            }

            // 8. CRIAR NOME ÚNICO E MOVER O ARQUIVO NOVO
            $extensao = $extensoes_permitidas[$mime_type];
            $novo_nome_arquivo = "user_" . $codconta . "_" . uniqid() . $extensao;
            $caminho_completo = $pasta_uploads_segura . $novo_nome_arquivo;

            if (move_uploaded_file($arquivo_foto['tmp_name'], $caminho_completo)) {
                
                // 9. ATUALIZAR O BANCO DE DADOS
                try {
                    $sql_foto = "UPDATE conta SET foto_arquivo = ? WHERE codconta = ?";
                    $stmt_foto = $pdo->prepare($sql_foto);
                    
                    if ($stmt_foto->execute([$novo_nome_arquivo, $codconta])) {
                        $sucesso_foto = true;
                    } else {
                        $erros_foto[] = "db";
                    }
                } catch (PDOException $e) {
                    $erros_foto[] = "db";
                    // error_log($e->getMessage());
                }
            } else {
                // Erro ao mover (permissão da pasta?)
                $erros_foto[] = "mover";
            }
        } // fim 'if (empty($erros_foto))'
    } // fim 'if (isset($arquivo_foto) ...)'

    
    // --- LÓGICA 3: REDIRECIONAMENTO FINAL ---
    
    // Monta a URL de volta para 'conta.php' com os parâmetros de status
    $query_params = [];
    
    if ($sucesso_nome) {
        $query_params[] = "sucesso_nome=1";
    }
    if ($sucesso_foto) {
        $query_params[] = "sucesso_foto=1";
    }
    if ($erro_nome) {
        $query_params[] = "erro_nome=1";
    }
    if (!empty($erros_foto)) {
        // Envia um erro genérico para a foto (pode ser 'tamanho', 'tipo', 'db', etc.)
        $query_params[] = "erro_foto=1"; 
    }

    $redirect_url = "conta.php";
    if (!empty($query_params)) {
        $redirect_url .= "?" . implode("&", $query_params);
    }
    
    header("Location: " . $redirect_url);
    exit;

} else {
    // Se alguém tentar acessar o script diretamente (sem POST)
    header("Location: conta.php");
    exit;
}
?>