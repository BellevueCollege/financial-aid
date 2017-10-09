<?php

require_once($GLOBALS['SAML_LIBRARY_PATH']);

 class Saml_Authentication{
	
	public $auth;
	public function _construct() {
		$this->auth = $auth;
		
	}
	
	//Get's autheniticated username
	public function get_authenticated_username()
	{
		$username  = null;
		 if($this->is_authenticated())
		{
			$attributes = $this->auth->getAttributes();
			$username = $attributes["uid"][0];			
		} 
		return $username;
	}
	
	public function authenticate()
	{
		$this->auth = new SimpleSAML_Auth_Simple($GLOBALS['AUTH_SOURCE']);
		$this->auth->requireAuth(); // This function will only return if the user is authenticated. If the user isn't authenticated, this function will start the authentication process.
	}
	
	//Check if user is authenticated
	public function is_authenticated()
	{
		if(isset($this->auth))
			return $this->auth->isAuthenticated();
		return null;
	} 
} 
/*
$as = new SimpleSAML_Auth_Simple($GLOBALS['AUTH_SOURCE']);
$as->requireAuth();
$attributes = $as->getAttributes();
var_dump($attributes);

$username = $attributes["uid"][0];
echo $username;
var_dump($_SESSION);
*/
?>