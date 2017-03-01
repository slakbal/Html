<?php

namespace Slakbal\HtmlBs4\Traits;

trait Alert
{
	/**
	 * Alerts
	 */
	public function alert( $title, $message, $type = 'info' )
	{
		$type = ( $type == '' ? 'info' : $type );
		$title = ( $title == '' ? null : '<strong>' . $title . '</strong>' );

		return '<div class="alert alert-' . $type . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $title . ': ' . $message . '</div>';
	}
}