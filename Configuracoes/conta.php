<?php
// INCLUDES
include("../cabecalho.php");
include("../sidebar.php");
include("../conexao.php"); // aqui temos $pdo

if (!isset($_SESSION['user'])) { 
    // Se não estiver logado, redireciona para o login
    // Ajuste o caminho para seu login.php se necessário
    header("Location: ../index.php"); 
    exit;
}

//PEGAR O ID DO USUÁRIO LOGADO (De dentro do array $_SESSION['user'])
$codconta = $_SESSION['user']['codconta'];

//CONSULTAR O USUÁRIO
$stmt = $pdo->prepare("SELECT * FROM conta WHERE codconta = ?");
$stmt->execute([$codconta]);
$usuario = $stmt->fetch();

// Se o usuário não for encontrado por algum motivo
if (!$usuario) {
    echo "Erro: Usuário não encontrado.";
    exit;
}
?>

<script src="../Script/script.js"></script>

<link rel="stylesheet" href="../CSS/config-conta.css">
<title>Schelp - Configurações</title>
</head>
<body onload="pagina_ativa('mandarconfiguracoes')">

<div class="principal">
<link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">

<div class="barra-topo"><h1 class="titulo-schelp">SCHELP<h1></div>

<div class="conteudo">
<?php include("configuracoes-sidebar.php");?>

<div class="conteudo-configuracoes">

<div class="titulo-configuracoes">
    <h2>Conta</h2>
</div>

<div class="perfil-container">
   
    <img src="<?php echo $path2; ?>?t=<?php echo time(); ?>" alt="Foto do perfil" style="width:120px;height:120px;border-radius:50%;object-fit:cover;border:3px solid #9231FF;"><br><br>
   <form id="form-perfil" action="atualizar_perfil.php" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="codconta" value="<?php echo htmlspecialchars($usuario['codconta']); ?>">

    <label for="foto-file" data-tooltip="Editar Foto de perfil!" class="botao-foto">✏️</label>
    <input id="foto-file" type="file" class="foto-file" name="foto" accept="image/png, image/jpeg, image/gif">

    <br>

    <div class="nome-group">
    <input class="nome"  type="text" name="novo_nome" autocomplete="off" class="input" id="novo-nome" placeholder="">
    <label class="nome-label">Alterar Nome</label>
    </div>

    <br><br>
    <button class="salvar-perfil" type="submit" name="salvar_perfil">Salvar Alterações</button>
</form>
</div>

</div>
</div>

<script>
// Espera todo o conteúdo da página carregar (boa prática)
document.addEventListener('DOMContentLoaded', function() {

    // 1. Seleciona o formulário pelo ID que demos a ele
    const formPerfil = document.getElementById('form-perfil');

    // 2. Adiciona um "escutador" para o evento 'submit'
    // Isso "pega" o clique no botão "Salvar Alterações"
    formPerfil.addEventListener('submit', function(event) {
        
        // 3. Previne o envio NORMAL do formulário
        event.preventDefault(); 

        // 4. Mostra o SweetAlert de confirmação
        Swal.fire({
            title: 'Confirmar alterações?',
            text: 'Você tem certeza que deseja salvar os novos dados?',
            icon: 'question', // Ícone de interrogação
            
            showCancelButton: true, // Mostra o botão "Cancelar"
            confirmButtonColor: '#9231FF',
            cancelButtonColor: '#ff3153ff',
            confirmButtonText: 'Sim, salvar!',
            cancelButtonText: 'Cancelar'

        }).then((result) => {
            // 5. Verifica qual botão o usuário clicou
            if (result.isConfirmed) {
                // Se clicou em "Sim, salvar!",
                // o JavaScript envia o formulário manualmente.
                formPerfil.submit();
            }
            // Se clicou em "Cancelar", não faz nada.
        });
    });
});
</script>
<?php require_once("../rodape.php")?>