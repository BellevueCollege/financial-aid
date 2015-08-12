<?php


require_once('config.php');
require_once('controller/cas-authentication-controller.php');
require_once('model/faform-model.php');
require_once('controller/faform-controller.php');

// Define application version nuuber
define( 'VERSION_NUMBER', '1.0' );

// Initialize username
$username = "";
if($GLOBALS['AUTH_TYPE'] == "CAS")
{
	/* Authenticate with CAS */

	$cas_controller = new Cas_Authentication();

	/* Check if user is authenticated */

	if(!$cas_controller->is_authenticated())
	{
		$cas_controller->authenticate();
	}

	$username = $cas_controller->get_authenticated_username();
	$_SESSION["FA_USERNAME"] = $username;		
		
}
/*
Get User information
*/
// $default = new Default_Model();
// $get_student_information = $default->get_student_information($username);

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

$application_uri = substr( $request_uri, strlen( $base_uri ) );
//echo '\n'. $request_uri;
 

switch ($application_uri) {
	case 'application':
		require_once('view/faform-view.php');
		$form_post_url = 'https://'. $request_host. $base_uri. 'application/save';
		$template_uri = 'template/faform-template.php';
		$model = new Faform_Model($template_uri,$form_post_url);
		$controller = new Faform_Controller($model);
		$view = new Faform_View($controller , $model);
		echo $view->get_output();
		break;
	case 'application/save':
		
		break;
	
	default:
		require_once('view/default-view.php');
		$model = new Default_Model(
			'template/error-404-template.php');
		$view = new Default_View( NULL, $model );

		// View and controller actions.
		header( $_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found' );
		echo $view->get_output();
		break;
}


?>
