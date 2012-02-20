<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This file is part of iGame
 *
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @see https://github.com/Dexyne/igame
 *
 * @copyright Copyright (c) 2011-Present, Aurélien Léger, iGame
 * All rights reserved.
 *
 * iGame is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * iGame program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with iGame.  If not, see <http://www.gnu.org/licenses/>.
 *
 * #######################################################################
 */

if ( ! function_exists('notif'))
{
	function notif($notif = '', $message = '', $block = 0, $heading = '')
	{
		if(isset($notif) && isset($message) && !empty($message)) {
			if($block && !empty($heading)) {
				// Block notification
				return
				"<div class=\"alert {$notif} alert-block\">
					<a class=\"close\" data-dismiss=\"alert\" >×</a>
					<h4 class=\"alert-heading\">{$heading}</h4>
					<p>{$message}</p>
				</div>";
			} else {
				// Inline notification
				return
				"<div class=\"alert {$notif}\">
					<a class=\"close\" data-dismiss=\"alert\" >×</a>
					<p>{$message}</p>
				</div>";
			}
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
