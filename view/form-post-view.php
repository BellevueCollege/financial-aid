<?php
require_once('faform-view.php');
Class Form_Post_View extends Faform_View{
	protected $post;
	public function __construct($controller,$model,$post){
		parent::__construct($controller,$model);
		$this->post = $post;
	}


	function form_post_validation()
	{
		
		$validation_form_errors = $this->controller->validate_form($this->post);
		
	}


	protected function set_template_variables() {
		Default_View::set_template_variables();
		$validation_form_errors = $this->controller->validate_form($this->post);
		if(empty($validation_form_errors))
		{
			$save_form_return_value = $this->model->save_form($this->post);
			error_log("save form return value :".$save_form_return_value);
			if($save_form_return_value)
			{
				// send confirmation email
				// get the 
				// if(!empty($this->post['academic_year']))
				// {
					
				// 	$year_range = $this->controller->get_academic_year_range($this->post['academic_year']);
				// 	//user information
				// 	$username = $_SESSION['FA_USERNAME'];
				// 	$user_information = $this->model->get_student_information($username);
				// 	if(!empty($year_range) && !empty($user_information['Email']))
				// 	{
				// 		$email_reply = $this->controller->send_email_confimation($email,$year_range);
				// 	}


				// //
				 $this->template_variables['after_submit_message'] = "Thank You for submitting financial aid application.";
			}
			else
			{
				$this->template_variables['after_submit_message'] = "An unexpected error occured due to which for did not get saved.";
			}
		}
		else
		{
			if(!empty($validation_form_errors['submit']))
			{
				//Form did not get submitted via standard
				$this->template_variables['after_submit_message'] = "Form did not get submitted.";
			}
			else
			{
				$this->model->set_template_uri('template/faform-template.php');
				$this->template_variables['template_uri'] = $this->model->get_template_uri();
				parent::set_template_variables();
				$this->template_variables['validation_form_errors'] = $validation_form_errors;
				//set the existing form values
				$this->template_variables['selected_academic_year'] = isset($this->post['academic_year']) ? $this->post['academic_year'] : '';
				$this->template_variables['selected_attend_summer'] = isset($this->post['attend_summer']) ? $this->post['attend_summer'] : '';
				$this->template_variables['selected_attend_college'] = isset($this->post['attend_college']) ? $this->post['attend_college'] : '';
				$this->template_variables['selected_hold_college_degree'] = isset($this->post['hold_college_degree']) ? $this->post['hold_college_degree'] : '';
				$this->template_variables['selected_type_of_degree'] = isset($this->post['type_of_degree']) ? $this->post['type_of_degree'] : '';
				$this->template_variables['selected_program_of_study'] = isset($this->post['program_of_study']) ? $this->post['program_of_study'] : '';
				$this->template_variables['selected_third_party_funding'] = isset($this->post['third_party_funding']) ? $this->post['third_party_funding'] : '';
				$this->template_variables['selected_funding_amount'] = isset($this->post['funding_amount']) ? $this->post['funding_amount'] : '';
				$this->template_variables['selected_funding_source'] = isset($this->post['funding_source']) ? $this->post['funding_source'] : '' ;
				$this->template_variables['selected_apply_for_fa'] = isset($this->post['apply_for_fa']) ? $this->post['apply_for_fa'] : '';
				$this->template_variables['selected_types_of_loan'] = isset($this->post['types_of_loan']) ? $this->post['types_of_loan'] : '';
				$this->template_variables['selected_require_loan_quarters'] = isset($this->post['require_loan_quarters']) ? $this->post['require_loan_quarters'] : '';
				$this->template_variables['selected_anticipated_credits_for_quarter'] = $this->controller->get_anticipated_credits($this->post);				
				$this->template_variables['selected_expected_graduation_date'] = isset($this->post['expected_graduation_date']) ? $this->post['expected_graduation_date'] : '';
				$this->template_variables['selected_release_student_info_box1'] = isset($this->post['release_student_info_box1']) ? $this->post['release_student_info_box1'] : ''; 
				$this->template_variables['selected_release_student_info_box2'] = isset($this->post['release_student_info_box2']) ? $this->post['release_student_info_box2'] : ''; 
				$this->template_variables['selected_auth_rep_name1'] = isset($this->post['auth_rep_name1']) ? $this->post['auth_rep_name1'] : '';
				$this->template_variables['selected_auth_rep_name2'] = isset($this->post['auth_rep_name2']) ? $this->post['auth_rep_name2'] : '';  
				$this->template_variables['selected_fa_contract_agreement'] = isset($this->post['fa_contract_agreement']) ? $this->post['fa_contract_agreement'] : ''; 
				$this->template_variables['selected_signature'] = isset($this->post['signature']) ? $this->post['signature'] : ''; 

			}
		}
	}
}

?>