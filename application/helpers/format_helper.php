<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function format_currency($number, $symbol = true, $decimals = 2, $dec_point ='.', $thousands_sep = '')
{
	$currency_symbol = get_instance()->config->item('currency_symbol');
	
	return ($symbol ? $currency_symbol : ''). number_format($number, $decimals, $dec_point, $thousands_sep);
}

function format_date($date, $format='d/m/Y')
{
	return date($format, strtotime($date));
}