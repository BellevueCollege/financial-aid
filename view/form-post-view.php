<?php
require_once('faform-view.php');
Class Form_Post_View extends Faform_View{
	//protected $post;
	public function __construct($controller,$model){
		parent::__construct($controller,$model);
		//$this->post = $post;
	}



	protected function set_template_variables() {
		Default_View::set_template_variables();		
		$validation_form_errors = $this->controller->validate_form();		
		if(empty($validation_form_errors))
		{
			$save_form_return_value = $this->model->save_form();			
			if($save_form_return_value)
			{
				$academic_year = $this->model->get_academic_year_pv();
				
				 if(!empty($academic_year))
				 {
					
				 	$year_range = $this->controller->get_academic_year_range($academic_year);				 
					$this->template_variables['year_range'] = $year_range;					
				}
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
				$this->template_variables['selected_academic_year'] = $this->model->get_academic_year_pv();
				$this->template_variables['selected_attend_summer'] = $this->model->get_attend_summer_pv() ;
				$this->template_variables['selected_attend_college'] = $this->model->get_attend_college_pv();
				$this->template_variables['selected_hold_college_degree'] = $this->model->get_hold_college_degree_pv();
				$this->template_variables['selected_type_of_degree'] = $this->model->get_type_of_degree_pv();
				$this->template_variables['selected_program_of_study'] = $this->model->get_program_of_study_pv();
				$this->template_variables['selected_third_party_funding'] = $this->model->get_third_party_funding_pv();
				$this->template_variables['selected_funding_amount'] = $this->model->get_funding_amount_pv();
				$this->template_variables['selected_funding_source'] = $this->model->get_funding_source_pv() ;
				$this->template_variables['selected_apply_for_fa'] = $this->model->get_apply_for_fa_pv() ;
				$this->template_variables['selected_types_of_loan'] = $this->model->get_types_of_loan_pv();
				$this->template_variables['selected_require_loan_quarters'] = $this->model->get_require_loan_quarters_pv();
				$this->template_variables['selected_anticipated_credits_for_quarter'] = $this->model->get_anticipated_credits_for_quarter_pv();				
				$this->template_variables['selected_expected_graduation_date'] = $this->model->get_expected_graduation_date_pv();
				$this->template_variables['selected_release_student_info_box1'] = $this->model->get_release_student_info_box1_pv(); 
				$this->template_variables['selected_release_student_info_box2'] = $this->model->get_release_student_info_box2_pv(); 
				$this->template_variables['selected_auth_rep_name1'] = $this->model->get_auth_rep_name1_pv();
				$this->template_variables['selected_auth_rep_name2'] = $this->model->get_auth_rep_name2_pv();  
				$this->template_variables['selected_fa_contract_agreement'] = $this->model->get_fa_contract_agreement_pv(); 
				$this->template_variables['selected_signature'] = $this->model->get_signature_pv(); 

			}
		}
	}
}

?>