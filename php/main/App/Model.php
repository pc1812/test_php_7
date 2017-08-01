<?php

namespace App;

use \PDO;
use \PDOException;

class Model
{
	protected $dbinfo = array();
	protected $db;
	
	public function __construct()
	{
		$dbinfo['DB_HOST'] = getenv('DB_HOST');
		$dbinfo['DB_NAME'] = getenv('DB_NAME');
		$dbinfo['DB_CHARSET'] = getenv('DB_CHARSET');
		$dbinfo['DB_USERNAME'] = getenv('DB_USERNAME');
		$dbinfo['DB_PASSWORD'] = getenv('DB_PASSWORD');
		
		try {
			$this->db = new PDO('mysql:host='.$dbinfo['DB_HOST'].';dbname='.$dbinfo['DB_NAME'].';charset='.$dbinfo['DB_CHARSET'], $dbinfo['DB_USERNAME'], $dbinfo['DB_PASSWORD']);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		} catch(PDOException $ex) {
			Logger::instance()->exception($ex);
		}
	}
	
	public function __destruct()
	{
		$this->db = null;
	}
	
	public function getData($prepareStmt, $sqlArgs, $callback)
	{
		try {
			$stmt = $this->db->prepare($prepareStmt);
			$stmt->execute($sqlArgs);
			if (is_object($callback) && method_exists($callback, 'display')) {
				call_user_func_array(array($callback, 'display'), array($stmt));
			}
			else if (is_callable($callback)) {
				$callback($stmt);
			}
			else {
//				throw new \Exception ('no callback');
			}
		} catch(PDOException $ex) {
			Logger::instance()->exception($ex);
		}
	}
	
	public function updateData($prepareStmt, $sqlArgs)
	{
		try {
			$stmt = $this->db->prepare($prepareStmt);
			$stmt->execute($sqlArgs);
			return $stmt->rowCount();
		} catch(PDOException $ex) {
			Logger::instance()->exception($ex);
		}
	}
	
	public function insertData($prepareStmt, $sqlArgs, $callback='')
	{
		try {
			$stmt = $this->db->prepare($prepareStmt);
			$stmt->execute($sqlArgs);
			$last = $this->db->lastInsertId();
			if (is_object($callback) && method_exists($callback, 'display')) {
				call_user_func_array(array($callback, 'display'), array($last));
			}
			else if (is_callable($callback)) {
				$callback($last);
			}
			else {
//				throw new \Exception ('no callback');
			}
			return $last;
		} catch(PDOException $ex) {
			Logger::instance()->exception($ex);
		}
	}
	
}
?>