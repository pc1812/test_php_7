<?php
namespace App;

use App\View\ExceptionTraceView;

class Logger {
	
	public static function instance()
	{
		static $inst = null;
		if ($inst === null) {
			$inst = new Logger();
		}
		return $inst;
	}
	
	private $logMessageType = 0;
	private $dispalyExceptionToView = true;
	
	private function __construct()
	{
		
	}
	
	public function exception($ex)
	{
		$msg = $ex->getMessage();
		$this->trace($msg, '', $ex->getTrace());
		error_log($msg, $this->logMessageType);
		
		if ($this->dispalyExceptionToView) {
			$view = new ExceptionTraceView();
			$view->display($ex);
			die();
		}
	}
	
	private function trace(&$msg, $traceNode, $traceValue)
	{
		if (is_array($traceValue)) {
			foreach ($traceValue as $key=>$value) {
				$this->trace($msg, $key, $value);
			}
		}
		else if (is_object($traceValue)) {
			$msg = $msg.' | '.$traceNode.'='.get_class($traceValue);
		}
		else {
			$msg = $msg.' | '.$traceNode.'='.$traceValue;
		}
	}
}


?>