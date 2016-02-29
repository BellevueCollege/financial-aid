<?php

class Default_View {
	protected $controller;
	protected $model;
	protected $template_variables;

	public function __construct($controller,$model){
		$this->controller = $controller;
		$this->model = $model;
		
	}
/*
	Set Template variables and get template HTML output
*/

	public function render(){
		$this->set_template_variables();
		extract( $this->template_variables );
		require( $template_uri );
	}

/*
Sets template variables
*/
protected function set_template_variables(){
	
	$this->template_variables['current_url'] =  $this->model->get_current_url();	
	if(isset($GLOBALS['GLOBALS_PATH']))
		$this->template_variables['globals_path'] = $GLOBALS['GLOBALS_PATH'];
	if(isset($GLOBALS['GLOBALS_URL']))
		$this->template_variables['globals_url'] = $GLOBALS['GLOBALS_URL'];	
	$this->template_variables['template_uri'] = $this->model->get_template_uri();
	$this->template_variables['email'] = $this->model->get_email();
	$this->template_variables['first_name'] = $this->model->get_first_name();
	$this->template_variables['last_name'] = $this->model->get_last_name();
	
	$ssn = $this->model->get_ssn();
	if(!empty($ssn))
	{
		$this->template_variables['ssn'] = true; 
	}
	else
	{
		$this->template_variables['ssn'] = false;
	}

	if(!empty($GLOBALS['FUNDING_AMOUNT_LENGTH']))
		$this->template_variables['funding_amount_length'] = $GLOBALS['FUNDING_AMOUNT_LENGTH'];
	if(!empty($GLOBALS['FUNDING_SOURCE_LENGTH']))
		$this->template_variables['funding_source_length'] = $GLOBALS['FUNDING_SOURCE_LENGTH'];
	if(!empty($GLOBALS['AUTH_REP_NAME_LENGTH']))
		$this->template_variables['auth_rep_name_length'] = $GLOBALS['AUTH_REP_NAME_LENGTH'];
	if(!empty($GLOBALS['SIGNATURE_LENGTH']))
		$this->template_variables['signature_length'] = $GLOBALS['SIGNATURE_LENGTH'];
	if(!empty($GLOBALS['STATUS_URL']))
		$this->template_variables['status_url'] = $GLOBALS['STATUS_URL'];
	if(!empty($GLOBALS['DEADLINES']))
		$this->template_variables['deadlines'] = $GLOBALS['DEADLINES'];
        if(!empty($GLOBALS['RELEASE_AUTHORIZATION_FORM_URL']))
		$this->template_variables['release_authorization_form_url'] = $GLOBALS['RELEASE_AUTHORIZATION_FORM_URL'];
        $form_url = $this->model->get_form_url();
        if(!empty($form_url))
                $this->template_variables['form_url'] = $form_url;
}

}


?>