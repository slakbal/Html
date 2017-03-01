<?php

namespace Slakbal\HtmlBs4\Traits;

trait Labels
{

	/**
	 * Label Formatter for general labels
	 */
	public function label( $message, $type = 'default' )
	{
		$message = ucfirst( $message );
		$type = strtolower( $type );

		return '<span class="tag tag-' . $type . '">' . $message . '</span>';
	}


	/**
	 * Label Formatter for status types
	 */
	public function labelActive( $boolean )
	{
		if( $boolean ) {
			return $this->label( trans( 'controls.active' ), 'success' );
		}
		else {
			return $this->label( trans( 'controls.inactive' ), 'danger' );
		}
	}

	
	/**
	 * Label Formatter for yes no types
	 */
	public function labelYesNo( $boolean )
	{
		if( $boolean ) {
			return $this->label( trans( 'controls.yes' ), 'success' );
		}
		else {
			return $this->label( trans( 'controls.no' ), 'danger' );
		}
	}


	/**
	 * Label Formatter for yes no types
	 */
	public function labelFreePaid( $boolean )
	{
		if( $boolean ) {
			return $this->label( trans( 'controls.free' ), 'success' );
		}
		else {
			return $this->label( trans( 'controls.paid' ), 'danger' );
		}
	}


	/**
	 * Label Formatter for inverse yes no types
	 */
	public function labelYesNoInverse( $boolean )
	{
		if( $boolean ) {
			return $this->label( trans( 'controls.yes' ), 'danger' );
		}
		else {
			return $this->label( trans( 'controls.no' ), 'success' );
		}
	}


	/**
	 * Status Decorator
	 */
	public function labelUserStatus( $status_key )
	{
		switch( $status_key ) {
			case 'ACTIVE' :
				return $this->label( trans( 'controls.active' ), 'success' );
				break;
			case 'INACTIVE' :
				return $this->label( trans( 'controls.inactive' ), 'warning' );
				break;
			case 'UNKNOWN' :
				return $this->label( trans( 'controls.unknown' ), 'info' );
				break;
			case 'PENDING' :
				return $this->label( trans( 'controls.pending' ), 'primary' );
				break;
			case 'DECEASED' :
				return $this->label( trans( 'controls.deceased' ), 'danger' );
				break;
			default:
				return $this->label( trans( 'controls.undefined' ), 'default' );
		}
	}
}