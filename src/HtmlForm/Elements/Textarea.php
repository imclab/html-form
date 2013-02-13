<?php

namespace HtmlForm\Elements;

class Textarea extends Field
{
	/**
	 * Creates a textarea form element
	 * @param  array $value 	The current value of the form element
     * @return string 			The HTML for the input
     */
	public function compile($value = "")
	{
		return "{$this->compiledLabel}<textarea name=\"{$this->name}\" {$this->compiledAttr}>{$value}</textarea>";
	}
}