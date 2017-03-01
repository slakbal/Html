<?php

namespace Slakbal\Html\Traits;

trait Select
{
	public function selectField( $name, $label = null, $options, $value = null, $help = null, $attributes = [ ], $type = null )
	{
		foreach( $options as $key => $keyValue ) {
			$options[ $key ] = is_string( $keyValue ) ? trans( $keyValue ) : $keyValue;
		}

		$element = $this->select( $name, $options, $value, $this->getControlClassArray( $name, $type, $attributes ) );

		return $this->selectWrapper( $name, $label, $help, $element, $type );
	}


	public function selectYearField( $name, $label = null, $from, $to, $value = null, $help = null, $attributes = [ ], $type = null )
	{
		$element = $this->selectYear( $name, $from, $to, $value, $this->fieldAttributes( $name, $attributes ) );

		return $this->selectWrapper( $name, $label, $help, $element, $type );
	}


	public function selectMonthField( $name, $label = null, $value = null, $help = null, $attributes = [ ], $format = '%B', $type = null )
	{
		$element = $this->selectMonth( $name, $value, $this->fieldAttributes( $name, $attributes ), $format );

		return $this->selectWrapper( $name, $label, $help, $element, $type );
	}


	public function selectYesNoField( $name, $label = null, $value = null, $addAllItemToList = false, $help = null, $attributes = [ ] )
	{
		if( $addAllItemToList ) {
			$options = [
				''    => trans( 'controls.all' ),
				true  => trans( 'controls.yes' ),
				false => trans( 'controls.no' ),
			];
		}
		else {
			$options = [
				true  => trans( 'controls.yes' ),
				false => trans( 'controls.no' ),
			];
		}

		return $this->selectField( $name, $label, $options, $value, $help, $attributes );
	}


	public function selectStatusField( $name, $label = null, $value = null, $addAllItemToList = false, $help = null, $attributes = [ ] )
	{
		if( $addAllItemToList ) {
			$options = [
				''    => trans( 'controls.all' ),
				true  => trans( 'controls.active' ),
				false => trans( 'controls.inactive' ),
			];
		}
		else {
			$options = [
				true  => trans( 'controls.active' ),
				false => trans( 'controls.inactive' ),
			];
		}

		return $this->selectField( $name, $label, $options, $value, $help, $attributes );
	}


	public function selectPublishField( $name, $label = null, $value = null, $addAllItemToList = false, $help = null, $attributes = [ ] )
	{
		if( $addAllItemToList ) {
			$options = [
				''    => trans( 'controls.all' ),
				true  => trans( 'controls.published' ),
				false => trans( 'controls.hidden' ),
			];
		}
		else {
			$options = [
				true  => trans( 'controls.published' ),
				false => trans( 'controls.hidden' ),
			];
		}

		return $this->selectField( $name, $label, $options, $value, $help, $attributes );
	}


	public function selectTranslateField( $name, $label = null, $options = [ ], $value = null, $addAllItemToList = false, $help = null, $attributes = [ ] )
	{
		$translated = [ ];
		foreach( $options as $item ) {
			$translated = array_add( $translated, $item->id, trans( $item->lang_key ) );
		}

		if( $addAllItemToList ) {
			$translated = [ '' => trans( 'controls.all' ) ] + $translated;
		}

		return $this->selectField( $name, $label, $translated, $value, $help, $attributes );
	}

}