Create Table Account(
	Id Int Not Null Auto_Increment PRIMARY Key,
	PessoaId Int Not Null,
	UserName Varchar(300) Not Null,
	Password Varchar(100) Not Null,
	DataCadastro Datetime Not Null,
	UserType Char(10) Null,
	CodigoConfirmacao Varchar(40) Null,
	EmailConfirmado Tinyint(1) Not Null Default 0,
	FOREIGN Key (PessoaId) REFERENCES Pessoa(Id),
	CONSTRAINT UC_Account_Pessoa UNIQUE (PessoaId),
	CONSTRAINT UC_Account_Username UNIQUE (UserName)
);

-- Alter Table Account Add CONSTRAINT UC_Account_Username UNIQUE (UserName);
Alter Table Account Add (
CodigoConfirmacao Varchar(40) Null,
EmailConfirmado Tinyint(1) Not Null Default 0);

Create Table AccountRecovery(
	Id Int Not Null Auto_Increment PRIMARY Key,
	AccountId Int Not Null,
	HashData varchar(500) Not Null,
	DataRequisicao Datetime Not Null,
	DataAtendimento Datetime Null,
	FOREIGN Key (AccountId) REFERENCES Account(Id),
	-- CONSTRAINT UC_AccountRecovery_Hash UNIQUE (HashData)
);

-- Alter Table Account Add UserType Char(10) Null;