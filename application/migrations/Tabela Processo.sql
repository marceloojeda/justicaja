Create Table Processo(
	Id Int Not Null Auto_Increment PRIMARY Key,
	PedidoId Int Not Null,
	Numero Char(10) Null,
	FaseAtualId Int Not Null,
	FaseAnteriorId Int Null,
	DataAbertura DateTime Not Null,
	Julgado Tinyint(1) Not Null,
	DataJulgamento DateTime Null,
	SolucaoId Int Null,
	NumeroVotos Smallint(5) Not Null,
	Sintese MediumText NULL,
	StatusLoad Tinyint(1) Not Null Default 1,
	FOREIGN Key (PedidoId) REFERENCES PedidoAbertura(Id),
	FOREIGN Key (FaseAtualId) REFERENCES FaseProcessual(Id),
	FOREIGN Key (FaseAnteriorId) REFERENCES FaseProcessual(Id)
	-- FOREIGN Key (SolucaoId) REFERENCES ProcessoSolucoes(Id)
);

Alter Table Processo Add (
	Numero Char(10) Null, 
	PedidoId Int Null,
	Sintese MediumText NULL,
	StatusLoad Tinyint(1) Not Null Default 1,
	FOREIGN Key (PedidoId) REFERENCES PedidoAbertura(Id));

Create Table ProcessoPartes(
	Id Int Not Null Auto_Increment PRIMARY Key,
	ProcessoId Int Not Null,
	AutorId Int Not Null,
	ReuId Int Not Null,
	FOREIGN Key (ProcessoId) REFERENCES Processo(Id),
	FOREIGN Key (AutorId) REFERENCES Pessoa(Id),
	FOREIGN Key (ReuId) REFERENCES Pessoa(Id),
	CONSTRAINT UC_Processo UNIQUE (ProcessoId, AutorId, ReuId)
);

Create Table ProcessoPecas(
	Id Int Not Null Auto_Increment PRIMARY Key,
	ProcessoId Int Not Null,
	PeticaoInicial MediumBlob Not Null,
	Replica MediumBlob Null,
	Treplica MediumBlob Null,
	FOREIGN Key (ProcessoId) REFERENCES Processo(Id)
);

Create Table FaseProcessual(
	Id Int Not Null Auto_Increment PRIMARY Key,
	Codigo Char(8) Not Null,
	Nome Varchar(50) Not Null,
	Descricao Varchar(300) Not Null,
	Prazo Int Not Null,
	Ativo Tinyint(1) Not Null,
	CONSTRAINT UC_Fase UNIQUE (Codigo)
);

Create Table ProcessoFases(
	Id Int Not Null Auto_Increment PRIMARY Key,
	ProcessoId Int Not Null,
	FaseId Int Not Null,
	DataEntrada Date Not Null,
	DataLimite Date Not Null,
	DataSaida Date Null,
	FaseAtual Tinyint(1) Not Null,
	FOREIGN Key (ProcessoId) REFERENCES Processo(Id),
	FOREIGN Key (FaseId) REFERENCES FaseProcessual(Id)
);

ALTER TABLE ProcessoFases 
DROP INDEX FaseId,
Drop Index UC_ProcessoFase,
Add FOREIGN Key (ProcessoId) REFERENCES Processo(Id),
Add FOREIGN Key (FaseId) REFERENCES FaseProcessual(Id);


Create Table ProcessoPrazo(
	Id Int Not Null Auto_Increment PRIMARY Key,
	ProcessoId Int Not Null,
	Prazo Tinyint(1) Not Null,
	Percorrido Tinyint(1) Not Null,
	UltimaAtualizacao Date Not Null,
	FOREIGN Key (ProcessoId) REFERENCES Processo(Id)
);

/*
Insert Into FaseProcessual (Codigo,Nome,Descricao,Prazo,Ativo) Values ('STEP0', 'Início do Processo', 'Inserção da
petição no sistema, podendo propor acordo.', 0, 1);

Insert Into FaseProcessual (Codigo,Nome,Descricao,Prazo,Ativo) 
Values ('STEP1', 'Notificação do Réu', 'Comunica o início do processo ao réu
via e-mail, AR ou outra forma, quando poderá aceitar ou não a arbitragem, ou
propor acordo.', 7, 1);

Insert Into FaseProcessual (Codigo,Nome,Descricao,Prazo,Ativo) Values ('STEP2', 'Contestação', 'Após a aceitação
da arbitragem, prazo para contestação.', 5, 1);

Insert Into FaseProcessual (Codigo,Nome,Descricao,Prazo,Ativo) Values ('STEP3', 'Notificação do Autor', 'Comunica
envio da contestação.', 1, 1);

Insert Into FaseProcessual (Codigo,Nome,Descricao,Prazo,Ativo) Values ('STEP4', 'Réplica', 'Opcional. Sistema
pergunta ao autor se pretende apresentar. Se não apresentar, o processo vai
direto a julgamento.', 2, 1);

Insert Into FaseProcessual (Codigo,Nome,Descricao,Prazo,Ativo) Values ('STEP5', 'Notificação do Réu', 'Informa ao
réu se houver réplica.', 1, 1);

Insert Into FaseProcessual (Codigo,Nome,Descricao,Prazo,Ativo) Values ('STEP6', 'Tréplica', 'Prazo final. Segue
para julgamento.', 2, 1);

Insert Into FaseProcessual (Codigo,Nome,Descricao,Prazo,Ativo) Values ('STEP7', 'Julgamento - Abertura', 'Prazo
para árbitros proporem a primeira sentença.', 5, 1);

Insert Into FaseProcessual (Codigo,Nome,Descricao,Prazo,Ativo) Values ('STEP8', 'Julgamento - Sentença', 'Prazo
para votar na primeira sentença ou apresentar outra. Se o prazo se esgotar sem
outras sentenças ou se +50% votarem na primeira, o processo é concluído.', 3,
1);

Insert Into FaseProcessual (Codigo,Nome,Descricao,Prazo,Ativo) Values ('STEP9', 'Julgamento - Outras Sentenças',
'Prazo final de votação ou apresentação de sentenças. Contagem começa a partir
da apresentação da segunda sentença.', 2, 1);

Insert Into FaseProcessual (Codigo,Nome,Descricao,Prazo,Ativo) Values
('STEP10', 'Resultado', 'Sistema gera decisão final com relatório de votação e
possibilidade de confirmação de autenticidade.', 0, 1);
*/