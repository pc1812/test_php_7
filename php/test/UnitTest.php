<?php

namespace Test;

use \PDOException;
use PHPUnit\Framework\TestCase;
use App\Model;
use App\AbstractView;

class UnitTest extends TestCase
{
	
	public function testModelCreation()
	{
		$model = new Model();
		$this->assertNotNull($model);
	}
	
	public function testRoot()
	{
		$headers = get_headers('http://localhost');
		$this->assertEquals($headers[0], 'HTTP/1.1 200 OK');
	}
	
	public function testCssPrefix()
	{
		$view = new AbstractView();
		$view->setCssPrefix('test');
		$this->assertEquals($view->displayTag('table'), '<table class="test_table">');
	}
	
}
