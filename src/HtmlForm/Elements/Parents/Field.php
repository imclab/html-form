<?php

namespace HtmlForm\Elements\Parents;

abstract class Field implements \HtmlForm\Interfaces\Field
{
	public $requiredSymbol = "*";

	public $beforeElement = null;

	public $afterElement = null;
	
	public $required = false;

	public $name;
	
	public $label;
	
	public $defaultValue = "";
	
	public $attr = array();

	protected $compiledLabel;

	protected $compiledAttr;

	public function __construct($name, $label, $args = array())
	{
		$this->name = $name;
		$this->label = $label;

		$this->extractArgs($args);

		$this->compiledLabel = $this->compileLabel();
		$this->compiledAttr = $this->compileAttributes();
	}

	public function extractArgs($args)
	{
		foreach ($args as $k => $v) {
			if (property_exists($this, $k)) {
				$this->$k = $v;
			}
		}
	}

	public abstract function compile($field);

	/**
     * Gets the HTML for the label of a form element
     * @param  array $field An array of variables that define the form element
     * @return string 		The form element"s HTML label
     */
	public function compileLabel()
	{	
		$required = !empty($this->required) ? $this->requiredSymbol : "";
		return "<label for=\"{$this->name}\">{$required}{$this->label}</label>";
	}
	
    /**
     * Fetches the HTML attributes of a form element
     * @return string 			The form element"s attributes
     */
	public function compileAttributes()
	{
		$attributes = "";
		foreach ($this->attr as $k => $v) {
		    $attributes .= "{$k}=\"{$v}\" ";
		}
		return $attributes;
	}

	public function getPostValue()
	{
		$name = $this->name;
		return !empty($_POST[$name]) ? $_POST[$name] : null;
	}

	public function isPattern()
	{
		$attr = array_keys($this->attr);
		return in_array("pattern", $attr);
	}
}