<?php
$pagetitle = array(
    'title' => 'Net Pizzeria',
);

$header = array(
    'imagesource' => 'logo.png', 
    'imagealt' => 'Net Pizzeria Logo',
	'title' => 'Net Pizzeria',
	'motto' => 'Open day and night for your cravings!'
);

$footer = array(
    'copyright' => 'Copyright '.date("Y").'.',
    'firm' => 'Net Pizzeria'
);

$pages = array(
	'/' => array('file' => 'home', 'text' => 'Home', 'menun' => array(1,1)),
	'introduction' => array('file' => 'introduction', 'text' => 'Introduction', 'menun' => array(1,1)),
	'contact' => array('file' => 'contact', 'text' => 'Contact', 'menun' => array(1,1)),
	'articles' => array('file' => 'articles', 'text' => 'Articles', 'menun' => array(1,1)),
    'table' => array('file' => 'table', 'text' => 'Pizzas', 'menun' => array(1,1)),
    'login' => array('file' => 'login', 'text' => 'Login', 'menun' => array(1,0)),
    'login2' => array('file' => 'login2', 'text' => '', 'menun' => array(0,0)),
    'logout' => array('file' => 'logout', 'text' => 'Logout', 'menun' => array(0,1)),
    'register' => array('file' => 'register', 'text' => '', 'menun' => array(0,0))
);

$error_page = array ('file' => '404', 'text' => 'Page not found!');
?>