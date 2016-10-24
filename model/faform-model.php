<?php

require_once('default-model.php');
class Faform_Model extends Default_Model {
	protected $form_post_url;

	public function __construct($template_uri, $form_post_url){
		parent::__construct($template_uri);

		$this->form_post_url = $form_post_url;

	}
/*
	Get form post url variable value
*/
	public function get_form_post_url()
	{
		return $this->form_post_url;
	}
}


?>
