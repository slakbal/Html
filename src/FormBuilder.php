<?php namespace Slakbal\HtmlBs4;

use Slakbal\HtmlBs4\Traits\Buttons;
use Slakbal\HtmlBs4\Traits\Fields;
use Slakbal\HtmlBs4\Traits\Modals;
use Slakbal\HtmlBs4\Traits\Select;
use Slakbal\HtmlBs4\Traits\TypeAhead;
use Collective\Html\FormBuilder as CollectiveFormBuilder;
use Illuminate\Support\Facades\Session;

class FormBuilder extends CollectiveFormBuilder
{

	use Fields, Buttons, Modals, TypeAhead, Select;

	private $defaultControlClass = "form-control";
	private $defaultCheckboxControlClass = "form-check-input";
	private $controlTypeClass = null;
	private $feedbackMessage = null;
	private $groupTypeClass = null;


	//for normal controls
	protected function getControlClassArray( $fieldName, $type, $parentAttributeArray )
	{
		$this->checkState( $fieldName, $type );

		$parentAttributeArray = $this->fieldAttributes( $fieldName, $parentAttributeArray );

		return $this->mergeAttributes( [ 'class' => $this->defaultControlClass . $this->controlTypeClass ], (array)$parentAttributeArray );
	}


	//specific for checkboxes
	protected function getCheckControlClassArray( $fieldName, $type, $parentAttributeArray )
	{
		$this->checkState( $fieldName, $type );

		$parentAttributeArray = $this->fieldAttributes( $fieldName, $parentAttributeArray );

		return $this->mergeAttributes( [ 'class' => $this->defaultCheckboxControlClass . $this->controlTypeClass ], (array)$parentAttributeArray );
	}


	private function fieldAttributes( $fieldName, $attributes = [ ] )
	{
		$fieldName = str_replace( '[]', '', $fieldName );

		return $this->mergeAttributes( [ 'id' => $fieldName ], (array)$attributes );
	}


	/**
	 * @param $fieldName
	 * @param $type
	 */
	protected function checkState( $fieldName, $type )
	{
		if( !$this->checkForErrorMessage( $fieldName ) ) {
			$this->determineGroupType( $type ); //if no error see if the type can be determined
			$this->determineControlType( $type ); //if no error see if the type can be determined
		}
	}


	public function fieldWrapper( $fieldName, $label, $help, $element, $type = null )
	{
		$fieldName = $this->cleanFieldname( $fieldName );

		$out = "<div class='form-group" . $this->groupTypeClass . "'>";
		$out .= $this->fieldLabel( $fieldName, $label );
		$out .= $element;
		$out .= $this->getFeedback();
		$out .= $this->fieldHelp( $help );
		$out .= "</div>";

		return $out;
	}


	public function selectWrapper( $fieldName, $label, $help, $element, $type = null )
	{
		$fieldName = $this->cleanFieldname( $fieldName );

		$out = "<div class='form-group" . $this->groupTypeClass . "'>";
		$out .= $this->fieldLabel( $fieldName, $label );
		$out .= $element;
		$out .= $this->getFeedback();
		$out .= $this->fieldHelp( $help );
		$out .= "</div>";

		return $out;
	}


	public function checkableWrapper( $fieldName, $label, $checkable, $type = null )
	{
		return '<div class="form-check' . $this->groupTypeClass . '"><label class="form-check-label">' . $checkable . ' ' . $label . '</label></div>';
	}


	private function inlineCheckableWrapper( $fieldName, $label, $checkable, $type = null )
	{
		return '<div class="form-check form-check-inline' . $this->groupTypeClass . '"><label class="form-check-label">' . $checkable . ' ' . $label . '</label></div>';
	}


	public function fileWrapper( $fieldName, $label, $element, $help, $type = null )
	{
		$fieldName = $this->cleanFieldname( $fieldName );

		return "<div class='form-group" . $this->groupTypeClass . "'><label for='" . $fieldName . "'>" . $label . "</label>" . $element . $this->fieldHelp( $help )."</div>";
	}


	protected function fieldLabel( $name, $label )
	{
		if( !empty( $label ) ) {
			return "<label class='form-control-label' for='" . str_replace( '[]', '', $name ) . "'>" . $label . "</label>";
		}

		return null;
	}


	protected function getFeedback()
	{
		if( $this->feedbackMessage ) {
			return "<div class='form-control-feedback'><small>" . $this->feedbackMessage . "</small></div>";
		}
		else {
			return '';
		}
	}


