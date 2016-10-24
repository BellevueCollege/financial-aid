<?php

class Default_Controller {

	
	protected $model; // model object

	/* Populates the model properties from the constructor parameter. */
	
	public function __construct( $model ) {
		$this->model = $model;
	}
}
?>