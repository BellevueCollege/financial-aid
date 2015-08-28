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
}

}


?>