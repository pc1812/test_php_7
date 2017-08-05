<?php

namespace App;

class AbstractView {
	
	protected $cssPrefix = 'std';
	protected $cssTags = array();
		
	public function setCssPrefix($cssPrefix)
	{
		$this->cssPrefix = $cssPrefix;
	}
	
	public function setCssToTag($tag, $css)
	{
		$this->cssTags[$tag] = $css;
	}
	
	public function displayTag($tagName)
	{
		return array_key_exists($tagName, $this->cssTags)
			?'<'.$tagName.' class="'.$this->cssTags[$tagName].'">'
			:'<'.$tagName.' class="'.$this->cssPrefix.'_'.$tagName.'">';
	}
	
	public function displayTagAll($tagName, $tagContext)
	{
		return $this->displayTag($tagName).$tagContext."</".$tagName.">";
	}
	
	public function display($data)
	{
		
	}
	
}
?>