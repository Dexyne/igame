<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('notif'))
{
	function notif($notif = '', $message = '')
	{
		if(isset($notif) && !empty($notif) && isset($message) && !empty($message)) {
			return 
			"<div class=\"alert-message {$notif} fade in\" data-alert=\"alert\">
				<a class=\"close\" href=\"#\">×</a>
				<p>{$message}</p>
			</div>";
		}	
	}
}

// Non fonctionnel, No functional
if ( ! function_exists('notif_list'))
{
	function notif_list($notif = '', $message = null)
	{
		if(isset($notif) && !empty($notif) && isset($message) && !empty($message)) {
			$notification = "<ul>";
			foreach($message as $val) {
				$notification .= "<li>{$message}</li>";
			}
			$notification .= "</ul>";

			return $notification;
		}	
	}
}


/* End of file notifications_helper.php */
/* Location: ./application/helpers/notifications_helper.php */
