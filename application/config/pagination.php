<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Pagination Config
 * 
 * Just applying codeigniter's standard pagination config with twitter 
 * bootstrap stylings
 * 
 * @license		http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @author		Mike Funk
 * @link		http://codeigniter.com/user_guide/libraries/pagination.html
 * @email		mike@mikefunk.com
 * 
 * @file		pagination.php
 * @version		1.3.1
 * @date		03/12/2012
 * 
 * Copyright (c) 2011
 */
 
// --------------------------------------------------------------------------

// $config['base_url'] = '';
// $config['uri_segment'] = 3;
// $config['num_links'] = 9;
// $config['page_query_string'] = FALSE;
// $config['use_page_numbers'] = TRUE;
//$config['query_string_segment'] = 'page';


$config['full_tag_open'] = "<div class='w3-bar'>";
$config['full_tag_close'] = "</div>";

$config['first_link'] = "&laquo;";
$config['first_tag_open'] = "<a href='#'' class='w3-button'>";
$config['first_tag_close'] = "</a>";

$config['last_link'] = "&raquo;";
$config['last_tag_open'] = "<a href='#' class='w3-button'>";
$config['last_tag_close'] = '</a>';

$config['next_link'] = "&gt;";
$config['next_tag_open'] = "<a href='#' class='w3-button'>";
$config['next_tag_close'] = "</a>";

$config['prev_link'] = "&lt;";
$config['prev_tag_open'] = "<a href='#' class='w3-button'>";
$config['prev_tag_close'] = '</a>';

$config['cur_tag_open'] = "<a href='#' class='w3-button'></a><label class='w3-button w3-green'>";
$config['cur_tag_close'] = '</label>';

$config['num_tag_open'] = "<a href='#' class='w3-button'>";
$config['num_tag_close'] = '</a>';

//$config['display_pages'] = FALSE;
// 
//$config['anchor_class'] = 'page-link';
//$config['attributes'] = array('class' => 'page-link');

// --------------------------------------------------------------------------

/* End of file pagination.php */
/* Location: ./bookymark/application/config/pagination.php */