<?php

namespace HtmlForm\Elements;

class Radio extends Field
{
	public function compile($value = "")
	{
		$html = "{$this->compiledLabel}";
		
		/* check to see if the options are an associative array
		   this will determine how we handle the input value */
		$isAssoc = \HtmlForm\Utility\Utility::isAssoc($this->options);
		
		foreach ($this->options as $k => $v) {
			
			$html .= "<span><input type=\"radio\" ";
			$html .= $this->compiledAttr;
			$html .= "name=\"" . $this->name . "\" ";
			
			// handle options in an associative array differently than ones in a numeric array
			if ($isAssoc) {
				$html .= "value=\"{$k}\" ";
				if ($k == $value || (is_array($value) && in_array($k, $value)))
					$html .= " checked=\"checked\"";
			
			} else {
				$html .= "value=\"{$v}\" ";
				if ($v == $value || (is_array($value) && in_array($v, $value)))
					$html .= " checked=\"checked\"";
			}
			
			$html .= " /> {$v}</span>";
		}
		
		return $html;
	}
}