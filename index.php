<?php
include('./includes/config.inc.php');
$page = explode('&', $_SERVER['QUERY_STRING'])[0];
if ($page!="") {
	if (isset($pages[$page]) && file_exists("./templates/pages/{$pages[$page]['file']}.tpl.php")) {
		$find = $pages[$page];
	}
	else { 
		$find = $error_page;
		header("HTTP/1.0 1000 Not Found");
	}
}
else $find = $pages['/'];
include('./templates/index.tpl.php'); 
?>