<?php 

class FormHelper
{
	public static function input($name, $options = null) {
		$result  = '<div class="form-group';
		$result .= isset($options['errors'][$name]) ? ' has-error' : '';
		$result .= '">';
		$result .= "<label for='$name'>";
		$result .= isset($options['label']) ? $options['label'] : ucfirst($name);
		$result .= "</label>";
		$result .= "<input id='$name' name='$name' type='";
		$result .= isset($options['type']) ? $options['type'] : 'text';
		$result .= "' class='form-control'";
		$result .= isset($options['defaultValue']) ? " value='".$options['defaultValue'] ."'" : isset($_POST[$name]) ? " value='".$_POST[$name]."'" : '';
		$result .= ' placeholder="';
		$result .= isset($options['placeHolder']) ? $options['placeHolder'] : isset($options['label']) ? $options['label'] : ucfirst($name);
		$result .= '"';
		$result .= (isset($options['disabled'])  && $options['disabled']) ? ' disabled' : '';
		$result .= (isset($options['readonly'])  && $options['readonly']) ? ' readonly' : '';
		$result .= '>';
		$result .= isset($options['errors'][$name]) ? '<span id="helpBlock2" class="help-block">'.$options['errors'][$name].'</span>' : '';
		$result .= "</div>";
		return $result;
	}

	public static function select($name, $datas, $options = null) {
		$result  = '<div class="form-group';
		$result .= isset($options['errors'][$name]) ? ' has-error' : '';
		$result .= '">';
		$result .= "<label for='$name'>";
		$result .= isset($options['label']) ? $options['label'] : ucfirst($name);
		$result .= "</label>";

		$result .= "<select name='$name' class='form-control'>";
		foreach ($datas as $data => $value) {
			$result .= "<option value='$value'>$data</option>";
		}
		$result .= '</select>';
		$result .= "</div>";

		return $result;
	}
}