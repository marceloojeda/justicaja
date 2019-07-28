Create Table TabelaPreco(
	Id Int Not Null Auto_Increment PRIMARY Key,
	Codigo Char(10) Not Null,
	Descricao Varchar(300) Not Null,
	Valor Decimal(7,2) Not Null,
	Data Date Not Null,
	Ativo Tinyint(1) Not Null,
	CONSTRAINT UC_TabelaPreco UNIQUE (Codigo)
);

Create Table PedidoAbertura(
	Id Int Not Null Auto_Increment PRIMARY Key,
	PessoaId Int Not Null,
	PromotorId Int Null,
	ReuId Int(11) Null,
	TabelaPrecoId Int(11) Null,
	Razoes Text Not Null,
	RazoesArquivo Varchar(200) Null,
	ContemClausulaArbitral Tinyint(1) Null,
	Data Datetime Not Null,
	Aceito Tinyint(1) Null,
	FOREIGN Key (PessoaId) REFERENCES Pessoa(Id),
	FOREIGN Key (PromotorId) REFERENCES Pessoa(Id),
	FOREIGN Key (ReuId) REFERENCES Pessoa(Id),
	FOREIGN Key (TabelaPrecoId) REFERENCES TabelaPreco(Id)
);

-- Alteração do campo TabelaPrecoId
ALTER TABLE Pedidoabertura CHANGE TabelaPrecoId TabelaPrecoId INT(11) NULL;

-- Inclusão do Reu no cadastro do pedido
Alter Table PedidoAbertura Add (ReuId Int Null, FOREIGN Key (ReuId) REFERENCES Pessoa(Id));

-- Inclusão do arquivo com as razões do autor
ALTER TABLE PedidoAbertura ADD RazoesArquivo Varchar(200) Null;

-- Inclusão do campo CodigoAceite, usado na URL de aceite
ALTER TABLE PedidoAbertura ADD CodigoAceite Varchar(500) Null;

Create Table PedidoAberturaDocs(
	Id Int Not Null Auto_Increment PRIMARY Key,
	PedidoId Int Not Null,
	TipoDocumento Varchar(50) Not Null,
	Arquivo Varchar(100) Not Null,
	Observacao Varchar(600) Null,
	FOREIGN Key (PedidoId) REFERENCES PedidoAbertura(Id)
	-- CONSTRAINT UC_Pedido_Doc UNIQUE (PedidoId, TipoDocumento)
);

-- Inclusão as observações nos documentos do autor
ALTER TABLE PedidoAberturaDocs ADD Observacao Varchar(600) Null;

Create Table PedidoAberturaProvas(
	Id Int Not Null Auto_Increment PRIMARY Key,
	PedidoId Int Not Null,
	TipoProva Varchar(100) Not Null,
	Arquivo Varchar(100) Not Null,
	Observacao Varchar(600) Null,
	FOREIGN Key (PedidoId) REFERENCES PedidoAbertura(Id)
);

-- Inclusão as observações nas provas do autor
ALTER TABLE PedidoAberturaProvas ADD Observacao Varchar(600) Null;


Create Table PedidoAberturaAnalise(
	Id Int Not Null Auto_Increment PRIMARY Key,
	PedidoId Int Not Null,
	DataInicio Datetime Not Null,
	DataConclusao Datetime Null,
	Status Int(2) Not Null,
	Observacao TinyText Null,
	ManifestacaoReu TinyText Null,
	FOREIGN Key (PedidoId) REFERENCES PedidoAbertura(Id),
	CONSTRAINT UC_Pedido_Analise UNIQUE (PedidoId)
);

-- Retira a obrigatoriedade da data de conclusão
ALTER TABLE PedidoAberturaAnalise CHANGE DataConclusao DataConclusao Datetime NULL;

-- Inclusão do campo Observação do Reu durante procedimento de aceite
ALTER TABLE PedidoAberturaAnalise ADD ManifestacaoReu TinyText Null;