Create Table Replica(
	Id Int Not Null Auto_Increment PRIMARY Key,
	PedidoId Int Not Null,
	AutorId Int Not Null,
	DataCadastro Datetime Not Null,
	FOREIGN Key (PedidoId) REFERENCES PedidoAbertura(Id),
	FOREIGN Key (AutorId) REFERENCES PedidoAbertura(PessoaId),
	CONSTRAINT UC_Replica_Autor_Proc UNIQUE (PedidoId, AutorId)
);

Alter Table Replica Add Texto Text Null;

Create Table ReplicaDocs(
	Id Int Not Null Auto_Increment PRIMARY Key,
	ReplicaId Int Not Null,
	TipoDocumento Varchar(50) Not Null,
	Arquivo Varchar(100) Not Null,
	FOREIGN Key (ReplicaId) REFERENCES Replica(Id)
);

Alter Table ReplicaDocs Add Observacao Text Null;