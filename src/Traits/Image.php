<?php

namespace Slakbal\HtmlBs4\Traits;

trait Image
{
	/**
	 * Responsive Images
	 */
	public function imageResponsive( $url, $alt = null, $attributes = [ 'style' => 'width: 100%' ] )
	{
		$alt = ( $alt == '' ? null : $alt );
		if( array_key_exists( 'class', $attributes ) ) {
			$attributes[ 'class' ] .= ' img-fluid'; //add to the existing values
		}
		else {
			$attributes[ 'class' ] = 'img-fluid'; //set the basis values
		}

		return $this->image( $url, $alt, $attributes );
	}
}