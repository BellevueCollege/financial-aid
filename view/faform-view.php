<?php
require_once('default-view.php');

Class Faform_View extends Default_View{


	protected function set_template_variables() {
		
		parent::set_template_variables();
		$this->template_variables['form_post_url'] = $this->model->get_form_post_url();
		//user information		
		$user_sid = $this->model->get_sid();
		
		if(!empty($user_sid))
		{				
				$year_quarter_information = $this->controller->get_academic_year_option_and_values();
				$already_submitted_app_qtr_ids = $this->controller->already_submitted_application_year();
                                //var_dump($already_submitted_app_qtr_ids);
				$this->template_variables["already_submitted_app_qtr_ids"] = $already_submitted_app_qtr_ids;
				$this->template_variables["year_quarter_information"] = $year_quarter_information;
				//Quarters
				$quarters = $this->controller->get_all_quarter_options_available();
				$this->template_variables["quarters"] = $quarters;

				$types_of_loan = $this->model->get_types_of_loan_options();
				$this->template_variables["types_of_loan"] = $types_of_loan;
				$credit_options = $this->model->get_credit_options();
				$this->template_variables["credit_options"] = $credit_options;
				$types_of_degree = $this->model->get_types_of_degree_options();
				$this->template_variables["types_of_degree"] = $types_of_degree;
				$program_of_study_options = $this->model->get_program_of_study_options();
				$this->template_variables["program_of_study_options"] = $program_of_study_options;				
				$expected_graduation_year_array = $this->model->get_expected_graduation_year_array();		
				$this->template_variables["expected_graduation_year_array"] = $expected_graduation_year_array;			
		}
		else
		{
			/*
				If the logged in user does not have a record in student table, update the template
			*/
			
			$this->model->set_template_uri('template/not-a-student-template.php');
			$this->template_variables['template_uri'] = $this->model->get_template_uri();
		}
		// Year Quarter
		




	}
}

?>