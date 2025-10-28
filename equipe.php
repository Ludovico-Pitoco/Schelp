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

    <label for="arquivo">📎</label>
    <input type="file" name="arquivo[]" id="arquivo" multiple>

    <button type="submit">Enviar</button>
</form>




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
const form = document.getElementById('formMensagem');
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

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    if (textarea.value.trim() === '' && selectedFiles.length === 0) {
        alert('Digite uma mensagem ou anexe um arquivo antes de enviar.');
        return;
    }

    const formData = new FormData(form);
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



<?php require_once("rodape.php"); ?>
