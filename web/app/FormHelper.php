<?php 

class FormHelper
{
	private $name;
	private $errors = false;
	private $defaultValues = false;

	public function __construct($name, $options = false) {
		$this->name = $name;
		if(isset($options['errors']) && !empty($options['errors']))
			$this->errors = $options['errors'];

		if(isset($options['defaultValues']) && !empty($options['defaultValues']))
			$this->defaultValues = $options['defaultValues'];
	}

	public function input($name, $options = null) {
		$result  = '<div class="form-group';
		$result .= isset($this->errors[$name]) ? ' has-error' : '';
		$result .= '">';
		$result .= "<label for='$name'>";
		$result .= isset($options['label']) ? $options['label'] : ucfirst($name);
		$result .= "</label>";
		$result .= (isset($options['type']) && ($options['type'] == 'money' || $options['type'] == 'percent')) ? '<div class="input-group">' : '';
		$result .= "<input id='$name' name='$this->name[$name]' type='";
		$result .= isset($options['type']) ? ($options['type'] == 'percent' || $options['type'] == 'money') ? 'number' : $options['type'] : 'text';
		$result .= "' class='form-control'";
		$result .= isset($options['defaultValue']) ? " value='".$options['defaultValue'] ."'" : isset($this->defaultValues[$this->name][$name]) ? " value='".$this->defaultValues[$this->name][$name]."'" : '';
		$result .= ' placeholder="';
		$result .= isset($options['placeHolder']) ? $options['placeHolder'] : isset($options['label']) ? $options['label'] : ucfirst($name);
		$result .= '"';
		$result .= (isset($options['disabled'])  && $options['disabled']) ? ' disabled' : '';
		$result .= (isset($options['readonly'])  && $options['readonly']) ? ' readonly' : '';
		$result .= '>';
		$result .= (isset($options['type']) && $options['type'] == 'money'  ) ? '<div class="input-group-addon">€</div>' : '';
		$result .= (isset($options['type']) && $options['type'] == 'percent') ? '<div class="input-group-addon">%</div>' : '';
		$result .= (isset($options['type']) && ($options['type'] == 'money' || $options['type'] == 'percent')) ? '</div>' : '';
		$result .= isset($this->errors[$name]) ? '<span id="helpBlock2" class="help-block">'.$this->errors[$name].'</span>' : '';
		$result .= "</div>";
		return $result;
	}

	public function select($name, $datas, $options = null) {
		$result  = '<div class="form-group';
		$result .= isset($this->errors[$name]) ? ' has-error' : '';
		$result .= '">';
		$result .= "<label for='$name'>";
		$result .= isset($options['label']) ? $options['label'] : ucfirst($name);
		$result .= "</label>";

		$result .= "<select name='$this->name[$name]' class='form-control'>";
		foreach ($datas as $data => $value) {
			if(isset($options['defaultValue']) && $options['defaultValue'] == $value)
				$result .= "<option selected='selected' value='$value'>$data</option>";
			else
				$result .= "<option value='$value'>$data</option>";
		}
		$result .= '</select>';
		$result .= "</div>";

		return $result;
	}
}