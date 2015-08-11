<?php

/*
	Currently application is using CAS for authentication. In future we may use SAML 	
*/
$GLOBALS['AUTH_TYPE'] = ''; //eg: 'CAS'

/* 
	CAS Configuration
*/

$GLOBALS['CAS_SERVER_HOSTNAME'] = '';
$GLOBALS['CAS_SERVER_PORT'] = ; // eg: 443
$GLOBALS['CAS_SERVER_PATH'] = ''; // eg: /cas 
$GLOBALS['CAS_VERSION'] = ''; //eg: 2.0
$GLOBALS['CAS_LIBRARY_PATH'] = ''; // eg: library/phpCAS-1.3.2/CAS.php

/* Database Configuration */
$GLOBALS['DATABASE_DSN'] = ''; // Data source name
$GLOBALS['DATABASE_USER'] = ''; // Username to connect to data source
$GLOBALS['DATABASE_PASSWORD'] = ''; // Password to connect to data source

/**/
$GLOBALS['BASE_URI'] = ''; // eg: /financial-aid

/*Globals configuration*/
$GLOBALS['GLOBALS_PATH'] = '';// File system path where the library globals can be found
$GLOBALS['GLOBALS_URL'] = ''; // URL where the library globals can be referenced


?>