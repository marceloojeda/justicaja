Create Table Contestacao(
	Id Int Not Null Auto_Increment PRIMARY Key,
	PedidoId Int Not Null,
	PessoaId Int Not Null,
	Tipo Char(10) Not Null,
	DataCadastro Datetime Not Null,
	Texto Text Null,
	FOREIGN Key (PedidoId) REFERENCES PedidoAbertura(Id),
	FOREIGN Key (PessoaId) REFERENCES Pessoa(Id),
	CONSTRAINT UC_Contestacao_Pedido UNIQUE (PedidoId, PessoaId, Tipo)
);

-- Alter Table Contestacao Add Texto Text Null;

Create Table ContestacaoDocs(
	Id Int Not Null Auto_Increment PRIMARY Key,
	ContestacaoId Int Not Null,
	TipoDocumento Varchar(50) Not Null,
	Arquivo Varchar(100) Not Null,
	Observacao Text Null,
	FOREIGN Key (ContestacaoId) REFERENCES Contestacao(Id)
);