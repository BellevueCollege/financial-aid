<?php
	require_once('faform-controller.php');
	//require_once('view/form-post-view.php');
	Class Form_Post_Controller extends Faform_Controller{
		protected $model; // model object
		const ACADEMIC_YEAR = 'Choose the Academic Year(s) you would like to apply for field is required.';
		const ATTEND_SUMMER = 'Do you plan to attend during the summer? field is required.';
		const ATTEND_COLLEGE = 'Have you previously attended a college or university? field is required.';
		const HOLD_COLLEGE_DEGREE = 'Do you hold a college degree, including degrees outside the US? field is required.';
		const TYPE_OF_DEGREE = 'If yes, what type of degree do you hold? field is required.';
		const PROGRAM_OF_STUDY = 'Your intended program of study field is required.';
		const THIRD_PARTY_FUNDING = 'Are you receiving any outside assistance or third party funding including, but not limited to, scholarships, DVR or the state tuition waiver for state employees? field is required.';
		const FUNDING_AMOUNT = 'Funding Amount field is required.';		
		const FUNDING_SOURCE = 'Funding source field is required. ';		
		const APPLY_FOR_FA = 'Would you like to apply for financial aid loans? field is required.';
		const TYPES_OF_LOAN = 'Types of Loans field is required.';
		const REQUIRE_LOAN_QUARTERS = 'Choose the Quarters you will require loans for? field is required.';
		const EXPECTED_GRADUATION_DATE = 'Expected Graduation Date field is required.';		
		const FA_CONTRACT_AGREEMENT = 'I understand that if I do not follow the financial aid contract it may result in the loss of my financial aid field is required.';
		const SIGNATURE = 'Name field is required.';
		

		public function __construct( $model) {
			parent::__construct( $model );
			
		}
/*
	Validate form fields
	Return error array's
*/
		function validate_form($post)
		{
			$errors = array();
			
			
			//validate each field one by one
			if(empty($post) || !isset($post['submit']))
			{
				$errors['Submit'] = "Form did not get submit";
				return $errors;
			}
			else
			{
				/*
					empty() does not generate a warning if the variable does not exist. That means empty() is essentially the concise equivalent to !isset($var) || $var == false.
					Used is_null() for post variables having '0' as a valid value since empty() considers 0 as well.
				*/
				if(empty($post['academic_year'])) 
					$errors[] = self::ACADEMIC_YEAR;
					

				if(!isset($post['attend_summer']) || is_null($post['attend_summer']))
					$errors[] = self::ATTEND_SUMMER;
					

				if(!isset($post['attend_college']) || is_null($post['attend_college']))
					$errors[] =  self::ATTEND_COLLEGE;
					
				if(isset($post['attend_college']) && $post['attend_college'] == '1')
				{
					if(!isset($post['hold_college_degree']) || is_null($post['hold_college_degree']))
						$errors[] =  self::HOLD_COLLEGE_DEGREE;
					if(isset($post['hold_college_degree']) && $post['hold_college_degree'] == '1') 
					{
						if(empty($post['type_of_degree']))
							$errors[] = self::TYPE_OF_DEGREE;
					}
				}

				if(empty($post['program_of_study']))
					$errors[] = self::PROGRAM_OF_STUDY;

				if(!isset($post['third_party_funding'])  || is_null($post['third_party_funding']))
					$errors[] = self::THIRD_PARTY_FUNDING;
				if(isset($post['third_party_funding']) && $post['third_party_funding'] == '1' )	
				{
					if(empty($post['funding_amount']))
						$errors[] = self::FUNDING_AMOUNT;
					else if(isset($GLOBALS['FUNDING_AMOUNT_LENGTH']) && (floatval($post['funding_amount']) >= $GLOBALS['FUNDING_AMOUNT_LENGTH']))
					{
						$errors[] = 'Funding amount field value should be less than '. $GLOBALS['FUNDING_AMOUNT_LENGTH'];;
					}


					if(empty($post['funding_source']))
						$errors[] = self::FUNDING_SOURCE;
					else if(isset($GLOBALS['FUNDING_SOURCE_LENGTH']) && $post['funding_source'] >= $GLOBALS['FUNDING_SOURCE_LENGTH'])
					{
						$errors[] = 'The length of funding source field should be less than '. $GLOBALS['FUNDING_SOURCE_LENGTH'] .' characters.';;
					}
				}
				

				if(!isset($post['apply_for_fa']) || is_null($post['apply_for_fa']))
					$errors[] = self::APPLY_FOR_FA;
				
				if(isset($post['apply_for_fa']) && $post['apply_for_fa'] == '1')
				{
					if(empty($post['types_of_loan'])) 
						$errors[] = self::TYPES_OF_LOAN;
					if(empty($post['require_loan_quarters']))
					{
						$errors[] = self::REQUIRE_LOAN_QUARTERS;
					}
					
					else
					{	
						for($i=0;$i<count($post['require_loan_quarters']);$i++)
						{
							$anticipated_credits_for_quarter = 'anticipated_credits_for_quarter_'.$post['require_loan_quarters'][$i];
							if(!empty($post['require_loan_quarters'][$i]) && empty($post[$anticipated_credits_for_quarter]))
							{
								$quarter_title = $this->model->get_year_quarter_title($post['require_loan_quarters'][$i]);
								$errors[] = $quarter_title.' field is required';
							}
						}
						
					} 
				} 

				if(empty($post['expected_graduation_date']))
				{
					$errors[] = self::EXPECTED_GRADUATION_DATE;
				}

				if(!empty($post['auth_rep_name1']) && isset($GLOBALS['AUTH_REP_NAME_LENGTH']) && strlen($post['auth_rep_name1']) > $GLOBALS['AUTH_REP_NAME_LENGTH'])
				{

					$errors[] = 'MaxLength allowed for Authorized Representative field is '.$GLOBALS['AUTH_REP_NAME_LENGTH'];
				}
				if(!empty($post['auth_rep_name2']) && isset($GLOBALS['AUTH_REP_NAME_LENGTH']) && strlen($post['auth_rep_name2']) > $GLOBALS['AUTH_REP_NAME_LENGTH'])
				{

					$errors[] = 'MaxLength allowed for Authorized Representative field is '.$GLOBALS['AUTH_REP_NAME_LENGTH'];
				}				

				if(empty($post['fa_contract_agreement']))
				{
					$errors[] = self::FA_CONTRACT_AGREEMENT;
				}

				if(empty($post['signature']))
				{
					$errors[] = self::SIGNATURE ;
				}
				else if(isset($GLOBALS['SIGNATURE_LENGTH']) && (strlen($post['signature']) > $GLOBALS['SIGNATURE_LENGTH']))
				{
					$errors[] = 'MaxLength for Name field is '.$GLOBALS['SIGNATURE_LENGTH']. ' characters.';;
				}


			}
			return $errors;
		} // end of validate_form()
/*
	Get the anticipated credits for selected quarter , key value pair
*/
		function get_anticipated_credits($post)
		{
			$get_anticipated_credits = array();
			if(!empty($post['require_loan_quarters']))
			{
				for($i=0;$i<count($post['require_loan_quarters']);$i++)
				{
					if(!empty($post['require_loan_quarters'][$i]))
					{
						$anticipated_credits_for_quarter = 'anticipated_credits_for_quarter_'.$post['require_loan_quarters'][$i];
						if(!empty($post[$anticipated_credits_for_quarter]))
						{
							$get_anticipated_credits[$post['require_loan_quarters'][$i]] = $post[$anticipated_credits_for_quarter];
						}
					}
				}
			}
			return $get_anticipated_credits;
		}

/*
	Get Academic Year for financial aid application (eg: 2015-2016) for the given summer quarter id 
*/

function get_academic_year_range($summer_quarter_id)
{
	$year_range = '';
	if(!empty($summer_quarter_id))
	{
		$get_summer_quarter_title = $this->model->get_year_quarter_title($summer_quarter_id);
		if(!empty($get_summer_quarter_title))
		{
			$string_split = explode(' ', $get_summer_quarter_title);
			$year_value = $string_split[0];
			$year_range = $year_value . '-'.($year_value+1);
		}
	}
	return $year_range;
}
/*
	Send a confirmation email to the student for submitting financial aid application
*/
	function send_email_confimation($email,$year_range)
	{
		$subject = '**'.$year_range.' BC Financial Aid Application Submitted**';
		$message = 'Thank you!   Your '.$year_range.' BC Financial Aid Application has been submitted to the Financial Aid office.';
		$message .= ' Please retain a copy of this email for your records.';
		$message .= ' If you have not done so already, please complete the 2015-16 Free Application for Federal Student Aid (FAFSA).';
		$message .= ' If you have submitted all required documents to our office, you can expect to hear from our office between 30-90 days depending on the time of year you applied.';
		$message .= ' sCheck your BC email account often for any important notifications from our office.';

		$message .= 'Unsure if you submitted everything?';
		$message .= ' Check your financial aid status on the FA portal (imbed the URL:  http://fa.bellevuecollege.edu/status here).';
		$message .= 'If you missed the filing deadline (imbed the URL:  http://fa.bellevuecollege.edu/apply/deadlines here) for the quarter in which you wish to start receiving financial aid, you must pay your own tuition.

Contact the Financial Aid office if you have any questions.
'
	}

	}
?>