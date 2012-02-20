<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('css_url'))
{
	function css_url($name)
	{
		return base_url() . 'assets/css/' . $name . '.css';
	}
}

if ( ! function_exists('js_url'))
{
	function js_url($name)
	{
		return base_url() . 'assets/javascripts/' . $name . '.js';
	}
}

if ( ! function_exists('img_url'))
{
	function img_url($name)
	{
		return base_url() . 'assets/images/' . $name;
	}
}

if ( ! function_exists('img'))
{
	function img($name, $alt = '', $title = '', $attributs = '')
	{
		return '<img src="' . img_url($name) . '" alt="' . $alt . '" title="'. $title .'" ' . $attributs . ' >';
	}
}
