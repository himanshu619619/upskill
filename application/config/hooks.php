<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['pre_controller'] = array(
	'class'    => 'MyClass',
	'function' => 'Myfunction',
	'filename' => 'Myclass.php',
	'filepath' => 'hooks',
	'params'   => array('bread', 'wine', 'butter')
);


//Example how to work hooks
// $hook['post_controller_constructor'] = array(
//   'class'    => 'LanguageLoader',
//   'function' => 'initialize',
//   'filename' => 'LanguageLoader.php',
//   'filepath' => 'hooks'
// );