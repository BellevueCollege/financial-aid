<?php

//require_once('config/cas-config.php');
//require_once(Cas_Config::CAS_LIBRARY_PATH);
//require_once('library/phpCAS/CAS.php')
//require_once('config.php');

require_once($GLOBALS['CAS_LIBRARY_PATH']);
class Cas_Authentication{

	public function _construct() {

		$this->initialize_cas();

	}

/* Initialize phpCAS */

	function initialize_cas()
	{
		// Enable debugging
		phpCAS::setDebug();

		// Initialize phpCAS			
		phpCAS::client($GLOBALS['CAS_VERSION'], $GLOBALS['CAS_SERVER_HOSTNAME'], $GLOBALS['CAS_SERVER_PORT'], $GLOBALS['CAS_SERVER_PATH']);

		// For production use set the CA certificate that is the issuer of the cert
			// on the CAS server and uncomment the line below
			// phpCAS::setCasServerCACert($cas_server_ca_cert_path);

			// For quick testing you can disable SSL validation of the CAS server.
			// THIS SETTING IS NOT RECOMMENDED FOR PRODUCTION.
			// VALIDATING THE CAS SERVER IS CRUCIAL TO THE SECURITY OF THE CAS PROTOCOL!
			phpCAS::setNoCasServerValidation();
	}

/* Authenticate */

	function authenticate()
	{
		if ( ! class_exists( 'phpCAS' ) ) 
				$this->initialize_cas();
			

			// force CAS authentication
			phpCAS::forceAuthentication();
		
	}

/* Check if user is authenticated */
	function is_authenticated()
	{
		/* Check if user is authenticated */
		if ( ! isset($_SESSION['CAS_INI']) ) 
		{			
			$this->initialize_cas();

		}				
		return phpCAS::isAuthenticated();
	}

/* Get's autheniticated username */
	function get_authenticated_username()
	{
		if ( ! class_exists( 'phpCAS' ) ) 
			$this->initialize_cas();
		return phpCAS::getUser( );
	}


}



?>