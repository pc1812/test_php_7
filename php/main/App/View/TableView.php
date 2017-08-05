<?php

namespace App\View;

use App\AbstractView;

class TableView extends AbstractView {
	
	protected $columnsAsHeader = true;
	protected $columns = array();
	
	public function setColumns($columns)
	{
		$this->columns = $columns;
	}
	
	public function setColumnsAsHeader($columnsAsHeader=true)
	{
		$this->columnsAsHeader = $columnsAsHeader;
	}
	
	public function display($data)
	{
		echo $this->displayTag('table');
		if ($this->columnsAsHeader) {
			echo $this->displayTag('tr');
			foreach($this->columns as $col) {
				echo $this->displayTag('th').$col."</th>";
			}
			echo "</tr>";
		}
		foreach($data as $row) {
			echo $this->displayTag('tr');
			foreach($this->columns as $col) {
				echo $this->displayTag('td').$row[$col]."</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
	
}
?>