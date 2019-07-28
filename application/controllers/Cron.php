<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends Public_Controller {

    function __construct() {
		parent::__construct();

        $this->load->Model('ProcessoModel');
    }

    function tramitarProcessos(){
        $dataAtual = date('Y-m-d 00:00:00');

        $processoFases = $this->ProcessoModel->getProcessosPrazoVencido($dataAtual);

        foreach($processoFases as $processoFase){
            $this->tramitar($processoFase);
        }

        $this->ProcessoModel->contarPrazos();

        echo "Cron executada";
    }

    function tramitar($processoFase){
        $faseAtualEntidade = $this->ProcessoModel->GetFaseAtualByProcesso($processoFase->ProcessoId);
        $faseProcessualEntidade = $this->ProcessoModel->getFaseProcessual($processoFase->FaseId);

        if(!$faseAtualEntidade || !$faseProcessualEntidade){
            return;
        }

        $proximaFaseProcessualEntidade = $this->ProcessoModel->getProximaFaseProcessual($faseProcessualEntidade->Codigo);
        if(!$proximaFaseProcessualEntidade){
            return;
        }
        
        $faseAnterior = array(
            'Id' => $faseAtualEntidade[0]['ProcessoFasesId'],
            'DataSaida' => date('Y-m-d H:i:s'),
            'FaseAtual' => 0
        );
        $this->ProcessoModel->atualizarProcessoFase($faseAnterior);

        $dataAtual = date('Y-m-d H:i:s');
        $dataLimite = date('Y-m-d H:i:s', strtotime($dataAtual. ' + '.$faseProcessualEntidade->Prazo.' days'));
        
        $proximaFase = array(
            'ProcessoId' => $processoFase->ProcessoId,
            'FaseId' => $proximaFaseProcessualEntidade->Id,
            'DataEntrada' => $dataAtual,
            'DataLimite' => $dataLimite,
            'FaseAtual' => 1
        );

        $this->ProcessoModel->cadastrarFaseProcessual($proximaFase);
    }
}