	protected function fieldHelp( $help )
	{
		if( !empty( $help ) ) {
			return "<small class='form-text text-muted'>" . $help . "</small>";
		}

		return null;
	}


	protected function checkForErrorMessage( $fieldName, $message = null )
	{
		if( $errors = Session::get( 'errors' ) ) {

			if( $errors->has( $fieldName ) ) {

				$this->determineGroupType( 'DANGER' );
				$this->determineControlType( 'DANGER' );

				if( isset( $message ) ) {

					$this->feedbackMessage = "<div class='form-control-feedback'>" . $message . "</div>";
				}
				else {

					$this->feedbackMessage = $errors->first( $fieldName, "<div class='form-control-feedback'>:message</div>" );
				}
			}
			else {
				//if this gives too much issues just set everything that is not an error to DEFAULT state
				//only mark non password fields as green when submitted and ignored field names (typical checkboxes)
				/*
				if( !preg_match( '(password|newsletter|remember)', $fieldName ) ) {

					$this->determineGroupType( 'DEFAULT' );
					$this->determineControlType( 'DEFAULT' );
				}
				elseif( preg_match( '(newsletter|remember)', $fieldName ) ) {

					$this->determineGroupType( 'DEFAULT' );
					$this->determineControlType( 'DEFAULT' );
				}
				*/

				$this->determineGroupType( 'DEFAULT' );
				$this->determineControlType( 'DEFAULT' );

				$this->feedbackMessage = null; //if no error then clear any old state
			}

			return true;
		}
		else {
			return false;
		}
	}


	protected function determineGroupType( $type )
	{
		switch( strtoupper( $type ) ) {
			case "DEFAULT":
				$this->groupTypeClass = null;
				break;
			case "INFO":
				$this->groupTypeClass = ' has-info';
				break;
			case "SUCCESS":
				$this->groupTypeClass = ' has-success';
				break;
			case "WARNING":
				$this->groupTypeClass = ' has-warning';
				break;
			case "DANGER":
				$this->groupTypeClass = ' has-danger';
				break;
			default:
				$this->groupTypeClass = null;
		}
	}


	protected function determineControlType( $type )
	{
		switch( strtoupper( $type ) ) {
			case "DEFAULT":
				$this->controlTypeClass = null;
				break;
			case "INFO":
				$this->controlTypeClass = ' form-control-info';
				break;
			case "SUCCESS":
				$this->controlTypeClass = ' form-control-success';
				break;
			case "WARNING":
				$this->controlTypeClass = ' form-control-warning';
				break;
			case "DANGER":
				$this->controlTypeClass = ' form-control-danger';
				break;
			default:
				$this->controlTypeClass = null;
		}
	}


	protected function cleanFieldname( $fieldName )
	{
		return preg_replace( "/\[([^\[\]]++|(?R))*+\]/", "", $fieldName );
	}


	protected function fieldError( $field )
	{
		if( $errors = Session::get( 'errors' ) ) {
			return $errors->first( $field ) ? " has-error has-feedback" : null;
		}

		return null;
	}


	public function fieldErrorMessage( $fieldName, $message = null )
	{
		if( $errors = Session::get( 'errors' ) ) {
			if( $errors->has( $fieldName ) ) {
				if( isset( $message ) ) {
					return "<div class='errorMessage'>" . $message . "</div>";
				}
				else {
					return $errors->first( $fieldName, "<div class='errorMessage'>:message</div>" );
				}
			}
		}
	}


	private function checkForOldValue( $fieldName, $value = null )
	{
		$old = $this->old( $fieldName );
		return $old ? $old : $value;
	}


	private function setDisabledState( $disabled, $attributes )
	{
		if( $disabled ) {
			$attributes = $this->mergeAttributes( [ 'disabled' => 'disabled', 'class' => 'disabled', 'aria-disabled' => 'true' ], (array)$attributes );

			return $attributes;
		}

		return $attributes;
	}


	private function mergeAttributes( $newAttributes, $existingAttributes )
	{
		foreach( $newAttributes as $key => $value ) {
			if( array_key_exists( $key, $existingAttributes ) ) {
				$existingAttributes[ $key ] = trim( $existingAttributes[ $key ] ) . ' ' . trim( $value ); //if key exist concat the values
			}
			else {
				$existingAttributes[ $key ] = trim( $value ); //if not add the key and value to the existing attributes
			}
		}

		return $existingAttributes;
	}
}