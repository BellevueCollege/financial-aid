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
$GLOBALS['BASE_URI'] = ''; // This is the directory in which all the application files are located, eg: /financial-aid

/*Globals configuration*/
$GLOBALS['GLOBALS_PATH'] = '';// File system path where the library globals can be found
$GLOBALS['GLOBALS_URL'] = ''; // URL where the library globals can be referenced

/* 
	Financial Aid application configuration 
	Replace the 0's with actual values
*/
$GLOBALS['FUNDING_AMOUNT_LENGTH'] = 0; // Length of Funding amount field
$GLOBALS['FUNDING_SOURCE_LENGTH'] = 0;// Length of Funding source field
$GLOBALS['AUTH_REP_NAME_LENGTH'] = 0; // Assuming Authorized Representative's Name both field's are of same length in the database. 
$GLOBALS['SIGNATURE_LENGTH'] = 0; // Length of signature field
$GLOBALS['STATUS_URL'] = ''; // URL to check the status of financial aid application
$GLOBALS['DEADLINES'] = ''; // URL to check deadlines
$GLOBALS['RELEASE_AUTHORIZATION_FORM_URL'] = ''; // URL to Release authorization form url
$GLOBALS['LOAN_DETAILS'] = ""; // eg: http://fa.bellevuecollege.edu/fa/loans/stafford/details";
/*
	Conditional Month value is used to decide if 1 or 2 academic year needs to be displayed.
	Provide the month as a number eg: For Jan- 1, Feb - 2, ....so on.
*/
$GLOBALS['CONDITIONAL_MONTH'] = 7; 

?>