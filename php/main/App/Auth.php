<?php

namespace App;

class Auth {
	
	protected $model;
	protected $profile;
	
	public function __construct($model)
	{
		$this->model = $model;
	}
	
	public function isGuest()
	{
		return count($this->profile) == 0;
	}
	
	public function isUser()
	{
		return count($this->profile) > 0;
	}
	
	public function getProfile($name)
	{
		return $this->profile[$name];
	}
	
	public function getProfiles()
	{
		return $this->profile;
	}
	
	public function expire()
	{
		session_destroy();
		$this->profile = [];
	}
	
	public function display($data)
	{
		if ($data->rowCount() == 1) {
			$this->profile = $data->fetch();
			error_log('display session '.$this->profile['id'], 0);
			error_log('isuser ?'.$this->isUser(), 0);
		}
		else {
			$this->profile = [];
		}
	}
	
	public function validate()
	{
		if (isset($_SESSION['id'])) {
			$id = $_SESSION['id'];
			error_log('validate session '.$id, 0);
			$this->model->getData(
				'select * from users where id=:id', 
				['id'=>$_SESSION['id']], $this
			);
		}
		else {
			error_log('no session in validation', 0);
			$this->profile = [];
		}
		
	}
}

?>