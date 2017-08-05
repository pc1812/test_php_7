<?php

class Autoloader {
	static public function loader($className) {
		$filename = __DIR__ . "/" . str_replace("\\", '/', $className) . ".php";
		if (file_exists($filename)) {
			require_once $filename;
			if (class_exists($className)) {
				return TRUE;
			}
		}
		return FALSE;
	}
}

spl_autoload_register('Autoloader::loader');

use App\Model;

$model = new Model();


use App\Auth;

session_start();
$auth = new Auth($model);
$auth->validate();

use App\Request;
$request = new Request();

?>