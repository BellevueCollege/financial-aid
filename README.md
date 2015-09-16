# financial-aid

Financial-Aid application provides user to apply for financial aid by allowing them to fill out a form.

# Installation Steps

* Clone financial aid git repo
* Create a directory on the test/production server.
* Copy the cloned files to the directory created. 
* Set the config variables as explained below:
    ** Copy config-sample.php file and rename the new file to config.php.
    ** Follow the examples in config-sample comments to set the values of the config variables.
* You must have PHP version > 5.3
* Make sure the application user account has access to the database, tables and stored procedure's.

# Acceptance Criteria

* User should be authenticated to submit the form.
* User should not be able to submit more than 1 application for a academic year.
* If current month is greater than 'Conditional_Month' configuration than form should display 2 academic years otherwise only one should be displayed.
* If the config settings are missing values you should get an error.
* If the URL path is not correct you should get a 404 error.
* If the logged in user is not a student, he/she should not be able to submit the application.
* If Java-script is not enabled in the browser form should have server side validations and user should still be able to submit it.

* Following fields are required:
