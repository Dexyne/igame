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

/* End of file notifications_helper.php */
/* Location: ./application/helpers/notifications_helper.php */
