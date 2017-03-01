<?php

namespace Slakbal\HtmlBs4\Traits;

trait Buttons
{

	//submits a form
	public function submitButton( $name, $tooltip = '', $disabled = false, $colour = 'primary', $size = 'md', $attributes = [ ] )
	{
		$attributes = $this->mergeAttributes( (array)$attributes, [ 'class' => $this->getButtonColourAndType( $colour, $size ) ] );

		return $this->formButton( $name, $tooltip, $disabled, 'submit', $attributes );
	}


	public function linkButton( $href, $name, $tooltip = '', $disabled = false, $colour = 'primary', $size = 'md', $attributes = [ ] )
	{
		$attributes = $this->mergeAttributes( (array)$attributes, [ 'class' => $this->getButtonColourAndType( $colour, $size ) ] );
		$attributes = $this->setDisabledState( $disabled, $attributes );
		$attributes = $this->html->attributes( $attributes );

		return '<a href="' . $href . '" role="button" title="' . $tooltip . '" ' . $attributes . '>' . $name . '</a>';
	}


	//it does a JS call
	public function resetFormLink( $label, $formId, $cleanHiddenField = false, $attributes = [ ] )
	{
		$cleanHiddenField = ( $cleanHiddenField ) ? 'true' : 'false';

		$attributes = $this->mergeAttributes( (array)$attributes, [ 'onclick' => "clearForm('" . $formId . "'," . $cleanHiddenField . ");" ] );

		return '<br/>' . $this->html->link( '#void', $label, $attributes, $secure = null );
	}


	//base method of some other buttons above
	public function formButton( $name, $tooltip = '', $disabled = false, $action = 'submit', $attributes = [ ] )
	{
		$attributes = $this->setDisabledState( $disabled, $attributes );
		$options = $this->html->attributes( $attributes );

		return '<button type="' . $action . '" ' . $options . ' title="' . $tooltip . '">' . $name . '</button>';
	}

	private function getButtonColourAndType( $colour = 'primary', $size = 'md' )
	{
		$btnString = ( isset( $size ) && !is_null( $size ) ) ? "btn btn-" . $size : "btn";

		return ( isset( $colour ) && !is_null( $colour ) ) ? $btnString . " btn-" . $colour : $btnString;
	}


	private function setButtonColourAndType( $colour = 'primary', $size = 'md', $attributes = [ ] )
	{
		return $this->mergeAttributes( [ 'class' => $this->getButtonColourAndType( $colour, $size ) ], (array)$attributes );
	}

}