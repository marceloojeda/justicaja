Create Table Pessoa(
	Id Int Not Null Auto_Increment PRIMARY Key,
	Nome Varchar(300) Not Null,
	Endereco Varchar(500) Not Null,
	Numero Char(10) Null,
	Bairro Varchar(200) Not Null,
	Cidade Varchar(300) Not Null,
	UF Char(2) Not Null,
	ComplementoEndereco Varchar(500) Null,
	CEP Char(10) Null,
	Email Varchar(300) Not Null,
	FoneFixo Varchar(20) Null,
	Celular Varchar(20) Null,
	Tipo Varchar(20) Not Null,
	CpfCnpj Varchar(20) Not Null,
	DocumentoTipo Varchar (50) Null,
	DocumentoNumero Varchar(50) Null,
	DataCadastro DateTime Not Null
);

Alter Table Pessoa Add (
	Endereco Varchar(500) Not Null,
	Numero Char(10) Null,
	Bairro Varchar(200) Not Null,
	Cidade Varchar(300) Not Null,
	UF Char(2) Not Null,
	ComplementoEndereco Varchar(500) Null,
	CEP Char(10) Null,
	Email Varchar(300) Not Null,
	FoneFixo Varchar(20) Null,
	Celular Varchar(20) Null
);