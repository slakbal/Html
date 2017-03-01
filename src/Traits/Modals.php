<?php

namespace Slakbal\HtmlBs4\Traits;

trait Modals
{
	public function restoreModal( $id )
	{
		return $this->modal( $id, $title = '', $body = '', $method = 'POST', $submitBtnName = trans( 'actions.restore' ), $submitBtnType = 'warning', $submitBtnSize = 'md' );
	}


	public function deleteModal( $id )
	{
		return $this->modal( $id, $title = '', $body = '', $method = 'DELETE', $submitBtnName = trans( 'actions.delete' ), $submitBtnType = 'danger', $submitBtnSize = 'md' );
	}


	public function activateModal( $id )
	{
		return $this->modal( $id, $title = '', $body = '', $method = 'GET', $submitBtnName = trans( 'actions.activate' ), $submitBtnType = 'success', $submitBtnSize = 'md' );
	}


	public function deactivateModal( $id )
	{
		return $this->modal( $id, $title = '', $body = '', $method = 'DELETE', $submitBtnName = trans( 'actions.deactivate' ), $submitBtnType = 'warning', $submitBtnSize = 'md' );
	}


	public function confirmModal( $id )
	{
		return $this->modal( $id, $title = '', $body = '', $method = 'POST', $submitBtnName = trans( 'actions.confirm' ), $submitBtnType = 'primary', $submitBtnSize = 'md' );
	}


	public function retryModal( $id )
	{
		return $this->modal( $id, $title = '', $body = '', $method = 'GET', $submitBtnName = trans( 'actions.confirm' ), $submitBtnType = 'primary', $submitBtnSize = 'md' );
	}


	public function cancelModal( $id )
	{
		return $this->modal( $id, $title = '', $body = '', $method = 'DELETE', $submitBtnName = trans( 'actions.cancel' ), $submitBtnType = 'warning', $submitBtnSize = 'md' );
	}


	public function modal( $id, $title, $body, $method, $submitBtnName, $submitBtnType = 'primary', $submitBtnSize = 'md' )
	{
		$out = '<div class="modal fade" id="' . $id . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">' . $title . '</h4>
                                </div>
                                <div class="modal-body">' . $body . '</div>
                                <div class="modal-footer">';
		$out .= $this->open( [
			'id'     => $id . 'Form',
			'method' => $method,
			'class'  => 'form-vertical',
		] );
		$out .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . trans( 'actions.close' ) . '</button>';
		$out .= $this->submitButton( $submitBtnName, $tooltip = null, $disabled = false, $type = $submitBtnType, $size = $submitBtnSize, $id . 'Submit' );
		$out .= $this->close();
		$out .= '        </div>
                            </div>
                        </div>
                    </div>';

		return $out;
	}


	public function modalConfirmButton( $url, $label, $eventName, $modalTitle = '', $modalBody = '', $state = null, $type = null, $attributes = [ ] )
	{

		$attributes = array_merge( (array)$attributes, [ 'class' => $this->getButtonTypeAndSize( $state, $type ) . ' ' . $eventName ] );
		$attributes = array_merge( (array)$attributes, [
			'data-title'   => $modalTitle,
			'data-content' => $modalBody,
			'onClick'      => 'return false;',
		] );

		return $this->html->link( $url, $label, $attributes, $secure = null );
	}


	public function deleteModalButton(
		$href, $name = '', $tooltip = '', $eventName, $modalTitle = '', $modalBody = '', $disabled = false, $type = 'danger', $size = 'md', $attributes = [ ]
	)
	{
		if( is_null( $name ) || $name == '' ) {
			$name = '<span class="glyphicon glyphicon-trash"></span>';
		}

		//ensure the event name is added to the class property so that jquery can select these by $eventName
		if( array_key_exists( 'class', $attributes ) ) {
			$attributes[ 'class' ] .= ' ' . $eventName;
		}
		else {
			$attributes[ 'class' ] = $eventName;
		}
		$attributes = array_merge( (array)$attributes, [
			'data-title'   => $modalTitle,
			'data-content' => $modalBody,
			'onClick'      => 'return false;',
		] );

		return $this->linkButton( $href, $name, $tooltip, $disabled, $type, $size, $attributes );
	}


	public function cancelModalButton(
		$href, $name = '', $tooltip = '', $eventName, $modalTitle = '', $modalBody = '', $disabled = false, $type = 'warning', $size = 'md', $attributes = [ ]
	)
	{
		if( is_null( $name ) || $name == '' ) {
			$name = '<span class="glyphicon glyphicon-remove"></span>';
		}

		//ensure the event name is added to the class property so that jquery can select these by $eventName
		if( array_key_exists( 'class', $attributes ) ) {
			$attributes[ 'class' ] .= ' ' . $eventName;
		}
		else {
			$attributes[ 'class' ] = $eventName;
		}
		$attributes = array_merge( (array)$attributes, [
			'data-title'   => $modalTitle,
			'data-content' => $modalBody,
			'onClick'      => 'return false;',
		] );

		return $this->linkButton( $href, $name, $tooltip, $disabled, $type, $size, $attributes );
	}


	public function restoreModalButton(
		$href, $name = '', $tooltip = '', $eventName, $modalTitle = '', $modalBody = '', $disabled = false, $type = 'warning', $size = 'md', $attributes = [ ]
	)
	{
		if( is_null( $name ) || $name == '' ) {
			$name = '<span class="glyphicon glyphicon-repeat"></span>';
		}

		//ensure the event name is added to the class property so that jquery can select these by $eventName
		if( array_key_exists( 'class', $attributes ) ) {
			$attributes[ 'class' ] .= ' ' . $eventName;
		}
		else {
			$attributes[ 'class' ] = $eventName;
		}
		$attributes = array_merge( (array)$attributes, [
			'data-title'   => $modalTitle,
			'data-content' => $modalBody,
			'onClick'      => 'return false;',
		] );

		return $this->linkButton( $href, $name, $tooltip, $disabled, $type, $size, $attributes );
	}


	public function activateModalButton(
		$href, $name = '', $tooltip = '', $eventName, $modalTitle = '', $modalBody = '', $disabled = false, $type = 'warning', $size = 'md', $attributes = [ ]
	)
	{
		if( is_null( $name ) || $name == '' ) {
			$name = '<span class="glyphicon glyphicon-repeat"></span>';
		}

		//ensure the event name is added to the class property so that jquery can select these by $eventName
		if( array_key_exists( 'class', $attributes ) ) {
			$attributes[ 'class' ] .= ' ' . $eventName;
		}
		else {
			$attributes[ 'class' ] = $eventName;
		}
		$attributes = array_merge( (array)$attributes, [
			'data-title'   => $modalTitle,
			'data-content' => $modalBody,
			'onClick'      => 'return false;',
		] );

		return $this->linkButton( $href, $name, $tooltip, $disabled, $type, $size, $attributes );
	}
}