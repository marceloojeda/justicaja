Create Table Treplica(
	Id Int Not Null Auto_Increment PRIMARY Key,
	PedidoId Int Not Null,
	ReuId Int Not Null,
	DataCadastro Datetime Not Null,
	Texto Text Null,
	FOREIGN Key (PedidoId) REFERENCES PedidoAbertura(Id),
	FOREIGN Key (ReuId) REFERENCES PedidoAbertura(ReuId),
	CONSTRAINT UC_Treplica_Reu_Proc UNIQUE (PedidoId, ReuId)
);

-- Alter Table Treplica Add Texto Text Null;

Create Table TreplicaDocs(
	Id Int Not Null Auto_Increment PRIMARY Key,
	TreplicaId Int Not Null,
	TipoDocumento Varchar(50) Not Null,
	Arquivo Varchar(100) Not Null,
	Observacao Text Null,
	FOREIGN Key (TreplicaId) REFERENCES Treplica(Id)
	-- CONSTRAINT UC_Contestacao_Doc UNIQUE (ReplicaId, TipoDocumento)
);

-- Alter Table TreplicaDocs Add Observacao Text Null;