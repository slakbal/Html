<?php

namespace Slakbal\HtmlBs4\Traits;

trait TypeAhead
{

	public function typeAheadField( $name, $label = null, $value = null, $id = null, $help = null, $attributes = [ ], $type = null )
	{
		$attributes = $this->mergeAttributes( [ 'class' => 'typeahead', 'autocomplete' => 'off' ], (array)$attributes );

		$element = $this->text( $name, $this->checkForOldValue( $name, $value ), $this->getControlClassArray( $name, $type, $attributes ) );
		$element .= $this->hidden( $name . '_id', $this->checkForOldValue( $name . '_id', $id ), $options = [ 'id' => $name . '_id' ] );
		return $this->fieldWrapper( $name, $label, $help, $element, $type );
	}

}