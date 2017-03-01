<?php

namespace Slakbal\HtmlBs4\Traits;

trait Fields
{

	public function textField( $name, $label = null, $value = null, $help = null, $attributes = [ ], $type = null )
	{
		$element = $this->text( $name, $value, $this->getControlClassArray( $name, $type, $attributes ) );

		return $this->fieldWrapper( $name, $label, $help, $element, $type );
	}


	public function numberField( $name, $label = null, $value = null, $help = null, $attributes = [ ], $type = null )
	{
		$element = $this->number( $name, $value, $this->getControlClassArray( $name, $type, $attributes ) );

		return $this->fieldWrapper( $name, $label, $help, $element, $type );
	}


	public function emailField( $name, $label = null, $value = null, $help = null, $attributes = [ ], $type = null )
	{
		$element = $this->email( $name, $value, $this->getControlClassArray( $name, $type, $attributes ) );

		return $this->fieldWrapper( $name, $label, $help, $element, $type );
	}


	public function checkboxField( $name, $label = '', $value = 1, $checked = null, $attributes = [ ], $type = null )
	{
		$element = $this->checkbox( $name, $value, $checked, $this->getCheckControlClassArray( $name, $type, $attributes ) );

		return $this->checkableWrapper( $name, $label, $element, $type );
	}


	public function inlineCheckboxField( $name, $label = '', $value = 1, $checked = null, $attributes = [ ], $type = null )
	{
		$element = $this->checkbox( $name, $value, $checked, $this->getCheckControlClassArray( $name, $type, $attributes ) );

		return $this->inlineCheckableWrapper( $name, $label, $element, $type );
	}


	public function urlField( $name, $label = null, $value = null, $help = null, $attributes = [ ], $type = null )
	{
		$element = $this->url( $name, $value, $this->getControlClassArray( $name, $type, $attributes ) );

		return $this->fieldWrapper( $name, $label, $help, $element, $type );
	}


	public function passwordField( $name, $label = null, $help = null, $attributes = [ ], $type = null )
	{
		$element = $this->password( $name, $this->getControlClassArray( $name, $type, $attributes ) );

		return $this->fieldWrapper( $name, $label, $help, $element, $type );
	}


	public function dateField( $name, $label = '', $value = null, $help = null, $attributes = [ ], $type = null )
	{
		$element = $this->date( $name, $value, $this->getControlClassArray( $name, $type, $this->mergeAttributes( [ 'class' => 'datepicker' ], (array)$attributes ) ) );

		return $this->fieldWrapper( $name, $label, $help, $element, $type );
	}


	public function timeField( $name, $label = null, $value = null, $help = null, $attributes = [ ], $type = null )
	{
		$element = $this->time( $name, $value, $this->getControlClassArray( $name, $type, $attributes ) );

		return $this->fieldWrapper( $name, $label, $help, $element, $type );
	}


	public function datePickerField( $name, $label = '', $value = null, $help = null, $attributes = [ ], $type = null )
	{
		$timestamp = null;
		$element = '<div class="input-group date" id="' . $name . '_picker">';
		$element .= $this->input( 'text', $name, $value, $this->getControlClassArray( $name, $type, $attributes ) );
		$element .= '<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>';
		$element .= '</div>';
		$element .= $this->hidden( $name . '_timestamp', null, [ 'id' => $name . '_timestamp' ] );
		$element = $this->fieldWrapper( $name, $label, $help, $element, $type );

		return $element;
	}


	public function textAreaField( $name, $label = null, $value = null, $help = null, $attributes = [ ], $type = null )
	{
		$element = $this->textarea( $name, $value, $this->getControlClassArray( $name, $type, $this->mergeAttributes( [ 'class' => 'md-textarea' ], (array)$attributes ) ) );

		return $this->fieldWrapper( $name, $label, $help, $element, $type );
	}


	public function textAreaCountField( $name, $label = null, $length, $value = null, $help = null, $attributes = [ ], $type = null )
	{
		$element = $this->textarea( $name, $value, $this->getControlClassArray( $name, $type, $this->mergeAttributes( [ 'length' => $length ], (array)$attributes ) ) );

		return $this->fieldWrapper( $name, $label, $help, $element, $type );
	}


	public function fileField( $name, $label = null, $value = null, $help = null, $attributes = [ ], $type = null )
	{
		$element = $this->input( 'file', $name, $value, $this->getControlClassArray( $name, $type, $this->mergeAttributes( [ 'class' => 'form-control-file', 'aria-describedby' => $name.'Help' ], (array)$attributes ) ) );

		return $this->fileWrapper( $name, $label, $element, $help, $type );
	}

}