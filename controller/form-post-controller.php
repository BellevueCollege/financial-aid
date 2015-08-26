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
		function validate_form()
		{
			$errors = array();
			
			
			//validate each field one by one
			//if(empty($post) || !isset($post['submit']))
			if($this->model->get_submit_pv() === null)			
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
				//if(empty($post['academic_year'])) 
				if($this->model->get_academic_year_pv() === null)
					$errors[] = self::ACADEMIC_YEAR;
					

				if($this->model->get_attend_summer_pv() === null)
					$errors[] = self::ATTEND_SUMMER;
					

				if($this->model->get_attend_college_pv() === null)
					$errors[] =  self::ATTEND_COLLEGE;					
				else if($this->model->get_attend_college_pv() == '1')
				{
					if($this->model->get_hold_college_degree_pv() === null)
						$errors[] =  self::HOLD_COLLEGE_DEGREE;
					else if($this->model->get_hold_college_degree_pv() == '1') 
					{
						if($this->model->get_type_of_degree_pv() === null)
							$errors[] = self::TYPE_OF_DEGREE;
					}
				}
				//var_dump("program of study :".$this->model->get_program_of_study_pv());
				if($this->model->get_program_of_study_pv() === null)
					$errors[] = self::PROGRAM_OF_STUDY;

				if($this->model->get_third_party_funding_pv() === null)
					$errors[] = self::THIRD_PARTY_FUNDING;
				else if($this->model->get_third_party_funding_pv() == '1' )	
				{
					if($this->model->get_funding_amount_pv() === null)
						$errors[] = self::FUNDING_AMOUNT;
					else if(floatval($this->model->get_funding_amount_pv()) >= $GLOBALS['FUNDING_AMOUNT_LENGTH'])
					{
						$errors[] = 'Funding amount field value should be less than '. $GLOBALS['FUNDING_AMOUNT_LENGTH'];;
					}

					$funding_source_value = $this->model->get_funding_source_pv();
					if($funding_source_value === null)
						$errors[] = self::FUNDING_SOURCE;
					else if(strlen($funding_source_value) >= $GLOBALS['FUNDING_SOURCE_LENGTH'])
					{
						$errors[] = 'The length of funding source field should be less than '. $GLOBALS['FUNDING_SOURCE_LENGTH'] .' characters.';;
					}
				}
				

				if($this->model->get_apply_for_fa_pv() === null)
					$errors[] = self::APPLY_FOR_FA;				
				else if($this->model->get_apply_for_fa_pv() == '1')
				{
					if($this->model->get_types_of_loan_pv() === null) 
						$errors[] = self::TYPES_OF_LOAN;
					if($this->model->get_require_loan_quarters_pv() === null)
					{
						$errors[] = self::REQUIRE_LOAN_QUARTERS;
					}					
					else
					{	
						$loan_quarters = $this->model->get_require_loan_quarters_pv();
						for($i=0;$i<count($loan_quarters);$i++)
						{
							$anticipated_credits_for_quarter = $this->model->get_anticipated_credits_for_quarter_pv();
							if(!empty($loan_quarters[$i]) && !array_key_exists($loan_quarters[$i],$anticipated_credits_for_quarter))
							{									
								$quarter_title = $this->model->get_year_quarter_title($loan_quarters[$i]);								
								$errors[] = $quarter_title.' field is required';								
							}
						}
						
					} 
				} 

				if($this->model->get_expected_graduation_date_pv() === null)
				{
					$errors[] = self::EXPECTED_GRADUATION_DATE;
				}
				$auth_rep_name1_value = $this->model->get_auth_rep_name1_pv();
				if(!empty($auth_rep_name1_value) && strlen($auth_rep_name1_value) > $GLOBALS['AUTH_REP_NAME_LENGTH'])
				{

					$errors[] = 'MaxLength allowed for Authorized Representative field is '.$GLOBALS['AUTH_REP_NAME_LENGTH'];
				}
				$auth_rep_name2_value = $this->model->get_auth_rep_name2_pv();
				if(!empty($auth_rep_name2_value) && strlen($auth_rep_name2_value) > $GLOBALS['AUTH_REP_NAME_LENGTH'])
				{

					$errors[] = 'MaxLength allowed for Authorized Representative field is '.$GLOBALS['AUTH_REP_NAME_LENGTH'];
				}				

				if($this->model->get_fa_contract_agreement_pv() === null)
				{
					$errors[] = self::FA_CONTRACT_AGREEMENT;
				}
				$signature_value = $this->model->get_signature_pv();
				if($signature_value === null)
				{
					$errors[] = self::SIGNATURE ;
				}
				else if((strlen($signature_value) > $GLOBALS['SIGNATURE_LENGTH']))
				{
					$errors[] = 'MaxLength for Name field is '.$GLOBALS['SIGNATURE_LENGTH']. ' characters.';;
				}


			}
			return $errors;
		} // end of validate_form()

/*
	Get the anticipated credits for selected quarter , key value pair
*/
	/*
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
		*/

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
			$year_value = $string_split[1];			
			$year_range = $year_value . '-'.($year_value+1);
		}
	}
	return $year_range;
}
/*
	Send a confirmation email to the student for submitting financial aid application
*/
	// function send_email_confimation($email,$year_range)
	// {
	// 	$subject = '**'.$year_range.' BC Financial Aid Application Submitted**';		
	// }

	}
?>