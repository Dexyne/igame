<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('site_url'))
{
	function site_url($uri = '')
	{		
		if( ! is_array($uri))
		{
			//	Tous les paramètres sont insérés dans un tableau
			$uri = func_get_args();
		}
	
		//	On ne modifie rien ici
		$CI =& get_instance();	
		return $CI->config->site_url($uri);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('url'))
{
	function url($text, $uri = '')
	{
		if( ! is_array($uri))
		{
			//	Suppression de la variable $text
			$uri = func_get_args();
			array_shift($uri);
		}
	
		echo '<a href="' . site_url($uri) . '">' . htmlentities($text) . '</a>';
		return '';
	}
}


/* End of file MY_url_helper.php */
/* Location: ./application/helpers/MY_url_helper.php */
