Create Table Arbitro(
	Id Int Not Null Auto_Increment PRIMARY Key,
	PessoaId Int Not Null,
	DataCadastro Date Not Null,
	Ativo Tinyint(1) Not Null,
	FOREIGN Key (PessoaId) REFERENCES Pessoa(Id),
	CONSTRAINT UC_Arbitro UNIQUE (PessoaId)
);

Create Table ProcessoSolucoes(
	Id Int Not Null Auto_Increment PRIMARY Key,
	ArbitroId Int Not Null,
	ProcessoId Int Not Null,
	DataCadastro Datetime Not Null,
	ArquivoProposta Varchar(50) Not Null,
	NumeroVotos Tinyint(3) Null,
	Vencedor Tinyint(1) Null,
	FOREIGN Key (ProcessoId) REFERENCES Processo(Id),
	FOREIGN Key (ArbitroId) REFERENCES Arbitro(Id),
	CONSTRAINT UC_Solucao_Arbitro UNIQUE (ProcessoId, ArbitroId)
);


--Insert Into ProcessoSolucoes (ArbitroId,ProcessoId,DataCadastro,ArquivoProposta) Values (1,8,Curtime(),'0808.pdf')


Create Table ProcessoVotacao(
	Id Int Not Null Auto_Increment PRIMARY Key,
	ProcessoId Int Not Null,
	SolucaoId Int Not Null,
	PessoaId Int Not Null,
	Data Datetime Not Null,
	FOREIGN Key (ProcessoId) REFERENCES Processo(Id),
	FOREIGN Key (SolucaoId) REFERENCES ProcessoSolucoes(Id),
	FOREIGN Key (PessoaId) REFERENCES Pessoa(Id),
	CONSTRAINT UC_Voto_Solucao UNIQUE (ProcessoId, PessoaId)
);