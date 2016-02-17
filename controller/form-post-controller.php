<?php
	require_once('faform-controller.php');
	//require_once('view/form-post-view.php');
	Class Form_Post_Controller extends Faform_Controller{
		protected $model; // model object
		const ACADEMIC_YEAR = "Select the academic year for which you'd like to apply for financial aid.";
		const ATTEND_SUMMER = "Select whether you plan to attend during the summer.";
		const ATTEND_COLLEGE = "Choose if you have previously attended college or university.";
		const HOLD_COLLEGE_DEGREE = "Choose whether you hold a college degree.";
		const TYPE_OF_DEGREE = "Choose the type(s) of degree(s) you hold.";
		const PROGRAM_OF_STUDY = "Select your intended program of study.";
		const THIRD_PARTY_FUNDING = "Select whether you are receiving scholarship/funding from a third party.";
		const FUNDING_AMOUNT = "Enter the funding amount.";		
		const FUNDING_SOURCE = "Enter additional information about the funding source.";		
		const APPLY_FOR_FA = "Select if you would like to apply for financial aid loans.";
		const TYPES_OF_LOAN = "Choose the type(s) of loans you would like to apply for.";
		const REQUIRE_LOAN_QUARTERS = "Select the quarters for which you will require loans.";
		const EXPECTED_GRADUATION_DATE = "Select your expected graduation date.";
		const FA_CONTRACT_AGREEMENT = "You must check that you understand that if you do not follow the financial aid contract it may result in the loss of financial aid.";
		const SIGNATURE = "Enter your full name as your signature for this application.";
		

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
				$errors['submit'] = "The form was not submitted.";
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
                    $funding_amt = $this->model->get_funding_amount_pv();
                    $funding_amt = str_replace(',', '', $funding_amt);
					if($funding_amt === null)
						$errors[] = self::FUNDING_AMOUNT;
					else if(floatval($funding_amt) >= $GLOBALS['FUNDING_AMOUNT_LENGTH'])
					{
						$errors[] = "The funding amount should be less than ". $GLOBALS['FUNDING_AMOUNT_LENGTH'].".";
					}
					else if(!is_numeric($funding_amt))
					{
						$errors[] = "The funding amount must be a valid number.";
					}                                                     
                                        
					$funding_source_value = $this->model->get_funding_source_pv();
					if($funding_source_value === null)
						$errors[] = self::FUNDING_SOURCE;
					else if(strlen($funding_source_value) >= $GLOBALS['FUNDING_SOURCE_LENGTH'])
					{
						$errors[] = "The length of funding source field should be less than ". $GLOBALS['FUNDING_SOURCE_LENGTH'] ." characters.";
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
								$errors[] = "Select your anticipated credits for ".$quarter_title.".";								
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
					$errors[] = "The authorized representative field cannot be longer than ".$GLOBALS['AUTH_REP_NAME_LENGTH']." characters.";
				}
				$auth_rep_name2_value = $this->model->get_auth_rep_name2_pv();
				if(!empty($auth_rep_name2_value) && strlen($auth_rep_name2_value) > $GLOBALS['AUTH_REP_NAME_LENGTH'])
				{
					$errors[] = "The authorized representative field cannot be longer than ".$GLOBALS['AUTH_REP_NAME_LENGTH']." characters.";
				}				

//				if($this->model->get_fa_contract_agreement_pv() === null)
//				{
//					$errors[] = self::FA_CONTRACT_AGREEMENT;
//				}
//				$signature_value = $this->model->get_signature_pv();
//				if($signature_value === null)
//				{
//					$errors[] = self::SIGNATURE;
//				}
//				else if((strlen($signature_value) > $GLOBALS['SIGNATURE_LENGTH']))
//				{
//					$errors[] = "The name field cannot be longer than ".$GLOBALS['SIGNATURE_LENGTH']. " characters.";
//				}
			}
                        //var_dump($errors);
			return $errors;
		} // end of validate_form()


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

}// end of class
?>