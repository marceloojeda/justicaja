Create Table PedidoAberturaNotificacao(
	Id Int Not Null Auto_Increment PRIMARY Key,
	PedidoId Int Not Null,
	PessoaId Int Not Null,
	ParteTipo VarChar(50) Not Null,
	Data Datetime Not Null,
	Meio VarChar(50) Not Null,
	EmailDestino VarChar(300) Null,
	Observacao TinyText Null,
	FOREIGN Key (PedidoId) REFERENCES PedidoAbertura(Id),
	FOREIGN Key (PessoaId) REFERENCES Pessoa(Id)
);