<?php
	
require_once __DIR__.'/../main/init.php';

if ($auth->isUser()) {
	$auth->expire();
}

header('Location: index.php');
?>