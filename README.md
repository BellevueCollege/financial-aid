# Financial Aid Application Form

The financial aid application form allows students to apply for financial aid.

## Installation steps

* Clone financial aid git repo.
* Create a directory on the test/production server.
* Copy the cloned files to the directory created. 
* Set the config variables as explained below:
    * Copy config-sample.php file and rename the new file to config.php.
    * Follow the examples in config-sample comments to set the values of the config variables.
    * For further reference, please refer config file located here:
    https://github.com/BellevueCollege/docs/tree/master/financial-aid-form
* You must have PHP version > 5.3.
* Make sure the application user account has access to the database, tables, and stored procedures.

## Acceptance Criteria

* User should be authenticated to submit the form.
* User should not be able to submit more than 1 application for a academic year.
* If current month is greater than 'Conditional_Month' configuration than form should display 2 academic years otherwise only one should be displayed.
* If the config settings are missing values you should get an error.
* If the URL path is not correct you should get a 404 error.
* If the logged in user is not a student, he/she should not be able to submit the application.
* If JavaScript is not enabled in the browser, form should have server side validations and user should still be able to submit it.


### Field validation info
* **Academic year**
    - required
    - Should not be able to submit more than one application for a given academic year
* **Plan to attend during summer**
    - required
* **Previously attended college or university**
    - required
* **Hold a college degree**
    - Dependence: required if previously attended college or university
* **Type of degree**
    - Dependence: required if hold college degree
* **Program of study**
    - required
* **Third-party funding**
    - required
* **Funding amount**
    - Dependence: required if receive third-party funding
    - Should be valid dollar/numerical amount
* **Other funding source**
    - Dependence: required if receive third-party funding
* **Like to apply for financial aid loans**
    - required
* **Types of loans**
    - Dependence: required if apply for financial aid loans
* **Loan quarters**
    - Dependence: required if apply for financial aid loans
* **Anticipated credits for quarter**
    - Dependence: required for each selected loan quarter
* **Expected graduation date:**
    - required
