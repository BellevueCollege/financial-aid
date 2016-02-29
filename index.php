<?php

require_once('config.php');

require_once('model/faform-model.php');
require_once('view/faform-view.php');
require_once('controller/faform-controller.php');

// Define application version nuuber
define( 'VERSION_NUMBER', '1.1' );
/*
	Check if all config variables have values
*/
if(!check_configuration())
	die("One or more of Config variables are not set.");
	
$request_host = $_SERVER['HTTP_HOST'];
$request_uri = $_SERVER['REQUEST_URI'];
$base_uri = rtrim( $GLOBALS['BASE_URI'] , '/' ) . '/';
//echo "\n base uri :".$base_uri;

// Check to make sure we are hosted out of the correct directory.
if ( $base_uri !== substr( $request_uri, 0, strlen( $base_uri ) ) ) {
	$error_message = 'The BASE_URI constant does not match the requested '
		. 'URI. Please review the config.php file and set BASE_URI to '
		. 'the appropriate path'
	;
	throw new Exception( $error_message );
}
// Redirect to HTTPS if the request is made over HTTP.
if ( ! isset( $_SERVER['HTTPS'] ) ) {
	$url = 'https://' . $request_host . $request_uri;
	header( $_SERVER['SERVER_PROTOCOL'] . ' Moved Permanently' );
	header( 'Location: ' . $url );
	exit();
}

// Initialize username
$username = "";
if(isset($GLOBALS['AUTH_TYPE']) && $GLOBALS['AUTH_TYPE'] == "CAS")
{
	require_once('controller/cas-authentication-controller.php');
	/* Authenticate with CAS */
	$cas_controller = new Cas_Authentication();
	
	/* Check if user is authenticated */
	if(!$cas_controller->is_authenticated())
	{
		$cas_controller->authenticate();
	}
	
	$username = $cas_controller->get_authenticated_username();       
        // logout if desired
        if (isset($_REQUEST['logout'])) {
               $cas_controller->logout();
        }
       
	$_SESSION["FA_USERNAME"] = $username;		
		
}
else
{
	die('SSO configuration not valid');
}

$application_uri = rtrim(substr( $request_uri, strlen( $base_uri )) , '/' );
//echo '\n'. $application_uri;
 
switch ($application_uri) {
    /*
     * Load the financial aid application form
     */
	case 'application':		
		$form_post_url = 'https://'. $request_host. $base_uri. 'application/save';
		$template_uri = 'template/faform-template.php';
		$model = new Faform_Model($template_uri,$form_post_url);
		$controller = new Faform_Controller($model);
		$view = new Faform_View($controller , $model);
		echo $view->render();
		break;
    /*
     * Save financial aid form
     */
	case 'application/save':	
		require_once('model/form-post-model.php');
		require_once('controller/form-post-controller.php');
		require_once('view/form-post-view.php');
		$form_post_url = 'https://'. $request_host. $base_uri. 'application/save';
		$template_uri = 'template/after-submission-template.php';
		$model = new Form_Post_Model($template_uri,$form_post_url,$_POST);
		$controller = new Form_Post_Controller($model);
		$view = new Form_Post_View($controller , $model);
		echo $view->render();
		break;
       /*
        * Display error page in case default
        */
	default:
		require_once('view/default-view.php');
		$model = new Default_Model('template/error-404-template.php');
		$view = new Default_View( NULL, $model);
		
		// View and controller actions.
		header( $_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found' );
		echo $view->render();
		break;
}

/*
	Check to make sure all configuration variables are not empty
*/
 function check_configuration()
{	
	if(empty($GLOBALS['AUTH_TYPE']))
		return false;
	if((!empty($GLOBALS['AUTH_TYPE']) && $GLOBALS['AUTH_TYPE'] == 'CAS') && (empty($GLOBALS['CAS_SERVER_HOSTNAME']) || empty($GLOBALS['CAS_SERVER_PORT']) || empty($GLOBALS['CAS_SERVER_PATH']) || empty($GLOBALS['CAS_VERSION']) || empty($GLOBALS['CAS_LIBRARY_PATH'])))
		return false;
	if(empty($GLOBALS['DATABASE_DSN']) || empty($GLOBALS['DATABASE_USER']) || empty($GLOBALS['DATABASE_PASSWORD']))
		return false;
	if(empty($GLOBALS['BASE_URI']))
		return false;
	if(empty($GLOBALS['GLOBALS_PATH']) || empty($GLOBALS['GLOBALS_URL']))
		return false;
	if(empty($GLOBALS['FUNDING_AMOUNT_LENGTH']) || empty($GLOBALS['FUNDING_SOURCE_LENGTH']) || empty($GLOBALS['AUTH_REP_NAME_LENGTH']) || empty($GLOBALS['SIGNATURE_LENGTH']))
		return false;
	if(empty($GLOBALS['STATUS_URL']) || empty($GLOBALS['DEADLINES']) || empty($GLOBALS['CONDITIONAL_MONTH']) || empty($GLOBALS['RELEASE_AUTHORIZATION_FORM_URL']))
		return false;

	return true;
}

?>