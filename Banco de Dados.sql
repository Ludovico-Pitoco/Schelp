create table if not exists equipes(
	codequipe int primary key AUTO_INCREMENT,
	nome varchar(80) not null unique
);

create table if not exists conta(
	codconta int primary key AUTO_INCREMENT,
    	nome varchar(80) not null unique,
    	senha varchar(80) not null,
    	email varchar(80) not null unique,
    	foto varchar(80)
);

CREATE TABLE IF NOT EXISTS equipescontas (
    codcontafk int not null,
    codequipefk int not null,
    datas datetime not null,
    PRIMARY KEY (codcontafk, codequipefk),
    FOREIGN KEY (codcontafk) REFERENCES conta(codconta),
    FOREIGN KEY (codequipefk) REFERENCES equipes(codequipe)
);

create table if not exists materiais(
	codmaterial int PRIMARY KEY AUTO_INCREMENT,
    	titulo varchar(80) not null,
    	conteudo varchar(500),
    	arquivo varchar(80) unique,
	remetente int not null,
	codequipefk int not null,
    	FOREIGN KEY(remetente) REFERENCES conta(codconta),
    	FOREIGN KEY(codequipefk) REFERENCES equipes(codequipe)
);

create table if not exists mensagens(
	codmensagem int PRIMARY KEY AUTO_INCREMENT,
    	conteudo varchar(500) not null,
    	datas datetime not null,
	remetente int not null,
    	FOREIGN KEY(remetente) REFERENCES conta(codconta),
    	arquivo varchar(80) not null,
	codequipefk int not null,
    	FOREIGN KEY(codequipefk) REFERENCES equipes(codequipe)
);

create table if not exists comentarios(
	codmensagemfk int not null,
	remetente int not null,
	PRIMARY KEY (codmensagemfk, remetente),
	FOREIGN KEY(codmensagemfk) REFERENCES mensagens(codmensagem),
    	FOREIGN KEY(remetente) REFERENCES conta(codconta)
);

create table if not exists tarefas(
	codtarefa int PRIMARY KEY AUTO_INCREMENT,
    	titulo varchar(80) not null,
    	conteudo varchar(500),
    	arquivo varchar(80) unique,
	remetente int not null,
	codequipefk int not null,
    	FOREIGN KEY(remetente) REFERENCES conta(codconta),
    	FOREIGN KEY(codequipefk) REFERENCES equipes(codequipe)
);

create table if not exists enviartarefa(
	remetente int not null,
	codtarefafk int not null,
    	PRIMARY KEY(remetente, codtarefafk),
	FOREIGN KEY(remetente) REFERENCES conta(codconta),
	FOREIGN KEY(codtarefafk) REFERENCES tarefas(codtarefa),
    	conteudo varchar(500),
    	arquivo varchar(80) not null unique
);