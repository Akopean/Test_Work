<?php

/**
*	Render Pages Site
*/
class View
{
	/*
	* Rendering Page
	*	$template - Name template
	*	return  void
	*/
	static function Render($render, $template = null)
	{
			require(__DIR__ . '/../view/header.php');
			if(!empty($template) && file_exists(__DIR__ . '/../view/'.$template.'.php'))
			{
				require(__DIR__ . '/../view/'.$template.'.php');
			}
			else
			{
				require(__DIR__ . '/../view/main.php');
			}

    		require(__DIR__ . '/../view/footer.php');
	}
}
