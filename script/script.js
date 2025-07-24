function pagina_ativa(currentpage){ //Função para destacar a página atual

const elemento = document.getElementById(currentpage); //Pega o elemento que possui o ID da variável "currentpage", o valor dessa variável é passado ao executar a função.
elemento.classList.toggle("current-page"); //Adiciona à lista de classes desse elemento a classe "current-page", assim ela ganha as propriedades dessa classe CSS.
}



function alternarDropdown() { //Função para ativar o dropdown do perfil
  const menu = document.getElementById('menu-perfil'); //Pega o menu dropdown
  menu.style.display = (menu.style.display === 'flex') ? 'none' : 'flex';// Ativa ou desativa o dropdown
  //               Condição                      Se verdadeiro    Se falso 
}

document.addEventListener('click', function(event) { //Função para fechar o dropdown caso o usuário aperte em outro lugar
    const menu = document.getElementById('menu-perfil'); //Pega o menu dropdown
    const ativador = document.getElementById('dropdown-perfil-ativar'); //Pega o ativador do menu dropdown (foto de perfil)

    
    if (!menu.contains(event.target) && !ativador.contains(event.target)) { // Se o clique NÃO for no menu nem no botão ativador
      menu.style.display = 'none'; //Fecha o menu dropdown
    }
});