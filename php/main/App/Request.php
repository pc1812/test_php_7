<?php

namespace App;


class Request {
	
	public $get = array();
	public $post = array();
	
	public function __construct()
	{
		foreach($_POST as $key => $value)
		{
			$this->post[$key] = htmlspecialchars(strip_tags($value), ENT_QUOTES);
		}
		
		foreach($_GET as $key => $value)
		{
			$this->get[$key] = htmlspecialchars(strip_tags($value), ENT_QUOTES);
		}
	}
	
	public function hasPost($key)
	{
		return isset($this->post[$key]);
	}
	
	public function hasGet($key)
	{
		return isset($this->get[$key]);
	}
}

?>