<?php

namespace App\View;

use App\AbstractView;

class ExceptionTraceView extends AbstractView {
	
	public function __construct()
	{
		$this->setCssPrefix('exc');
	}
	
	private function trace($traceNode, $traceValue)
	{
		if (is_array($traceValue)) {
			foreach ($traceValue as $key=>$value) {
				$this->trace($key, $value);
			}
		}
		else if (is_object($traceValue)) {
			echo $this->displayTagAll('li', $traceNode.'='.get_class($traceValue));
		}
		else {
			echo $this->displayTagAll('li', $traceNode.'='.$traceValue);
		}
	}
	
	public function display($ex)
	{
		echo $this->displayTag('ul');
		echo $this->displayTagAll('h3', 'Something wrong');
		echo $this->displayTagAll('h3', $ex->getMessage());
		$this->trace('', $ex->getTrace());
		echo "</ul>";
	}
	
}
?>