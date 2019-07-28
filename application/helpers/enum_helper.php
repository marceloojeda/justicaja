<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function IntToAnalisePedidoStatus($num){
	switch ($num) {
		case ANALISEPEDIDO_NAOINICIADO:
			return 'Não Iniciado';
		case ANALISEPEDIDO_ANDAMENTO:
			return 'Em Andamento';
		case ANALISEPEDIDO_REJEITADO:
			return 'Rejeitado';
		case ANALISEPEDIDO_CANCELADO:
			return 'Cancelado';
		case ANALISEPEDIDO_CONCLUIDO:
			return 'Aceito';
		case ANALISEPEDIDO_REU_INDECISO:
			return 'Réu Indeciso';
		case ANALISEPEDIDO_PAP_ACEITO:
			return 'PAP Aceito pelo réu';
		default:
			return '';
	}
}