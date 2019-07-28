<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Esta funÃ§Ã£o retorna uma data escrita da seguinte maneira:
 * Exemplo: TerÃ§a-feira, 17 de Abril de 2007
 * @author Leandro Vieira Pinho [http://leandro.w3invent.com.br]
 * @param string $strDate data a ser analizada; por exemplo: 2007-04-17 15:10:59
 * @return string
 */
function formata_data_extenso($strDate)
{
	// Array com os dia da semana em portuguÃªs;
	$arrDaysOfWeek = array('Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado');
	// Array com os meses do ano em portuguÃªs;
	$arrMonthsOfYear = array(1 => 'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
	// Descobre o dia da semana
	$intDayOfWeek = date('w',strtotime($strDate));
	// Descobre o dia do mÃªs
	$intDayOfMonth = date('d',strtotime($strDate));
	// Descobre o mÃªs
	$intMonthOfYear = date('n',strtotime($strDate));
	// Descobre o ano
	$intYear = date('Y',strtotime($strDate));
	// Formato a ser retornado
	return $arrDaysOfWeek[$intDayOfWeek] . ', ' . $intDayOfMonth . ' de ' . $arrMonthsOfYear[$intMonthOfYear] . ' de ' . $intYear;
}

function get_mes_extenso($intMonthOfYear){
	$arrMonthsOfYear = array(1 => 'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');

	// Descobre o mÃªs
	//$intMonthOfYear = date('n',strtotime($strDate));

	return $arrMonthsOfYear[$intMonthOfYear];
}

function get_formato_brasil($strDate, $showTime = true){
	if(!$showTime)
		return date("d/m/Y", strtotime($strDate));
	else
		return date("d/m/Y H:i", strtotime($strDate));
}