function pagina_ativa(currentpage){

const elemento = document.getElementById(currentpage); //Pega o elemento que possui o ID da variável "currentpage", o valor dessa variável é passado ao executar a função.
elemento.classList.toggle("current-page"); //Adiciona à lista de classes desse elemento a classe "current-page", assim ela ganha as propriedades dessa classe CSS.
}