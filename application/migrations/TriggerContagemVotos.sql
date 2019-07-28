DELIMITER //
CREATE TRIGGER Trigger_ContagemVoto AFTER INSERT 
ON ProcessoVotacao
FOR EACH ROW 
BEGIN
	DECLARE SolucaoId INT(11);
	DECLARE Votos INT(11);
    
    Set SolucaoId = New.SolucaoId;
	
	SELECT COALESCE(SUM(NUMEROVOTOS),0) Into Votos FROM ProcessoSolucoes WHERE Id = SolucaoId;
    
	Update ProcessoSolucoes Set NumeroVotos = Votos + 1 Where Id = SolucaoId;
END; //
DELIMITER ;