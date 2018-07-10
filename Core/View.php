<?php

class View
{
	public static function render($view, $data)
	{
		require $view;
	}
}

?>
