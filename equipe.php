<?php
require_once("cabecalho.php");
include_once("conexaonormal.php");

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['codequipe']) || !is_numeric($_GET['codequipe'])) {
    header("Location: equipes.php");
    exit;
}

$codequipe = (int)$_GET['codequipe'];
$usuario = $_SESSION['user'];
$codusuario = (int)$usuario['codconta'];

// Verifica se pertence à equipe
$check = $conexao->prepare("SELECT * FROM equipescontas WHERE codequipefk = ? AND codcontafk = ?");
$check->bind_param("ii", $codequipe, $codusuario);
$check->execute();
$result = $check->get_result();
if ($result->num_rows === 0) {
    header("Location: equipes.php?erro=sem_acesso");
    exit;
}
?>

<link rel="stylesheet" href="CSS/chat.css?v=<?php echo time(); ?>">
<title>Schelp - Equipe</title>
</head>
<body onload="scrollChat()">

<div class="principal">
    <?php include("sidebar.php"); ?>
    <div class="barra-topo"><h1 class="titulo-schelp">SCHELP</h1></div>

    <div class="chat-container">

    <!-- Navbar da Equipe -->
    <div class="navbar-equipe">
        <div class="navbar-info">
            <h2 class="nome-equipe">
            <?php
                // Busca o nome da equipe no banco
                $stmtEq = $conexao->prepare("SELECT nome FROM equipes WHERE codequipe = ?");
                $stmtEq->bind_param("i", $codequipe);
                $stmtEq->execute();
                $resEq = $stmtEq->get_result()->fetch_assoc();
                echo htmlspecialchars($resEq['nome']);
            ?>
        </h2>
    </div>
        <div class="navbar-acoes">
            <button type="button" id="abrirModal" class="btn-navbar">
                <svg class="icon-person-plus" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" aria-hidden="true" focusable="false">
                    <g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1">
                    <!-- círculo de fundo (opcional) -->
                    <circle cx="24" cy="24" r="23" fill="transparent"></circle>

                    <!-- cabeça -->
                    <circle cx="18" cy="15" r="5" fill="currentColor"></circle>

                    <!-- tronco/ombros -->
                    <path d="M10 33c0-4.418 3.582-8 8-8h6c4.418 0 8 3.582 8 8v1H10v-1z" fill="currentColor" opacity="0.95"></path>

                    <!-- sinal de + (à direita) -->
                    <g transform="translate(31,11)">
                    <rect x="7" y="1" width="2.6" height="12" rx="1" fill="currentColor"></rect>
                    <rect x="1" y="7" width="12" height="2.6" rx="1" fill="currentColor"></rect>
                    <!-- opcional: círculo ao redor do + -->
                    <circle cx="7" cy="7" r="9" stroke="currentColor" stroke-width="0" fill="transparent"></circle>
                    </g>
                </g>
            </svg>
            </button>
            <button type="button" class="btn-navbar-sair">
                <a class="btn-voltar" href="equipes.php">
                <svg class="icon-exit-team" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                    <!-- Porta -->
                    <path d="M10 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5"/>
                    <!-- Setinha saindo -->
                    <polyline points="17 16 22 12 17 8"/>
                    <line x1="22" y1="12" x2="10" y2="12"/>
                </svg>
                </a>
            </button>
    </div>
    </div>


        <!-- Mensagens -->
        <div class="chat-messages" id="chat-messages">
            <?php
            $stmt = $conexao->prepare("
                SELECT m.*, c.nome AS remetente_nome
                FROM mensagens m
                JOIN conta c ON c.codconta = m.remetente
                WHERE m.codequipefk = ?
                ORDER BY m.datas ASC
            ");
            $stmt->bind_param("i", $codequipe);
            $stmt->execute();
            $mensagens = $stmt->get_result();

            while ($msg = $mensagens->fetch_assoc()) {
    $classe = ($msg['remetente'] == $codusuario) ? 'self' : 'other';
    echo "<div class='message $classe'>";
    echo "<div class='msg-info'>{$msg['remetente_nome']}</div>";

    // Conteúdo da mensagem
    if (!empty($msg['conteudo'])) {
        echo "<div>{$msg['conteudo']}</div>";
    }

    // Arquivo anexado
    if (!empty($msg['arquivo'])) {
        $extensao = strtolower(pathinfo($msg['arquivo'], PATHINFO_EXTENSION));
        $img_ext = ['jpg','jpeg','png','gif','webp'];

        if (in_array($extensao, $img_ext)) {
            // Exibe imagem como miniatura
            echo "<div><img src='uploads/{$msg['arquivo']}' alt='Imagem' style='max-width:150px; max-height:150px; border-radius:10px;'></div>";
        } else {
            // Exibe arquivo com ícone e link
            echo "<div class='chat-arquivo'>
                    <span>📎 {$msg['arquivo']}</span><br>
                    <a href='uploads/{$msg['arquivo']}' download>💾 Salvar como...</a>
                  </div>";
        }
    }

    echo "</div>";
}

            ?>
        </div>

        <!-- Formulário de envio -->
        <!-- Pré-visualização de anexos -->
<div id="preview-container" class="preview-container"></div>

<!-- Formulário -->
<form class="form-mensagem" action="enviarmensagem.php" method="POST" enctype="multipart/form-data" id="formMensagem">
    <input type="hidden" name="codequipe" value="<?php echo $codequipe; ?>">

    <!-- Container dos previews -->
    <div id="preview-container"></div>

    <textarea name="conteudo" id="conteudo" placeholder="Digite sua mensagem..."></textarea>

    <label id="anexo" for="arquivo">📎</label>
    <input type="file" name="arquivo[]" id="arquivo" multiple>

    <button class="send" type="submit">Enviar</button>
</form>

<!-- Tela de pesquisa -->
<div id="modalPesquisa" class="modal-pesquisa">
  <div class="modal-content">
    <h3 align="center">Convidar para a Equipe</h3>
    <input type="text" id="campoBusca" placeholder="Digite o nome..." autocomplete="off">
    <div id="resultadosBusca"></div>
    <button id="fecharModal" type="button">Fechar</button>
  </div>
</div>

<script>
const inputArquivo = document.getElementById('arquivo');
const preview = document.getElementById('preview-container');

inputArquivo.addEventListener('change', () => {
    preview.innerHTML = ''; // limpa previews anteriores
    const file = inputArquivo.files[0];
    if (!file) return;

    const ext = file.name.split('.').pop().toLowerCase();
    const isImage = ['jpg','jpeg','png','gif','webp'].includes(ext);

    if (isImage) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.className = 'preview-img';
        preview.appendChild(img);
    } else {
        const div = document.createElement('div');
        div.className = 'preview-file';
        div.innerHTML = `📎 ${file.name}`;
        preview.appendChild(div);
    }
});
</script>


    </div>
