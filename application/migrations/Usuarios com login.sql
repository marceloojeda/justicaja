/* Relação de usuarios com login */
SELECT p.Id as PessoaId, p.Nome,
a.Id AccountId, a.UserName, a.EmailConfirmado, a.UserType
FROM pessoa p
join account a on p.Id = a.PessoaId

-- Update Account Set UserName = 'dev', Password = '1020', EmailConfirmado = 1, UserType = 'Adm' Where Id = 3;

/* Lista de Pedidos */
SELECT reu.Id as ReuId, reu.Nome as Reu, 
usu.Id as AccountId, usu.UserName as Login, usu.Password,
pa.Id as PedidoId, pa.Data, pa.Aceito
from pedidoabertura pa
join pessoa reu on pa.ReuId = reu.Id
join account usu on reu.Id = usu.PessoaId

/* Limpa Tabelas do Banco */
set foreign_key_checks = 0;
TRUNCATE TABLE Account;
TRUNCATE TABLE AccountRecovery;
TRUNCATE TABLE Arbitro;
TRUNCATE TABLE Contestacao;
TRUNCATE TABLE ContestacaoDocs;
TRUNCATE TABLE logErro;
TRUNCATE TABLE PedidoAbertura;
TRUNCATE TABLE PedidoAberturaAnalise;
TRUNCATE TABLE PedidoAberturaDocs;
TRUNCATE TABLE PedidoAberturaNotificacao;
TRUNCATE TABLE PedidoAberturaProvas;
TRUNCATE TABLE Pessoa;
TRUNCATE TABLE Processo;
TRUNCATE TABLE ProcessoFases;
TRUNCATE TABLE ProcessoSolucoes;
TRUNCATE TABLE Replica;
TRUNCATE TABLE ReplicaDocs;
TRUNCATE TABLE Treplica;
TRUNCATE TABLE TreplicaDocs;
set foreign_key_checks = 1;

INSERT INTO `arbitragem`.`Pessoa` 
(`Nome`, `Tipo`, `CpfCnpj`, `DataCadastro`, `Endereco`, `Numero`, `Bairro`, `Cidade`, 
`UF`, `ComplementoEndereco`, `CEP`, `Email`, `FoneFixo`, `Celular`) 
VALUES ('Marcelo Ojeda', 'Pessoa Física', '836.060.171-20', '2019-01-26 18:47:41', 
'Rua Casimiro de Abreu', '64', 'Parque Anhanguera', 'Goiânia', 'GO', 'Quadra 16', 
'74335-040', 'marcelo.torrilhas@gmail.com', null, '62 99114-7749');

INSERT INTO `arbitragem`.`account` (`PessoaId`, `UserName`, `Password`, `DataCadastro`, 
`UserType`) VALUES ('3', 'dev', '123', '2019-01-26 18:10:00', 'Adm');
