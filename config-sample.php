<?php

/*
 * Note: This config is set up for auto-deployment through Azure DevOps. 
 * Be aware that if your environment is set up to deploy automatically,
 * the contents of this config will be reset based on variables in DevOps.
 * Any changes made should be mirrored in Azure Devops to avoid losing work.
*/

/*
	Currently uses SAML for authentication. CAS is a legacy option
*/
$GLOBALS['AUTH_TYPE'] = '#{authType}#'; //eg: 'CAS' or 'SAML'

/* SAML Configuration */
$GLOBALS['SAML_LIBRARY_PATH'] = '#{samlLibraryPath}#'; // Path to lib/_autoload.php in SimpleSAMLphp
$GLOBALS['AUTH_SOURCE'] = '#{authSource}#'; // Name of authentication service provider to use (eg 'bc-adfs-sp')

/* CAS Configuration */
$GLOBALS['CAS_SERVER_HOSTNAME'] = '#{casServerHostname}#';
$GLOBALS['CAS_SERVER_PORT'] = '#{casServerPort}#'; // eg: 443
$GLOBALS['CAS_SERVER_PATH'] = '#{casServerPath}#'; // eg: /cas 
$GLOBALS['CAS_VERSION'] = '#{casVersion}#'; //eg: 2.0
$GLOBALS['CAS_LIBRARY_PATH'] = '#{casLibraryPath}#'; // eg: library/phpCAS-1.3.2/CAS.php

/* Database Configuration */
$GLOBALS['DATABASE_DSN'] = '#{databaseDSN}#'; // Data source name
$GLOBALS['DATABASE_USER'] = '#{databaseUser}#'; // Username to connect to data source
$GLOBALS['DATABASE_PASSWORD'] = '#{databasePassword}#'; // Password to connect to data source

/**/
$GLOBALS['BASE_URI'] = '#{baseURI}#'; // This is the directory in which all the application files are located, eg: /financial-aid

/*Globals configuration*/
$GLOBALS['GLOBALS_PATH'] = '#{globalsPath}#';// File system path where the library globals can be found
$GLOBALS['GLOBALS_URL'] = '#{globalsURL}#'; // URL where the library globals can be referenced

/* 
	Financial Aid application configuration 
	Replace the 0's with actual values
*/
$GLOBALS['FUNDING_AMOUNT_LENGTH'] = #{fundingAmountLength}#; // Length of Funding amount field
$GLOBALS['FUNDING_SOURCE_LENGTH'] = #{fundingSourceLength}#;// Length of Funding source field
$GLOBALS['AUTH_REP_NAME_LENGTH'] = #{authRepNameLength}#; // Assuming Authorized Representative's Name both field's are of same length in the database. 
$GLOBALS['SIGNATURE_LENGTH'] = #{signatureLength}#; // Length of signature field

$GLOBALS['FA_SITE_URL'] = '#{faSiteURL}#'; // URL for main FA wensite (used for logout redirect)
$GLOBALS['STATUS_URL'] = '#{statusURL}#'; // URL to check the status of financial aid application
$GLOBALS['DEADLINES'] = '#{deadlines}#'; // URL to check deadlines
$GLOBALS['RELEASE_AUTHORIZATION_FORM_URL'] = '#{releaseAuthorizationFormURL}#'; // URL to Release authorization form url
$GLOBALS['LOAN_DETAILS'] = '#{leanDetails}#'; // eg: http://fa.bellevuecollege.edu/fa/loans/stafford/details";
/*
	Conditional Month value is used to decide if 1 or 2 academic year needs to be displayed.
	Provide the month as a number eg: For Jan- 1, Feb - 2, ....so on.
*/
$GLOBALS['CONDITIONAL_MONTH'] = 7; 
// Condition to display next Year's YRQ if current month is greater than Sept - 9
$GLOBALS['CONDITION_TO_DISPLAY_NEXT_YRQ'] = 9;