</div>

<script>
function scrollChat() {
    const chat = document.getElementById('chat-messages');
    chat.scrollTop = chat.scrollHeight;
}

// Rola o chat ao carregar a página
window.onload = scrollChat;

// Rola automaticamente quando o usuário envia uma mensagem
const form = document.querySelector('.form-mensagem');
form.addEventListener('submit', () => {
    setTimeout(scrollChat, 100); // espera o PHP processar e renderizar
});
</script>

<script>
const fileInput = document.getElementById('arquivo');
const previewContainer = document.getElementById('preview-container');
const formMensagem = document.getElementById('formMensagem');
const textarea = document.getElementById('conteudo');
let selectedFiles = [];

fileInput.addEventListener('change', (event) => {
    const files = Array.from(event.target.files);
    selectedFiles = selectedFiles.concat(files);
    renderPreviews();
    event.target.value = ""; // permite re-selecionar o mesmo arquivo
});

function renderPreviews() {
    previewContainer.innerHTML = '';
    selectedFiles.forEach((file, index) => {
        const item = document.createElement('div');
        item.className = 'preview-item';

        if (file.type.startsWith('image/')) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            item.appendChild(img);
        } else {
            const span = document.createElement('span');
            span.textContent = file.name;
            item.appendChild(span);
        }

        const removeBtn = document.createElement('button');
        removeBtn.textContent = '×';
        removeBtn.onclick = () => {
            selectedFiles.splice(index, 1);
            renderPreviews();
        };
        item.appendChild(removeBtn);

        previewContainer.appendChild(item);
    });
}

formMensagem.addEventListener('submit', async (e) => {
    e.preventDefault();

    if (textarea.value.trim() === '' && selectedFiles.length === 0) {
        alert('Digite uma mensagem ou anexe um arquivo antes de enviar.');
        return;
    }

    const formData = new FormData(formMensagem);
    selectedFiles.forEach(file => formData.append('arquivo[]', file));

    await fetch('enviarmensagem.php', {
        method: 'POST',
        body: formData
    });

    textarea.value = '';
    selectedFiles = [];
    renderPreviews();
    setTimeout(() => location.reload(), 200);
});
</script>

<script>
const modal = document.getElementById('modalPesquisa');
const abrirBtn = document.getElementById('abrirModal');
const fecharBtn = document.getElementById('fecharModal');
const campoBusca = document.getElementById('campoBusca');
const resultados = document.getElementById('resultadosBusca');

// Abrir/fechar modal
abrirBtn.onclick = () => modal.style.display = 'flex';
fecharBtn.onclick = () => modal.style.display = 'none';

// Busca dinâmica
campoBusca.addEventListener('input', function() {
  const termo = campoBusca.value.trim();
  if (termo === '') {
    resultados.innerHTML = '';
    return;
  }

  fetch('pesquisa.php?nome=' + encodeURIComponent(termo))
    .then(response => response.json())
    .then(data => {
      if (data.length === 0) {
        resultados.innerHTML = '<div>Nenhum resultado encontrado</div>';
        return;
      }
      resultados.innerHTML = data
        .map(item => `
            <div class="resultado-item">
                <span>${item.nome}</span>
                <button class="btn-notificar" onclick="enviarNotificacao(${item.codconta})">Enviar Convite</button>
            </div>
            `)
        .join('');

    })
    .catch(err => {
      resultados.innerHTML = '<div>Erro ao buscar usuários</div>';
      console.error(err);
    });
});
</script>


<?php require_once("rodape.php"); ?>
