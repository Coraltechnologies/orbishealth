<?php


App::import('Component', 'LetterPdf');
ini_set('memory_limit', '512M');
ini_set('max_execution_time', '30000');

Class BuildLettersController extends AppController
{
	var $name = "BuildLetters";
	var $uses = array('User','Communication','Appointment','SlotParent','ConsultingVenue','CaseUser','Template', 'GeneralLetter', 'GeneralLettersEmailDetail', 'CaseMaster','Address', 'ReportMaster', 'CaseAccidentRecord', 'Part35OrAddendumLetter', 'ChaseEmailDetail'); //Added By mskt
	var $helpers = array('Common','Html','Form','Date','Fck','EncryptionFunctions');
	var $layout = "application";
	var $components = array('CommonFunctions','Email','Expert','EncryptionFunctions','File','EncryptionFunctions');

	function beforeFilter() {
		parent::beforeFilter();


		//debug('before');exit;
		$this->paginate['limit'] = Configure::read('paginationLimit');

		$this->Auth->allow('list_templates','create_letter_popup','ajax_fill_case_details_popup','ajax_save_letter_popup','create_or_edit_template','create_letter','view_letters','ajax_prefill_template_details','ajax_fill_case_details','ajax_get_case_user_list','ajax_get_case_subuser_list','ajax_edit_get_case_subuser_list','ajax_edit_get_case_user_list','delete_template','download_pdf_view','emailer','output_file','delete_letter','letter_lists','tempate_lists_ajax','letter_emailer','view_letter_pdf','save_preview_letter','show_preview_letter','show_preview_letter_popup','update_letter_content','preview_list_letters','get_instructor_address','get_expert_address','print_letter_preview','download_print_pdf_view','update_letter_content_popup','ajax_instruction_letter','cancel_instruction_letter','ajax_cancel_letter', 'report_chase_email', 'addendum_chase_email', 'part35_chase_email', 'chase_mail', 'send_chase_email');

		//debug($_SESSION['Auth']['User']);

		if($this->Session->read('Auth.User.group_id')==Configure::read('AdminUser')){
			$logged_in_user_id = $this->Session->read('Auth.User.parent_id');
			$logged_user_group_id = $_SESSION['Auth']['User']['ParentDetails']['User']['group_id'];
		}else{
			$logged_in_user_id = $this->Session->read('Auth.User.id');
			$logged_user_group_id = $this->Session->read('Auth.User.group_id');
		}


		$this->LinUid = $logged_in_user_id;

		$this->logged_in_user_id = $logged_in_user_id;

		$this->logged_user_group_id = $logged_user_group_id;

		$user_details = $this->User->find('first', array('conditions' => array('User.id' => $logged_in_user_id),'recursive' => 2));
		$logged_user_group_id=$user_details['User']['group_id'];

		$this->user_details = $user_details;

		//debug($this->user_details);

		$this->LinGid = $logged_user_group_id;

		$this->set('logged_user_group_id',@$logged_user_group_id);
		$this->set('logged_in_user_id', @$logged_in_user_id);


		$instructorsList = array();
		$agentsList = array();
		$expert_array = array();

		if($logged_user_group_id==Configure::read('AgentSuperUser')){

			@$panelExperts = $this->AgentsCommonFunctions->fetchPanelExpertsOfAgent($logged_in_user_id,'active');
			@$directExperts = $this->AgentsCommonFunctions->fetchExpertsOfAgent($logged_in_user_id,'active');
			@$agent_case_handler_array= $this->AgentsCommonFunctions->fetchCaseHandlerOrFeeEarner($logged_in_user_id,'active');
			$expert_array_raw=array_merge($panelExperts,$directExperts);

			@$expert_array = $expert_array_raw;

			/*foreach($expert_array_raw as $subarr){
				if(count(@$subarr['PanelExpert'])>0){
					@$expert_array[$subarr['PanelExpert']['id']]=ucfirst($subarr['PanelExpert']['title']." ".$subarr['PanelExpert']['forename']." ".$subarr['PanelExpert']['surname']);
					@$experts_id[]=$subarr['PanelExpert']['id'];
				}else{
					@$expert_array[$subarr['Expert']['id']]=ucfirst($subarr['Expert']['title']." ".$subarr['Expert']['forename']." ".$subarr['Expert']['surname']);
					@$experts_id[]=$subarr['Expert']['id'];
				}
			}
			if(!empty($experts_id)){
				@array_push($experts_id,$logged_in_user_id);
			}else{
				$experts_id=array($logged_in_user_id);
			}
			$strUsrId=@implode(',',$experts_id);*/

			// Fetching all instructors related to logged in agent
			$instructorsList = $this->AgentsCommonFunctions->fetchInstructorsOfAgent($logged_in_user_id,'active');

			//debug($instructorsList);

			// Fetching all agents related to logged in agent
			$agentsList = $this->AgentsCommonFunctions->fetchAgentsOfAgent($logged_in_user_id,'active');



		}
		elseif($logged_user_group_id==Configure::read('ExpertSuperUser')){

			// Fetching all agents related to logged in guy
			@$agentsList = $this->ExpertsCommonFunctions->fetchAgentsOfExpert($logged_in_user_id,'active');
			//fetch all the instructors related to logged in guy
			@$instructorsList = $this->ExpertsCommonFunctions->fetchInstructorsOfExpert($logged_in_user_id,'active');

		}
		elseif($logged_user_group_id==Configure::read('InstructorSuperUser')){

			$expert_array = $this->User->find('list', array('fields' => array('id','forename'), 'conditions' => array('id' =>  $payment_relationships_agnts)));


		}
		if($logged_user_group_id==Configure::read('TherapistSuperUser')){
			// Fetching all agents related to logged in guy
			$agentsList = $this->TherapistCommonFunctions->fetchAgentsOfTherapist($logged_in_user_id,'active');
			//fetch all the instructors related to logged in guy
			$instructorsList = $this->TherapistCommonFunctions->fetchInstructorsOfTherapist($logged_in_user_id,'active');

		}



		$this->agentsList = $agentsList;
		$this->instructorsList = $instructorsList;

		$this->expert_array = $expert_array;



	}


	function get_instructor_address(){

		$this->layout = 'ajax';

		$this->autoRender = false;

		$instructor_id = $_POST['instructor_id'];

		$toaddress_header = '';

		if(!empty($instructor_id)){

		if(!empty($instructor_id))
			$toAddress = $this->Address->find('first', array('conditions' => array('Address.user_id' => $instructor_id,'address_type'=>'billing'), 'recursive' => -1));
		if(empty($toAddress)){
			$toAddress = $this->Address->find('first', array('conditions' => array('Address.user_id' => $instructor_id), 'recursive' => -1));
		}

		$toUserCompanyDet = $this->User->find('first', array('conditions' => array('User.id' => $instructor_id), 'recursive' => 2));
		$toaddress_company_name=$toUserCompanyDet['Company']['name'];

		if(!empty($toAddress)){
			if(!empty($toaddress_company_name))
				$toaddress_header=$toaddress_company_name ."\n".$toAddress['Address']['address1'];
			else
				$toaddress_header= $toAddress['Address']['address1'];

			if(isset($toAddress['Address']['address2']) && $toAddress['Address']['address2'] !=""){
				$toaddress_header .="\n".$toAddress['Address']['address2'];
			}
			if(isset($toAddress['Address']['address3']) && $toAddress['Address']['address3'] !=""){
				$toaddress_header .="\n".$toAddress['Address']['address3'];
			}
			if(isset($toAddress['Address']['address4']) && $toAddress['Address']['address4'] !=""){
				$toaddress_header .="\n".$toAddress['Address']['address4'];
			}
			if(isset($toAddress['Address']['address5']) && $toAddress['Address']['address5'] !=""){
				$toaddress_header .="\n".$toAddress['Address']['address5'];
			}
			if(isset($toAddress['Address']['town']) && $toAddress['Address']['town'] !=""){
				$toaddress_header .="\n".$toAddress['Address']['town'];
			}
			$toaddress_header .="\n".$toAddress['Address']['postcode'];
			if(isset($instructor_company_arr['Address']['work_telephonec']) && $instructor_company_arr['Address']['work_telephonec'] !=""){
				$toaddress_header .="\n".$instructor_company_arr['Address']['work_telephonec']." (W)";
			}
			if(isset($instructor_company_arr['Address']['mobile']) && $instructor_company_arr['Address']['mobile'] !=""){
				$toaddress_header .="\n".$instructor_company_arr['Address']['mobile']." (M)";
			}

		}



		$communicatio_arr = $this->Communication->find('first', array('recursive' => -1, 'conditions' => array('Communication.user_id' => $instructor_id)));
		if (!empty($communicatio_arr['Communication']['report_email'])) {
				$user_email = $communicatio_arr['Communication']['report_email'];
		} else {
				$user_email = $toUserCompanyDet['User']['email'];
		}


		}

		$result = array('response'=>'success','address'=>$toaddress_header,'user_email'=>$user_email);
		return json_encode($result);
		exit;

	}

	function get_expert_address(){

		$this->layout = 'ajax';

		$this->autoRender = false;

		$expert_id = $_POST['expert_id'];

		$toaddress_header = '';

		if(!empty($expert_id)){

			if(!empty($expert_id))
				$toAddress = $this->Address->find('first', array('conditions' => array('Address.user_id' => $expert_id,'address_type'=>'billing'), 'recursive' => -1));
			if(empty($toAddress)){
				$toAddress = $this->Address->find('first', array('conditions' => array('Address.user_id' => $expert_id), 'recursive' => -1));
			}

			$toUserCompanyDet = $this->User->find('first', array('conditions' => array('User.id' => $expert_id), 'recursive' => 2));

			if(!empty($toUserCompanyDet['User']['title']))
				$expert_name = ucfirst($toUserCompanyDet['User']['title'])." ".$toUserCompanyDet['User']['forename']." ".$toUserCompanyDet['User']['surname'];
			else
				$expert_name = $toUserCompanyDet['User']['forename']." ".$toUserCompanyDet['User']['surname'];

			if(!empty($expert_name)){
				$toaddress_company_name= $expert_name."\n".$toUserCompanyDet['Company']['name'];
			}
			else{
				$toaddress_company_name=$toUserCompanyDet['Company']['name'];
			}
			if(!empty($toAddress)){
				if(!empty($toaddress_company_name))
					$toaddress_header=$toaddress_company_name ."\n".$toAddress['Address']['address1'];
				else
					$toaddress_header= $toAddress['Address']['address1'];

				if(isset($toAddress['Address']['address2']) && $toAddress['Address']['address2'] !=""){
					$toaddress_header .="\n".$toAddress['Address']['address2'];
				}
				if(isset($toAddress['Address']['address3']) && $toAddress['Address']['address3'] !=""){
					$toaddress_header .="\n".$toAddress['Address']['address3'];
				}
				if(isset($toAddress['Address']['address4']) && $toAddress['Address']['address4'] !=""){
					$toaddress_header .="\n".$toAddress['Address']['address4'];
				}
				if(isset($toAddress['Address']['address5']) && $toAddress['Address']['address5'] !=""){
					$toaddress_header .="\n".$toAddress['Address']['address5'];
				}
				if(isset($toAddress['Address']['town']) && $toAddress['Address']['town'] !=""){
					$toaddress_header .="\n".$toAddress['Address']['town'];
				}
				$toaddress_header .="\n".$toAddress['Address']['postcode'];
				if(isset($instructor_company_arr['Address']['work_telephonec']) && $instructor_company_arr['Address']['work_telephonec'] !=""){
					$toaddress_header .="\n".$instructor_company_arr['Address']['work_telephonec']." (W)";
				}
				if(isset($instructor_company_arr['Address']['mobile']) && $instructor_company_arr['Address']['mobile'] !=""){
					$toaddress_header .="\n".$instructor_company_arr['Address']['mobile']." (M)";
				}

			}

			$communicatio_arr = $this->Communication->find('first', array('recursive' => -1, 'conditions' => array('Communication.user_id' => $expert_id)));
			if (!empty($communicatio_arr['Communication']['report_email'])) {
				$user_email = $communicatio_arr['Communication']['report_email'];
			} else {
				$user_email = $toUserCompanyDet['User']['email'];
			}

		}

		$result = array('response'=>'success','address'=>$toaddress_header,'user_email'=>$user_email);
		return json_encode($result);
		exit;

	}


	function load_find_case_in_create_letter()
	{
		if( isset($_POST['actionFrom']) && $_POST['actionFrom']=='FindCaseInCreateLetter' )
		{
			$this->layout = '';
			$cf = $_POST['actionFrom'];
			$cid = $_POST['caseId'];
			$this->find_case_new($cf, ' ', $cid);
		}
		$this->set('callingFunctionFlag', 'load_find_case_in_create_letter');
	}

	/**
	 * This fuction is used to Create / Edit a template
	 * Returns 			: (Int)user id
	 : If the logged in user has owner(i.e : if he is being created by some one), user_id of the owner will be rerurned
	 : Else the user_id of the logged in user will be rerurned
	 * Added By 		: Nandini Hulsurkar
	 * Date				: 20 Oct 2011
	 * Last Modified	: 20 Oct 2011
	 **/
	function get_owner_id()
	{
		$owner_id = $_SESSION['Auth']['User']['id'];
		$result = $this->User->fetchUserDetails($_SESSION['Auth']['User']['id']);
		if( isset($result[0]['User']['parent_id']) && $result[0]['User']['parent_id']!=0 ){
			$owner_id = $result[0]['User']['parent_id'];
		}
		return $owner_id;
	}





	function list_templates()
	{
		$owner_id = $this->logged_in_user_id;
		$conditions = array('Template.owner_id' => $owner_id);
		$template_list = $this->paginate('Template',array($conditions));

		//debug($template_list);

		$this->set('template_list',$template_list);
		$this->set('limit', $this->paginate['limit']);
	}




	function tempate_lists_ajax($limit=null){

		$this->layout = 'ajax';
		//Filter Conditions

		$owner_id = $this->logged_in_user_id;

		$resultCondtions = "1=1 ";
		if(!empty($_REQUEST['jString']) && !empty($_REQUEST['jString'])){
			$jString = stripslashes($_REQUEST['jString']);
			$filter = json_decode($jString);
			if(count($filter) > 0){
				foreach($filter as $key => $filterValue){


					if($key == 'created_by' && !empty($filterValue)){
							$filterValue = strtolower($filterValue);
							$resultCondtions .= " AND LOWER( CONCAT_WS('', User.forename, User.surname)) LIKE '%$filterValue%'";
							//$resultCondtions .= " AND User.forename LIKE '$filterValue%'";

					}else if($key == 'template_name' && !empty($filterValue)){
						$resultCondtions .= " AND Template.name like '%$filterValue%'";
					}
					else if($key == 'created_date_from' && !empty($filterValue)){
						$filterValue = $this->Date->DbFormat($filterValue);
						$resultCondtions .= " AND Template.created >= '$filterValue'";
					}
					else if($key == 'created_date_to' && !empty($filterValue)){
						$filterValue = $this->Date->DbFormat($filterValue);
						$resultCondtions .= " AND Template.created <= '$filterValue'";
					}


				}

			}
		}
		$resultCondtions.= " AND Template.owner_id = ".$owner_id;

		//debug($resultCondtions);

		// Ajax Request
		if($limit != null){
			$this->paginate['limit'] = $limit;
			//$this->layout = 'ajax';
		}

		$template_list = $this->paginate('Template',array($resultCondtions));
		$this->set('template_list',$template_list);
		$this->set('limit', $this->paginate['limit']);

	}



	function create_or_edit_template($templateId = 0) {
		// set variables
		$user_id = $this->Session->read('Auth.User.id');

		$content = '';
		if (($templateId != 0 || $templateId != '0') && empty($this->data)) {
			$templateId = $this->EncryptionFunctions->deCrypt($templateId);
			$this->data = $this->Template->find('first', array('conditions' => array('Template.id' => $templateId)));

			$content = $this->data['Template']['description'];

		} else if (!empty($this->data)){

			$this->data['Template']['created_by'] = $user_id;

			if ($this->Session->read('Auth.User.group_id') == Configure::read('AdminUser')) {
				$this->data['Template']['owner_id'] = $this->Session->read('Auth.User.parent_id');
			} else {
				$this->data['Template']['owner_id'] = $user_id;
			}

			//$template_list = $this->Template->find('list', array('conditions' => array('Template.owner_id' => $user_id)));
			$template_list = array();


			if (!empty($this->data)) {
				$expert_folder = $this->Expert->createExpertDir($user_id);


				$template_dir = $expert_folder.'/template/';

				if ($templateId == 0 && $this->data['Template']['name'] == 'other') {
					$this->data['Template']['name'] = $this->data['Template']['other'];
				}

				if ($templateId == 0) {
					foreach ($template_list AS $key => $value) {
						if ($this->data['Template']['name'] == $value) {
							$this->data['Template']['id'] = $key;
						}
					}
				}



				//debug($this->data); exit();
				if ($this->Template->save($this->data['Template'])) {
					// this will save the template content into a file
					$filename = $template_dir.str_replace(' ','_',strtolower($this->data['Template']['name'])).".html";
					$old_content = $this->data['Template']['description'];

					if ($_SERVER['HTTP_HOST'] == 'localhost') {
						$content = str_replace('/coralms/app/webroot/uploads/template_images/', Configure::read('coral_root_path').'uploads/template_images/', $old_content);
					} else if ($_SERVER['HTTP_HOST'] == 'coraltechnologies.co.uk' || $_SERVER['HTTP_HOST'] == 'www.coraltechnologies.co.uk') {
						$content = str_replace('/application/app/webroot/uploads/template_images/', Configure::read('coral_root_path').'uploads/template_images/', $old_content);
					}

					$handle = fopen($filename, 'w+');
					fwrite($handle, $content);
					fclose($handle);

					$this->Session->setFlash("The template has been created successfully.",'default', array('class' => 'message success'));
					$this->redirect(array('action' => 'list_templates'));
				}
			}

			$this->set('template_list', $template_list);
		}
		$this->set('content', $content);
		$this->set('templateId', $templateId);
	}

	function delete_template($templateId = 0){
		$user_id = $this->Session->read('Auth.User.id');

		$content = '';
		if (($templateId != 0 || $templateId != '0')) {
			$templateId = $this->EncryptionFunctions->deCrypt($templateId);

			$this->Template->delete($templateId);

			$this->Session->setFlash("The template has been deleted successfully.",'default', array('class' => 'message success'));
			$this->redirect(array('action' => 'list_templates'));

		}


	}


	/**
	 * This fuction is being called through an Ajax call to get the template detals
	 * Returns 			: Template Detais As String.
	 * Added By 		: Nandini Hulsurkar
	 * Date				: 19 Oct 2011
	 * Last Modified	: 19 Oct 2011
	 **/
	function ajax_prefill_template_details()
	{
		//make the layout as empty as we want only the element to be loaded
		$this->layout = '';
		//Get the template id, who's details need to be featched
		$templateId = $_POST['templateId'];

		$result = '';
		$templateDetails = $this->Template->fetchTemplateDetails($templateId);

		if( isset($templateDetails[0]) ) {
			$result = $templateDetails[0]['Template']['name']."@DataSaparator@".$templateDetails[0]['Template']['content'];
		}
		trim($result);
		echo $result."%%MainSaparator%%";
		exit;
	}


	function ajax_edit_get_case_user_list(){

		$case_master_id = $_POST['caseId'];

		$letterId = $_POST['letter_id'];


		$toCaseUsersDet = array();

		$finalArray = array();

		$logged_user_group_id = $this->logged_user_group_id;

		$letterDetails = $this->GeneralLetter->fetchLetterDetails($letterId);

		$to_user_type = $letterDetails[0]['GeneralLetter']['to_user_type'];
		$to_user_id = $letterDetails[0]['GeneralLetter']['to_user_id'];


		if(!empty($case_master_id)){

			$caseUsersArr = $this->CommonFunctions->GetCaseUsersDetails($case_master_id);

			$case_user_ids = array();

			if(count($caseUsersArr)>0){
				for($k=0;$k<count($caseUsersArr);$k++){
					if($caseUsersArr[$k]['case_users']['user_id']==$this->logged_in_user_id){
						if ($logged_user_group_id == Configure::read('ExpertSuperUser') || $logged_user_group_id == Configure::read('TherapistSuperUser')) {
							$case_user_ids[] = $caseUsersArr[$k-1]['case_users']['user_id'];
						}else{
							$case_user_ids[] = $caseUsersArr[$k-1]['case_users']['user_id'];
							$case_user_ids[] = $caseUsersArr[$k+1]['case_users']['user_id'];
						}
					}
				}
			}



			if(!empty($case_user_ids)&&count($case_user_ids)>0){
				foreach($case_user_ids as $to_user_id){
					$toCaseUsersDet[] = $this->User->find('first', array('fields'=>array('User.id','User.group_id','User.title','User.forename','User.middlename','User.surname','User.email','Company.name'),'conditions' => array('User.id' => $to_user_id), 'recursive' =>1));
				}
			}



			if(!empty($toCaseUsersDet)){
				foreach($toCaseUsersDet as $k=>$caseUsers){

					$name_val = '';

					if($caseUsers['User']['group_id']==Configure::read('ExpertSuperUser') || $caseUsers['User']['group_id']== Configure::read('TherapistSuperUser')){
						$type = 'expert';
						if(!empty($caseUsers['User']['title']))
							$name_val = ucfirst($caseUsers['User']['title'])." ".$caseUsers['User']['forename']." ".$caseUsers['User']['surname'];
						else
							$name_val = $caseUsers['User']['forename']." ".$caseUsers['User']['surname'];

						$email = $caseUsers['User']['email'];
					}else{
						$type = 'agency';
						$name_val = $caseUsers['Company']['name'];

						$case_user_id = $caseUsers['User']['id'];

						$report_email = '';

						if(!empty($case_user_id)){
							$case_user_det = $this->CaseUser->find('first',array('conditions'=>array('CaseUser.user_id'=>$case_user_id,'CaseUser.case_master_id'=>$case_master_id,'(CaseUser.additional_info IS NULL OR CaseUser.additional_info="")')));
							$report_email = $case_user_det['CaseUser']['report_invoice_email'];
						}

						if(empty($report_email)){
							//$case_user_id = $caseUsers['case_users']['user_id'];
							$communicatio_arr = $this->Communication->find('first', array('recursive' => -1, 'conditions' => array('Communication.user_id' => $case_user_id)));
							$report_email = $communicatio_arr['Communication']['report_email'];
						}

						$email = $report_email;
					}

					$finalArray[$k] = array('id'=>$caseUsers['User']['id'],
							'type' => $type,
							'name' => $name_val,
							'email'=> $email,
					);

				}

			}



			$finalarraycount = count($finalArray);

			$case_dump = $this->CaseMaster->find('first', array('conditions' => array('CaseMaster.id' => $case_master_id), 'recursive' => 2));

			//debug($case_dump);

			$claimant_id = $case_dump['CaseClaimantDetail']['id'];

                        if($case_dump['CaseClaimantDetail']['title']!='' || $case_dump['CaseClaimantDetail']['title']!='NULL'){
                            $case_dump['CaseClaimantDetail']['title'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['title']);
                        }
                        if($case_dump['CaseClaimantDetail']['forename']!='' || $case_dump['CaseClaimantDetail']['forename']!='NULL'){
                            $case_dump['CaseClaimantDetail']['forename'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['forename']);
                        }
                        if($case_dump['CaseClaimantDetail']['surname']!='' || $case_dump['CaseClaimantDetail']['surname']!='NULL'){
                            $case_dump['CaseClaimantDetail']['surname'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['surname']);
                        }
                        if($case_dump['CaseClaimantDetail']['email']!='' || $case_dump['CaseClaimantDetail']['email']!='NULL'){
                            $case_dump['CaseClaimantDetail']['email'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['email']);
                        }

			$claimant_name=$case_dump['CaseClaimantDetail']['title']." ".$case_dump['CaseClaimantDetail']['forename']." ".$case_dump['CaseClaimantDetail']['surname'];

			$claimant_email = $case_dump['CaseClaimantDetail']['email'];


			$finalArray[$finalarraycount] = array('id'=>$claimant_id,
					'type' =>'claimant',
					'name' => $claimant_name,
					'email'=> $claimant_email,
			);



			$result = array('response'=>'success',
							 'to_user_type'=>$to_user_type,
							 'to_user_id'=>$to_user_id,
							'select_options'=>$finalArray,
					);

			//debug($finalArray);



			echo json_encode($result);

		}

		exit;

	}

	function ajax_get_case_user_list(){

		$case_master_id 	= $_POST['caseId'];
		
		$specfic_expert_id 	= isset($_POST['specfic_expert_id']) ? @$_POST['specfic_expert_id'] : '';	 //Added By mskt	

		$toCaseUsersDet = array();

		$finalArray = array();

		$logged_user_group_id = $this->logged_user_group_id;

		if(!empty($case_master_id)){

		$caseUsersArr = $this->CommonFunctions->GetCaseUsersDetails($case_master_id);

		$case_user_ids = array();

		//debug($caseUsersArr);

		//debug($this->logged_in_user_id);

		if(count($caseUsersArr)>0){
			for($k=0;$k<count($caseUsersArr);$k++){
				if($caseUsersArr[$k]['case_users']['user_id']==$this->logged_in_user_id){
					if ($logged_user_group_id == Configure::read('ExpertSuperUser') || $logged_user_group_id == Configure::read('TherapistSuperUser')) {
						$case_user_ids[] = $caseUsersArr[$k-1]['case_users']['user_id'];
					}else{
						$case_user_ids[] = $caseUsersArr[$k-1]['case_users']['user_id'];
                                                if(!empty($caseUsersArr[$k+1]['case_users']['user_id'])){
                                                    $case_user_ids[] = $caseUsersArr[$k+1]['case_users']['user_id'];
                                                }
					}
				}
			}
		}



		if(!empty($case_user_ids)&&count($case_user_ids)>0){
				foreach($case_user_ids as $to_user_id){
					$toCaseUsersDet[] = $this->User->find('first', array('fields'=>array('User.id','User.group_id','User.title','User.forename','User.middlename','User.surname','User.email','Company.name'),'conditions' => array('User.id' => $to_user_id), 'recursive' =>1));
				}
		}



		if(!empty($toCaseUsersDet)){
			foreach($toCaseUsersDet as $k=>$caseUsers){

				$name_val = '';

				if($caseUsers['User']['group_id']==Configure::read('ExpertSuperUser') || $caseUsers['User']['group_id']== Configure::read('TherapistSuperUser')){
					$type = 'expert';
					if(!empty($caseUsers['User']['title']))
						$name_val = ucfirst($caseUsers['User']['title'])." ".$caseUsers['User']['forename']." ".$caseUsers['User']['surname'];
					else
						$name_val = $caseUsers['User']['forename']." ".$caseUsers['User']['surname'];

					$email = $caseUsers['User']['email'];
				}else{
					$type = 'agency';
					$name_val = $caseUsers['Company']['name'];

					$case_user_id = $caseUsers['User']['id'];

					$report_email = '';

					if(!empty($case_user_id)){
						$case_user_det = $this->CaseUser->find('first',array('conditions'=>array('CaseUser.user_id'=>$case_user_id,'CaseUser.case_master_id'=>$case_master_id,'(CaseUser.additional_info IS NULL OR CaseUser.additional_info="")')));
						$report_email = $case_user_det['CaseUser']['report_invoice_email'];
					}

					if(empty($report_email)){
						//$case_user_id = $caseUsers['case_users']['user_id'];
						$communicatio_arr = $this->Communication->find('first', array('recursive' => -1, 'conditions' => array('Communication.user_id' => $case_user_id)));
						$report_email = $communicatio_arr['Communication']['report_email'];
					}

					$email = $report_email;
				}

				$finalArray[$k] = array('id'=>$caseUsers['User']['id'],
										'type' => $type,
										'name' => $name_val,
										'email'=> $email,
										);

			}

		}





                $case_status_id = $caseUsersArr['0']['case_users']['status_id'];



		$case_dump = $this->CaseMaster->find('first', array('conditions' => array('CaseMaster.id' => $case_master_id), 'recursive' => 2));


                $preferred_expert_id = $case_dump['CaseMaster']['preferred_expert_id'];

                if($preferred_expert_id!="" && $preferred_expert_id>0 && $case_status_id==1){
                    $finalarraycount = count($finalArray);

                    $caseUsersExpert = $this->User->find('first', array('fields'=>array('User.id','User.group_id','User.title','User.forename','User.middlename','User.surname','User.email','Company.name'),'conditions' => array('User.id' => $preferred_expert_id), 'recursive' =>1));

                    $type = 'expert';
		    if(!empty($caseUsersExpert['User']['title']))
		      $name_val = ucfirst($caseUsersExpert['User']['title'])." ".$caseUsersExpert['User']['forename']." ".$caseUsersExpert['User']['surname'];
		    else
		      $name_val = $caseUsersExpert['User']['forename']." ".$caseUsersExpert['User']['surname'];



		    $report_email = '';

		    if(empty($report_email)){
						//$case_user_id = $caseUsers['case_users']['user_id'];
			$communicatio_arr = $this->Communication->find('first', array('recursive' => -1, 'conditions' => array('Communication.user_id' => $preferred_expert_id)));
			$report_email = $communicatio_arr['Communication']['report_email'];
                    }
                    if(empty($report_email)){
                        $report_email = $caseUsersExpert['User']['email'];
                    }
                    $email = $report_email;

                    /*$finalArray[$finalarraycount] = array('id'=>$caseUsers['User']['id'],
										'type' => $type,
										'name' => $name_val,
										'email'=> $email,
										);*/
					$finalArray[$finalarraycount] = array('id'=>$preferred_expert_id,
										'type' => $type,
										'name' => $name_val,
										'email'=> $email,
										);

              }else{
				//Added By mskt
				
				if($specfic_expert_id){
				
					$finalarraycount = count($finalArray);
	
					$caseUsersExpert = $this->User->find('first', array('fields'=>array('User.id','User.group_id','User.title','User.forename','User.middlename','User.surname','User.email','Company.name'),'conditions' => array('User.id' => $specfic_expert_id), 'recursive' =>1));
	
					$type = 'expert';
					if(!empty($caseUsersExpert['User']['title']))
					  $name_val = ucfirst($caseUsersExpert['User']['title'])." ".$caseUsersExpert['User']['forename']." ".$caseUsersExpert['User']['surname'];
					else
					  $name_val = $caseUsersExpert['User']['forename']." ".$caseUsersExpert['User']['surname'];
	
	
	
					$report_email = '';
	
					if(empty($report_email)){
						//$case_user_id = $caseUsers['case_users']['user_id'];
						$communicatio_arr = $this->Communication->find('first', array('recursive' => -1, 'conditions' => array('Communication.user_id' => $specfic_expert_id)));
						$report_email = $communicatio_arr['Communication']['report_email'];
					}
					if(empty($report_email)){
						$report_email = $caseUsersExpert['User']['email'];
					}
					$email = $report_email;
	
					$finalArray[$finalarraycount] = array('id'=>$specfic_expert_id,
										'type' => $type,
										'name' => $name_val,
										'email'=> $email,
										);
				}
			  }

               $finalarraycount = count($finalArray);
		//debug($case_dump);

		$claimant_id = $case_dump['CaseClaimantDetail']['id'];



                if($case_dump['CaseClaimantDetail']['title']!='' || $case_dump['CaseClaimantDetail']['title']!='NULL'){
                    $case_dump['CaseClaimantDetail']['title'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['title']);
                }
                if($case_dump['CaseClaimantDetail']['forename']!='' || $case_dump['CaseClaimantDetail']['forename']!='NULL'){
                    $case_dump['CaseClaimantDetail']['forename'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['forename']);
                }
                if($case_dump['CaseClaimantDetail']['surname']!='' || $case_dump['CaseClaimantDetail']['surname']!='NULL'){
                    $case_dump['CaseClaimantDetail']['surname'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['surname']);
                }
                if($case_dump['CaseClaimantDetail']['email']!='' || $case_dump['CaseClaimantDetail']['email']!='NULL'){
                    $case_dump['CaseClaimantDetail']['email'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['email']);
                }

		$claimant_name=$case_dump['CaseClaimantDetail']['title']." ".$case_dump['CaseClaimantDetail']['forename']." ".$case_dump['CaseClaimantDetail']['surname'];

		$claimant_email = $case_dump['CaseClaimantDetail']['email'];


		$finalArray[$finalarraycount] = array('id'=>$claimant_id,
										'type' =>'claimant',
										'name' => $claimant_name,
										'email'=> $claimant_email,
										);



			//debug($finalArray);



			echo json_encode($finalArray);

		}

		exit;

	}

	function ajax_edit_get_case_subuser_list(){

		$case_master_id = $_POST['caseId'];

		$user_type = $_POST['user_type'];

		$user_id = $_POST['user_id'];

		$letterId = $_POST['letterid'];

		$finalArray = array();

		$logged_user_group_id = $this->logged_user_group_id;

		$letterDetails = $this->GeneralLetter->fetchLetterDetails($letterId);

		$to_subuser_type ='';
		if($letterDetails[0]['GeneralLetter']['to_subuser_type']!='NULL')
			$to_subuser_type = $letterDetails[0]['GeneralLetter']['to_subuser_type'];
		$to_subuser_id ='';
		if($letterDetails[0]['GeneralLetter']['to_subuser_id']!='NULL')
			$to_subuser_id = $letterDetails[0]['GeneralLetter']['to_subuser_id'];

		if(!empty($user_id) && !empty($user_type)){

			if($user_type=='expert'){


				$expert_sub_users_list = $this->User->find('all', array('recursive'=>-1,'fields'=>array('User.id','User.group_id','User.title','User.forename','User.middlename','User.surname','User.email'),'conditions' => array('User.parent_id' => $user_id,'status'=>'active')));



				if(!empty($expert_sub_users_list)){
					foreach($expert_sub_users_list as $k=>$subUsers){

						$name_val = '';

						if(!empty($subUsers['User']['title']))
							$name_val = ucfirst($subUsers['User']['title'])." ".$subUsers['User']['forename']." ".$subUsers['User']['surname'];
						else
							$name_val = $subUsers['User']['forename']." ".$subUsers['User']['surname'];

						$type = 'expert';

						$finalArray['expert'][$k] = array('id'=>$subUsers['User']['id'],
								'type' => $type,
								'name' => $name_val,
								'email' => $subUsers['User']['email']
						);

						$finalArray['agency'] = array();

					}

				}

			}elseif($user_type=='agency'){

				$case_handler_id = '';

				$result = $this->CaseUser->query("SELECT case_users.*,case_masters.id,case_masters.case_id,case_masters.medical_record,users.id ,users.title,users.forename,users.middlename,users.surname FROM `case_users` inner join case_masters on case_users.`case_master_id`=case_masters.id  inner join users on case_users.`user_id`=users.id inner join statuses on statuses.id=case_users.status_id where case_users.`case_master_id`=$case_master_id  and case_users.`user_id`=$user_id and (`case_users`.`additional_info` IS NULL OR `case_users`.`additional_info`='' ) ORDER BY case_users.`id` ");

				if(count($result)>0){
					$case_handler_id = $result[0]['case_users']['case_handler_id'];
				}



				if(!empty($case_handler_id)){

					$email ='';

					$toCaseUsersDet = $this->User->find('first', array('fields'=>array('User.id','User.group_id','User.title','User.forename','User.middlename','User.surname','Company.name'),'conditions' => array('User.id' => $case_handler_id), 'recursive' =>1));

					$type = 'agency';
					if(!empty($toCaseUsersDet['User']['title']))
						$name_val = $toCaseUsersDet['User']['title']." ".$toCaseUsersDet['User']['forename']." ".$toCaseUsersDet['User']['surname'];
					else
						$name_val = $toCaseUsersDet['User']['forename']." ".$toCaseUsersDet['User']['surname'];


					$finalArray['agency'] = array('id'=>$toCaseUsersDet['User']['id'],
							'type' => $type,
							'name' => $name_val,
							'email' => $email,
					);



				}else{
					$finalArray['agency'] = array('case_handler_empty'=>'true');

				}

				$finalArray['expert'] = array();


			}

			$result = array('response'=>'success',
					       	'sub_user_type'=>$to_subuser_type,
					        'sub_user_id'=>$to_subuser_id,
					        'select_options'=>$finalArray);

			echo json_encode($result);

		}

		exit;

	}


	function ajax_get_case_subuser_list(){

		$case_master_id = $_POST['caseId'];

		$user_type = $_POST['user_type'];

		$user_id = $_POST['user_id'];

		$finalArray = array();

		$logged_user_group_id = $this->logged_user_group_id;

		if(!empty($user_id) && !empty($user_type)){

			if($user_type=='expert'){

			$expert_sub_users_list = $this->User->find('all', array('recursive'=>-1,'fields'=>array('User.id','User.group_id','User.title','User.forename','User.middlename','User.surname','User.email'),'conditions' => array('User.parent_id' => $user_id,'status'=>'active')));



			if(!empty($expert_sub_users_list)){
				foreach($expert_sub_users_list as $k=>$subUsers){

					$name_val = '';

					if(!empty($subUsers['User']['title']))
						$name_val = ucfirst($subUsers['User']['title'])." ".$subUsers['User']['forename']." ".$subUsers['User']['surname'];
					else
						$name_val = $subUsers['User']['forename']." ".$subUsers['User']['surname'];

					$type = 'expert';

					$finalArray['expert'][$k] = array('id'=>$subUsers['User']['id'],
							'type' => $type,
							'name' => $name_val,
							'email' => $subUsers['User']['email']
					);

					$finalArray['agency'] = array();

				}

			}

			}elseif($user_type=='agency'){

				$case_handler_id = '';

				$result = $this->CaseUser->query("SELECT case_users.*,case_masters.id,case_masters.case_id,case_masters.medical_record,users.id ,users.title,users.forename,users.middlename,users.surname FROM `case_users` inner join case_masters on case_users.`case_master_id`=case_masters.id  inner join users on case_users.`user_id`=users.id inner join statuses on statuses.id=case_users.status_id where case_users.`case_master_id`=$case_master_id  and case_users.`user_id`=$user_id and (`case_users`.`additional_info` IS NULL OR `case_users`.`additional_info`='') ORDER BY case_users.`id` ");

				if(count($result)>0){
					$case_handler_id = $result[0]['case_users']['case_handler_id'];
				}



				if(!empty($case_handler_id)){

					$email ='';

					$toCaseUsersDet = $this->User->find('first', array('fields'=>array('User.id','User.group_id','User.title','User.forename','User.middlename','User.surname','Company.name'),'conditions' => array('User.id' => $case_handler_id), 'recursive' =>1));

					$type = 'agency';
					if(!empty($toCaseUsersDet['User']['title']))
						$name_val = $toCaseUsersDet['User']['title']." ".$toCaseUsersDet['User']['forename']." ".$toCaseUsersDet['User']['surname'];
					else
						$name_val = $toCaseUsersDet['User']['forename']." ".$toCaseUsersDet['User']['surname'];


					$finalArray['agency'] = array('id'=>$toCaseUsersDet['User']['id'],
							'type' => $type,
							'name' => $name_val,
							'email' => $email,
					);



				}else{
					$finalArray['agency'] = array('case_handler_empty'=>'true');

				}

				$finalArray['expert'] = array();


			}

			echo json_encode($finalArray);

		}

		exit;

	}


	function ajax_fill_case_details(){

		$this->layout = '';
		$case_master_id = $_POST['caseId'];

		$template_id = $_POST['templateId'];

		$template_to_address = $_POST['template_to_address'];

		$case_handler_id_det = $_POST['case_handler_id'];

		$case_handler_subusers_id = $_POST['case_handler_subusers_id'];

		$template_our_ref = $_POST['template_our_ref'];

		$template_your_ref = $_POST['template_your_ref'];
		
		//Added By mskt
		$SpecficCvId 			 = '';
		$specfic_expert_id 		 = '';
		$specfic_expert_data 	 = $_POST['SpecficCvId'];
		if($specfic_expert_data){
			$expert_cv_id_data   = explode('_', $specfic_expert_data);
			
			$specfic_expert_id   = $expert_cv_id_data[0];
			$SpecficCvId		 = $expert_cv_id_data[1];				
		}	
		$specfic_address 		= '';
		$specfic_address_data 	= '';
		$SpecficExpertName      = '';
		if($SpecficCvId){
			$specfic_consulting_venue = $this->Address->find('first',array('fields'=>array('ConsultingVenueSCV.id','ConsultingVenueSCV.name','ConsultingVenueSCV.telephone','ConsultingVenueSCV.email', 'Address.address1', 'Address.address2', 'Address.address3', 'Address.county', 'Address.postcode'), 'joins'=>array(array('table' => 'consulting_venues', 'alias' => 'ConsultingVenueSCV', 'conditions'=> array('ConsultingVenueSCV.id = Address.consulting_venue_id', 'ConsultingVenueSCV.id' => $SpecficCvId),'recursive' => 2))));
			
			if(count($specfic_consulting_venue) > 0){
				
				if(isset($specfic_consulting_venue['ConsultingVenueSCV']['name']) && $specfic_consulting_venue['ConsultingVenueSCV']['name'] !=""){
					$specfic_address .= $specfic_consulting_venue['ConsultingVenueSCV']['name'];
				}
				if(isset($specfic_consulting_venue['Address']['address1']) && $specfic_consulting_venue['Address']['address1'] !=""){
					$specfic_address .="<br>".$specfic_consulting_venue['Address']['address1'];
				}
				if(isset($specfic_consulting_venue['Address']['address2']) && $specfic_consulting_venue['Address']['address2'] !=""){
					$specfic_address .="<br>".$specfic_consulting_venue['Address']['address2'];
				}
				if(isset($specfic_consulting_venue['Address']['address3']) && $specfic_consulting_venue['Address']['address3'] !=""){
					$specfic_address .="<br>".$specfic_consulting_venue['Address']['address3'];
				}
				if(isset($specfic_consulting_venue['Address']['county']) && $specfic_consulting_venue['Address']['county'] !=""){
					$specfic_address .="<br>".$specfic_consulting_venue['Address']['county'];
				}
				if(isset($specfic_consulting_venue['Address']['postcode']) && $specfic_consulting_venue['Address']['postcode'] !=""){
					$specfic_address .="<br>".$specfic_consulting_venue['Address']['postcode'];
				}
				if(isset($specfic_consulting_venue['ConsultingVenueSCV']['telephone']) && $specfic_consulting_venue['ConsultingVenueSCV']['telephone'] !=""){
					$specfic_address .="<br>".$specfic_consulting_venue['ConsultingVenueSCV']['telephone']." (M)";
				}
			}			
		}		

		$template_content = '';
		$template_name = '';

		if(!empty($template_id)){
			$templateDetails = $this->Template->fetchTemplateDetails($template_id);

			if( isset($templateDetails[0]) ) {
				$template_content = $templateDetails[0]['Template']['description'];
                                $template_name = $templateDetails[0]['Template']['name'];
			}

		}

		$logged_user_group_id = $this->logged_user_group_id;

		$user_arr = $this->user_details;

        $user_arr_current_login = $this->User->find('first', array('conditions' => array('User.id' => $this->Session->read('Auth.User.id')),'recursive' => 2));

		$instruction_qualification = "";

		$our_reference_text = "";

		$your_reference_text = "";

		$content = "";

		$instruction_comp_name="<strong>".$user_arr['Company']['name']."</strong>";
		//echo $instruction_comp_name; exit;
		if(empty($instruction_comp_name)){
			//Get the Qualification
			$instruction_qualification = "";
			if(!empty($user_arr['ExpertProfession']['Qualification'])){
				$i=0;
				foreach($user_arr['ExpertProfession']['Qualification'] as $value){
					if($i==0){
						$instruction_qualification = strtoupper($value['qualification']);
					}else{
						$instruction_qualification .= ", ".strtoupper($value['qualification']);
					}
					$i++;
				}
			}
			$instruction_comp_name = "<strong>".ucfirst($user_arr['User']['title'])." " .$user_arr['User']['forename']." " .$user_arr['User']['middlename']." " .$user_arr['User']['surname']." ".$instruction_qualification."</strong>";
		}
		$instruction_header=$instruction_comp_name ."<br>".$user_arr['Address'][0]['address1'];
		if(isset($user_arr['Address'][0]['address2']) && $user_arr['Address'][0]['address2'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['address2'];
		}
		if(isset($user_arr['Address'][0]['address3']) && $user_arr['Address'][0]['address3'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['address3'];
		}
		if(isset($user_arr['Address'][0]['address4']) && $user_arr['Address'][0]['address4'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['address4'];
		}
		if(isset($user_arr['Address'][0]['address5']) && $user_arr['Address'][0]['address5'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['address5'];
		}
		if(isset($user_arr['Address'][0]['town']) && $user_arr['Address'][0]['town'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['town'];
		}
		$instruction_header .="<br>".$user_arr['Address'][0]['postcode'];
		if(isset($user_arr['Address'][0]['work_telephonec']) && $user_arr['Address'][0]['work_telephonec'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['work_telephonec']." (W)";
		}
		if(isset($user_arr['Address'][0]['mobile']) && $user_arr['Address'][0]['mobile'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['mobile']." (M)";
		}

		$send_user_comp_name = '';
		if(!empty($user_arr['Company']['name'])){
			$send_user_comp_name = $user_arr['Company']['name'];

			$send_user_comp_name_text = 'For and on behalf of <strong>'.$send_user_comp_name.'</strong>';
		}

		$send_user_name = '';

		$send_user_name = ucfirst($user_arr_current_login['User']['title'])." " .$user_arr_current_login['User']['forename']." " .$user_arr_current_login['User']['middlename']." " .$user_arr_current_login['User']['surname']." ".$instruction_qualification;


		$toaddress_header ='';

		if(!empty($template_to_address)){
			$order   = array("\r\n", "\n", "\r");
			$replace = '<br/>';
			$template_to_address = str_replace($order, $replace, $template_to_address);
			$toaddress_header = $template_to_address;
		}


		if(!empty($template_our_ref)){
			$our_reference_text = 'Our Reference: '.$template_our_ref;
		}

		if(!empty($template_your_ref)){
			$your_reference_text = 'Your Reference: '.$template_your_ref;
		}



                $communicatio_arr = $this->Communication->find('first', array('recursive' => -1, 'conditions' => array('Communication.user_id' => $this->Session->read('Auth.User.id'))));

		$contact_details = '';
		$contact_email ='';
		$contact_phone = '';

                if(!empty($communicatio_arr['Communication']['appointment_email'])){
                    $contact_email = $communicatio_arr['Communication']['appointment_email'];
                }

		if(!empty($user_arr['User']['email']) && empty($contact_email)){
			$contact_email =$user_arr_current_login['User']['email'];
		}

		if(!empty($user_arr['User']['work_telephone'])) {
			$contact_phone = $user_arr_current_login['User']['work_telephone'];
		} else if (!empty($user_arr['User']['home_telephone'])) {
			$contact_phone = $user_arr_current_login['User']['home_telephone'];
		} else if (!empty($rec_user['User']['mobile'])) {
			$contact_phone = $user_arr_current_login['User']['mobile'];
		}

		if(!empty($contact_phone)){
			$contact_details = 'Tel : '.$contact_phone.'<br/>';
		}
		$contact_details .= 'Email : '.$contact_email;


		$solicitor_reference_text = '';

		$cur_date=date('d-m-Y');		
		

		if (!empty($case_master_id)) {


			if(!empty($case_handler_id_det)){

				$case_handler_id_det = explode('_',$case_handler_id_det);

				$case_handler_id = $case_handler_id_det[0];

				$case_handler_type = $case_handler_id_det[1];
				
				$case_handler_email = $case_handler_id_det[2]; //Added By mskt

			}			

			if($case_handler_type=="expert" && !empty($case_handler_id) && !empty($case_handler_subusers_id)){

				$case_handler_subuser_id_det = explode('_',$case_handler_subusers_id);

				$case_handler_subusers_id = $case_handler_subuser_id_det[0];

				$to_user_id = $case_handler_subusers_id;

				$to_user_id_address = $case_handler_id;

				$to_user_company_id = $case_handler_id;
			}

			else if($case_handler_type=="expert" && !empty($case_handler_id) && empty($case_handler_subusers_id)){

				$to_user_id = $case_handler_id;

				$to_user_id_address = $case_handler_id;

				$to_user_company_id = $case_handler_id;

			}
			else if($case_handler_type=="agency" && !empty($case_handler_id) && empty($case_handler_subusers_id)){

				//$to_user_id = $case_handler_id;

				$to_user_id = '';

				$to_user_id_address = $case_handler_id;

				$to_user_company_id = $case_handler_id;

			}
			else if($case_handler_type=="agency" && !empty($case_handler_id) && !empty($case_handler_subusers_id)){

				//$to_user_id = $case_handler_id;

				$to_user_id = $case_handler_subusers_id;

				$to_user_id_address = $case_handler_id;

				$to_user_company_id = $case_handler_id;

			}
			else if ($case_handler_type=="claimant" && !empty($case_handler_id)){

				$to_user_id = 0;

				$to_user_id_address = 0;

				$to_user_company_id = 0;
			}

			//debug($to_user_id);

			//debug($case_handler_id);

			//debug($case_handler_type);


			$caseUsersArr = $this->CommonFunctions->GetCaseUsersDetails($case_master_id);

			if(count($caseUsersArr)>0){
				for($k=0;$k<count($caseUsersArr);$k++){
					if($caseUsersArr[$k]['case_users']['user_id']==$this->logged_in_user_id){

						//$to_user_id = $caseUsersArr[$k-1]['case_users']['user_id'];

						//$agentCompananyName=$this->Common->company_name($caseUsersArr[$k-1]['users']['id']);

						//$yourref = $caseUsersArr[$k-1]['case_users']['user_reference'];

					}

					if($caseUsersArr[$k]['case_users']['user_type']=='Instructor'){
						$solicitor_reference = $caseUsersArr[$k]['case_users']['user_reference'];
					}
				}
			}

			if(!empty($solicitor_reference)){
				$solicitor_reference_text = '<strong>Solicitor Reference : '.$solicitor_reference.'</strong><br>';

			}


			if(!empty($case_handler_id)){
				//$to_user_id = $case_handler_id;
			}



			if (!empty($case_master_id)) {

				$toaddress_name ='';
				if(!empty($to_user_id))
				$toUserDet = $this->User->find('first', array('conditions' => array('User.id' => $to_user_id), 'recursive' => 2));

				//debug($toUserDet);
				//Added By mskt
				if($SpecficCvId){
					$SpecficExpertName = ucfirst($toUserDet['User']['title'])." " .$toUserDet['User']['forename']." " .$toUserDet['User']['middlename']." " .$toUserDet['User']['surname'];
				}


				if(!empty($toUserDet)){
					if(!empty($to_user_company_id))
					$toUserCompanyDet = $this->User->find('first', array('conditions' => array('User.id' => $to_user_company_id), 'recursive' => 2));
					$touser_company_name=$toUserCompanyDet['Company']['name'];
					if(!empty($touser_company_name)){
						$toaddress_name = ucfirst($toUserDet['User']['title'])." " .$toUserDet['User']['forename']." " .$toUserDet['User']['middlename']." " .$toUserDet['User']['surname']."<br/>";
						$toaddress_name .=$touser_company_name;
					}else{
						$toaddress_name = ucfirst($toUserDet['User']['title'])." " .$toUserDet['User']['forename']." " .$toUserDet['User']['middlename']." " .$toUserDet['User']['surname'];
					}
				}else{
					if(!empty($to_user_company_id)){
						$toUserCompanyDet = $this->User->find('first', array('conditions' => array('User.id' => $to_user_company_id), 'recursive' => 2));
						$toaddress_name=$toUserCompanyDet['Company']['name'];
					}

				}
				if(!empty($to_user_id_address))
				$toAddress = $this->Address->find('first', array('conditions' => array('Address.user_id' => $to_user_id_address,'address_type'=>'billing'), 'recursive' => -1));
				if(empty($toAddress)){
					$toAddress = $this->Address->find('first', array('conditions' => array('Address.user_id' => $to_user_id_address), 'recursive' => -1));
				}

				if(!empty($toAddress)){
					if(!empty($toaddress_name))
						$toaddress_header=$toaddress_name ."<br>".$toAddress['Address']['address1'];
					else
						$toaddress_header= $toAddress['Address']['address1'];

				if(isset($toAddress['Address']['address2']) && $toAddress['Address']['address2'] !=""){
					$toaddress_header .="<br>".$toAddress['Address']['address2'];
				}
				if(isset($toAddress['Address']['address3']) && $toAddress['Address']['address3'] !=""){
					$toaddress_header .="<br>".$toAddress['Address']['address3'];
				}
				if(isset($toAddress['Address']['address4']) && $toAddress['Address']['address4'] !=""){
					$toaddress_header .="<br>".$toAddress['Address']['address4'];
				}
				if(isset($toAddress['Address']['address5']) && $toAddress['Address']['address5'] !=""){
					$toaddress_header .="<br>".$toAddress['Address']['address5'];
				}
				if(isset($toAddress['Address']['town']) && $toAddress['Address']['town'] !=""){
					$toaddress_header .="<br>".$toAddress['Address']['town'];
				}
				$toaddress_header .="<br>".$toAddress['Address']['postcode'];
				if(isset($instructor_company_arr['Address']['work_telephonec']) && $instructor_company_arr['Address']['work_telephonec'] !=""){
					$toaddress_header .="<br>".$instructor_company_arr['Address']['work_telephonec']." (W)";
				}
				if(isset($instructor_company_arr['Address']['mobile']) && $instructor_company_arr['Address']['mobile'] !=""){
					$toaddress_header .="<br>".$instructor_company_arr['Address']['mobile']." (M)";
				}

				}


			}







			$claimant_address_text = '';

			$claimant_det_text ='';


			if($case_master_id!=''){

				$case_dump = $this->CaseMaster->find('first', array('conditions' => array('CaseMaster.id' => $case_master_id), 'recursive' => 2));
				
			}			
				// looping throught CaseMaster dump
				/*	foreach ($case_dump AS $key => $value) {}*/
				/*$case_user_dump = $case_dump['CaseUser'];
				$case_user_dump = array_reverse($case_user_dump, true);
				// looping throught CaseUserDump
				if ($logged_user_group_id == Configure::read('ExpertSuperUser') || $logged_user_group_id == Configure::read('TherapistSuperUser')) {
					// for expert login
					$last_guy_details = current($case_user_dump);
					$secondlast_guy_details = next($case_user_dump);
				}

				$lastElement=array();
				$seconLastElement=array();
				if(!empty($last_guy_details)){
					//lat guy details
					$lastElement['id']=$last_guy_details['id'];
					$lastElement['user_id']=$last_guy_details['user_id'];
					$lastElement['user_reference']=$last_guy_details['user_reference'];
					$lastElement['report_date']=$last_guy_details['report_date'];
					$lastElement['user_type']=$last_guy_details['user_type'];
					$lastElement['case_handler_id']=$last_guy_details['case_handler_id'];
					$lastElement['fees_master_id']=$last_guy_details['fees_master_id'];
					$lastElement['report_file_name']=$last_guy_details['report_file_name'];
					$lastElement['report_file_path']=$last_guy_details['report_file_path'];

					//secondlast guy details
					$seconLastElement['user_id']=$secondlast_guy_details['user_id'];
					$seconLastElement['user_reference']=$secondlast_guy_details['user_reference'];
					$seconLastElement['report_date']=$secondlast_guy_details['report_date'];
					$seconLastElement['user_type']=$secondlast_guy_details['user_type'];
					$seconLastElement['case_handler_id']=$secondlast_guy_details['case_handler_id'];
					$seconLastElement['fees_master_id']=$secondlast_guy_details['fees_master_id'];
					$seconLastElement['report_file_name']=$secondlast_guy_details['report_file_name'];
					$seconLastElement['report_file_path']=$secondlast_guy_details['report_file_path'];
					$last_user_id=$lastElement['user_id'];
					$secnd_last_user_id=$seconLastElement['user_id'];

				}
				if($logged_user_group_id!=Configure::read('ExpertSuperUser') || $logged_user_group_id!=Configure::read('TherapistSuperUser')){
					$your_reference=$case_dump['CaseMaster']['case_id'];
					$report_date=$seconLastElement['report_date'];
				}else{
					$your_reference=$lastElement['user_reference'];
					$report_date=$lastElement['report_date'];
				}
				$our_reference=$seconLastElement['user_reference'];
				//$claim_name = $case_dump['CaseClaimantDetail']['forename'];
			}*/
				
			//Addded by mkst ( 02-Mar-2018 )
			$preferred_venue 		= '';
			$preferred_expert_id	= '';
			if($case_dump['CaseMaster']['preferred_expert_id'] AND $case_dump['CaseMaster']['preferred_venue']){
				$preferred_venue 		= $case_dump['CaseMaster']['preferred_venue'];
				$preferred_expert_id 	= $case_dump['CaseMaster']['preferred_expert_id'];
			}


			$CaseUsers = $this->CaseUser->find('all', array('conditions' => array('CaseUser.case_master_id' => $case_master_id,'(CaseUser.additional_info IS NULL OR CaseUser.additional_info="")'), 'recursive' =>-1,'order' => array('CaseUser.id ASC')));

                        //echo '<pre>';
                        //print_r($CaseUsers);			
			foreach($CaseUsers as $key=>$usrDetail ){
				$user_id=$usrDetail['CaseUser']['user_id'];
				if (($logged_user_group_id == Configure::read('ExpertSuperUser')) && ($user_id==$this->logged_in_user_id)) {
					$last_guy_details=$usrDetail['CaseUser'];
					$secondlast_guy_details=$CaseUsers[$key-1]['CaseUser'];

					$your_reference=$secondlast_guy_details['user_reference'];
					$report_date=$last_guy_details['report_date'];
					$our_reference=$case_dump['CaseMaster']['case_id'];;
					
					$medical_records = $case_dump['CaseUser'][$key-1]['FeesMaster']['name']; //Added By mskt
				}
				if (($logged_user_group_id == Configure::read('TherapistSuperUser')) && ($user_id==$this->logged_in_user_id)) {
					$last_guy_details=$usrDetail['CaseUser'];
					$secondlast_guy_details=$CaseUsers[$key-1]['CaseUser'];

					$your_reference=$secondlast_guy_details['user_reference'];
					$report_date=$last_guy_details['report_date'];
					$our_reference=$case_dump['CaseMaster']['case_id'];;
					
					$medical_records = $case_dump['CaseUser'][$key-1]['FeesMaster']['name']; //Added By mskt
				}
				if (($logged_user_group_id == Configure::read('AgentSuperUser')) && ($user_id==$this->logged_in_user_id)) {

                                        $last_guy_details=$usrDetail['CaseUser'];
					$secondlast_guy_details=$CaseUsers[$key-1]['CaseUser'];

					if($case_handler_type=="agency")
						$your_reference=$secondlast_guy_details['user_reference'];
					else
						$your_reference=$case_dump['CaseMaster']['case_id'];


					$report_date=$secondlast_guy_details['report_date'];
					$our_reference=$last_guy_details['user_reference'];
					
					$medical_records = $case_dump['CaseUser'][$key-1]['FeesMaster']['name']; //Added By mskt
				}
			}

			//debug($our_reference);
			//echo $your_reference;


			if(!empty($our_reference)){
				$our_reference_text = 'Our Reference: '.$our_reference;
			}

			if(!empty($your_reference)){
				$your_reference_text = 'Your Reference: '.$your_reference;
			}

			//debug($case_dump);

			$appointment_date_text = '';

                        $appointment_venue_text = '';

                        if($case_master_id!=""){

                        $appointment_id =  $case_dump['CaseMaster']['appointment_id'];

                        $case_appointment_details = $this->Appointment->find('first', array('recursive' => -1, 'conditions' => array('id' => $appointment_id, 'dna_status' => 0, 'status_id' => 10)));

                        }


			if(!empty($case_appointment_details['Appointment']['slot_date']) && $case_appointment_details['Appointment']['status_id']!='17'){

                        $app_date_time=date("d/m/Y",strtotime($case_appointment_details['Appointment']['slot_date'])).' @ '.date('H:i ',strtotime($case_appointment_details['Appointment']['slot_start_time']));
			$appointment_date_text = '<tr>
    			<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; "><strong>Appointment Date</strong></td>
    			<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; ">'.$app_date_time.'</td>
  				</tr>';

                        $slot_parent_id = $case_appointment_details['Appointment']['slot_parent_id'];

                        $slot_parent_details = $this->SlotParent->find('first', array('recursive' => -1, 'conditions' => array('SlotParent.id' => $slot_parent_id)));

                        $venue_id = $slot_parent_details['SlotParent']['consulting_venue_id'];



                        $venue_details = $this->ConsultingVenue->find('first', array('recursive' => -2, 'conditions' => array('ConsultingVenue.id' => $venue_id)));


                        $venue_address = '';
                        if(isset($venue_details['ConsultingVenue']['name']) && $venue_details['ConsultingVenue']['name'] !=""){
				$venue_address =$venue_details['ConsultingVenue']['name'];
			}

			if(isset($venue_details['Address']['address1']) && $venue_details['Address']['address1'] !=""){
				$venue_address =$venue_details['Address']['address1'];
			}
			if(isset($venue_details['Address']['address2']) && $venue_details['Address']['address2'] !=""){
				$venue_address .="<br>".$venue_details['Address']['address2'];
			}
			if(isset($venue_details['Address']['address3']) && $venue_details['Address']['address3'] !=""){
				$venue_address .="<br>".$venue_details['Address']['address3'];
			}

			if(isset($venue_details['Address']['town']) && $venue_details['Address']['town'] !=""){
				$venue_address .="<br>".$venue_details['Address']['town'];
			}
			if(isset($venue_details['Address']['county']) && $venue_details['Address']['county'] !=""){
				$venue_address .="<br>".$venue_details['Address']['county'];
			}
			if(isset($venue_details['Address']['postcode']) && $venue_details['Address']['postcode'] !=""){
				$venue_address .="<br>".$venue_details['Address']['postcode'];
			}

                        if(!empty($venue_address)){
                            $appointment_venue_text = '<tr>
                            <td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;"><strong>Clinic Address</strong></td>
                            <td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;">'.$venue_address.'</td>
                            </tr>';
			}

			} else if($preferred_venue AND $preferred_expert_id){ //Added by mskt ( 02-Mar-2018 )
				
				$venue_id 		= $preferred_venue;				
				$venue_details  = $this->ConsultingVenue->find('first', array('recursive' => -2, 'conditions' => array('ConsultingVenue.id' => $venue_id)));
				
				
				$venue_address = '';
				if(isset($venue_details['ConsultingVenue']['name']) && $venue_details['ConsultingVenue']['name'] !=""){
					$venue_address .=$venue_details['ConsultingVenue']['name'];
				}
				
				if(isset($venue_details['Address']['address1']) && $venue_details['Address']['address1'] !=""){
					$venue_address .="<br>".$venue_details['Address']['address1'];
				}
				if(isset($venue_details['Address']['address2']) && $venue_details['Address']['address2'] !=""){
					$venue_address .="<br>".$venue_details['Address']['address2'];
				}
				if(isset($venue_details['Address']['address3']) && $venue_details['Address']['address3'] !=""){
					$venue_address .="<br>".$venue_details['Address']['address3'];
				}				
				if(isset($venue_details['Address']['town']) && $venue_details['Address']['town'] !=""){
					$venue_address .="<br>".$venue_details['Address']['town'];
				}
				if(isset($venue_details['Address']['county']) && $venue_details['Address']['county'] !=""){
					$venue_address .="<br>".$venue_details['Address']['county'];
				}
				if(isset($venue_details['Address']['postcode']) && $venue_details['Address']['postcode'] !=""){
					$venue_address .="<br>".$venue_details['Address']['postcode'];
				}
				
				if(!empty($venue_address)){
					$appointment_venue_text = '<tr>
					<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;"><strong>Preferred Venue Address</strong></td>
					<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;">'.$venue_address.'</td>
					</tr>';
				}
			}

			//debug($case_dump);


                        if($case_dump['CaseClaimantDetail']['title']!='' || $case_dump['CaseClaimantDetail']['title']!='NULL'){
                            $case_dump['CaseClaimantDetail']['title'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['title']);
                        }
                        if($case_dump['CaseClaimantDetail']['forename']!='' || $case_dump['CaseClaimantDetail']['forename']!='NULL'){
                            $case_dump['CaseClaimantDetail']['forename'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['forename']);
                        }
                        if($case_dump['CaseClaimantDetail']['surname']!='' || $case_dump['CaseClaimantDetail']['surname']!='NULL'){
                            $case_dump['CaseClaimantDetail']['surname'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['surname']);
                        }

			$claim_name=$case_dump['CaseClaimantDetail']['title']." ".$case_dump['CaseClaimantDetail']['forename']." ".$case_dump['CaseClaimantDetail']['surname'];

			$claim_name_text='<tr>
			<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;"><strong>Claimant Name</strong>  </td>
			<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;">'.$claim_name.'</td>
			<!-- </tr> -->';

			$claim_dob = '';
			if (!empty($case_dump['CaseClaimantDetail']['dateofbirth']) && $case_dump['CaseClaimantDetail']['dateofbirth']!='NULL' && $case_dump['CaseClaimantDetail']['dateofbirth']!='0000-00-00') {
				$claim_dob=$this->Date->format($case_dump['CaseClaimantDetail']['dateofbirth']);
			}

                        $claimant_dob_text = '';

			if($claim_dob!=''){
			$claimant_dob_text = '<tr>
    				<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;"><strong>Date of Birth</strong></td>
    				<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;">'.$claim_dob.'</td>
  					<!-- </tr> -->';

			}
			$claimant_detail = $case_dump['CaseClaimantDetail'];

			//debug($claimant_detail);

                        if($claimant_detail['Address']['address1']!='' || $claimant_detail['Address']['address1']!='NULL'){
                            $claimant_detail['Address']['address1'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['address1']);
                        }
                        if($claimant_detail['Address']['address2']!='' || $claimant_detail['Address']['address2']!='NULL'){
                            $claimant_detail['Address']['address2'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['address2']);
                        }
                        if($claimant_detail['Address']['address3']!='' || $claimant_detail['Address']['address3']!='NULL'){
                            $claimant_detail['Address']['address3'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['address3']);
                        }
                        if($claimant_detail['Address']['address4']!='' || $claimant_detail['Address']['address5']!='NULL'){
                            $claimant_detail['Address']['address4'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['address5']);
                        }
                        if($claimant_detail['Address']['address5']!='' || $claimant_detail['Address']['address5']!='NULL'){
                            $claimant_detail['Address']['address5'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['address5']);
                        }
                        if($claimant_detail['Address']['town']!='' || $claimant_detail['Address']['town']!='NULL'){
                            $claimant_detail['Address']['town'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['town']);
                        }
                        if($claimant_detail['Address']['county']!='' || $claimant_detail['Address']['county']!='NULL'){
                            $claimant_detail['Address']['county'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['county']);
                        }
                        if($claimant_detail['Address']['postcode']!='' || $claimant_detail['Address']['postcode']!='NULL'){
                            $claimant_detail['Address']['postcode'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['postcode']);
                        }

			$claimant_address = '';
			if(isset($claimant_detail['Address']['address1']) && $claimant_detail['Address']['address1'] !=""){
				$claimant_address =$claimant_detail['Address']['address1'];
			}
			if(isset($claimant_detail['Address']['address2']) && $claimant_detail['Address']['address2'] !=""){
				$claimant_address .="<br>".$claimant_detail['Address']['address2'];
			}
			if(isset($claimant_detail['Address']['address3']) && $claimant_detail['Address']['address3'] !=""){
				$claimant_address .="<br>".$claimant_detail['Address']['address3'];
			}
			if(isset($claimant_detail['Address']['address4']) && $claimant_detail['Address']['address4'] !=""){
				$claimant_address .="<br>".$claimant_detail['Address']['address4'];
			}
			if(isset($claimant_detail['Address']['address5']) && $claimant_detail['Address']['address5'] !=""){
				$claimant_address .="<br>".$claimant_detail['Address']['address5'];
			}
			if(isset($claimant_detail['Address']['town']) && $claimant_detail['Address']['town'] !=""){
				$claimant_address .="<br>".$claimant_detail['Address']['town'];
			}
			if(isset($claimant_detail['Address']['county']) && $claimant_detail['Address']['county'] !=""){
				$claimant_address .="<br>".$claimant_detail['Address']['county'];
			}
			if(isset($claimant_detail['Address']['postcode']) && $claimant_detail['Address']['postcode'] !=""){
				$claimant_address .="<br>".$claimant_detail['Address']['postcode'];
			}




			if($case_handler_type=="claimant"){
				$toaddress_header = $claim_name.'<br/>'.$claimant_address;
				//$our_reference_text = '';
				$your_reference_text = '';
			}

			if(!empty($claimant_address)){
			$claimant_address_text = '<!-- <tr> -->
			<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;"><strong>Address</strong></td>
			<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;">'.$claimant_address.'</td>
			</tr>';
			}
			//debug($case_dump);

			$accident_date = '';
			if (!empty($case_dump['CaseAccidentDetail'][0]['accident_date']) && $case_dump['CaseAccidentDetail'][0]['accident_date']!='NULL' && $case_dump['CaseAccidentDetail'][0]['accident_date']!='0000-00-00') {
				$accident_date=date('d/m/Y',strtotime($case_dump['CaseAccidentDetail'][0]['accident_date']));
			}
			$accident_date_text= '';
			if($accident_date!=""){

			$accident_date_text = '<!-- <tr> -->
			<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; "><strong>Accident Date</strong></td>
			<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; ">'.$accident_date.'</td>
			</tr>';
			}		

			$report_date_text = '';

			if(!empty($report_date)){
				$report_date=date('d/m/Y',strtotime($report_date));

				$report_date_text = '<tr>
				<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; "><strong>Report Date</strong></td>
				<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; ">'.$report_date.'</td>
				</tr>';

			}
			
			//Added By mskt
			$report_type_text = '';
			if(!empty($case_dump['CaseMaster']['report_master_id'])){
				$report_types_data = $this->ReportMaster->find('first',array('fields'=>array('id','value'),'conditions'=>array('ReportMaster.medico_legal'=>1, 'ReportMaster.id'=>$case_dump['CaseMaster']['report_master_id'])));
				
				if(count($report_types_data) > 0){
					$report_type_text = '<tr>
					<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; "><strong>Report Type</strong></td>
					<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; ">'.$report_types_data['ReportMaster']['value'].'</td>
					<!-- </tr> -->';
				}
			}
			
			$accident_type_text = '';
			if(!empty($case_dump['CaseAccidentDetail'][0]['accident_type'])){
				$accident_type_text = '<!-- <tr> -->
				<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; "><strong>Accident Type</strong></td>
				<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; ">'.$case_dump['CaseAccidentDetail'][0]['accident_type'].'</td>
				</tr>';
			}			
			
			$medical_records_text = '';
			if(!empty($medical_records)){
				$medical_records_text = '<tr>
				<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; "><strong>Medical Records</strong></td>
				<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; " colspan="3">'.$medical_records.'</td>
				</tr>';
			}
			
			//Added By mskt
			//$case_dump['CaseAccidentDetail'][0]['medical_record'] = 'yes';
			$Add_Medical_Records_text = '';
			if(@$case_dump['CaseAccidentDetail'][0]['medical_record'] == 'yes'){
				$case_accident_record  = $this->CaseAccidentRecord->find('all',array('fields'=>array('CaseAccidentRecord.id','CaseAccidentRecord.case_master_id', 'CaseAccidentRecord.primary_record_other_text', 'CaseAccidentRecord.primary_record_id', 'CaseAccidentRecord.requested_date', 'CaseAccidentRecord.requested_type', 'CaseAccidentRecord.hold', 'MedicalRecordMaster.value', 'MedicalRecordMaster.long_description'), 'joins'=>array(array('table' => 'medical_record_masters', 'alias' => 'MedicalRecordMaster', 'conditions'=> array('MedicalRecordMaster.id = CaseAccidentRecord.primary_record_id', 'CaseAccidentRecord.case_master_id' => $case_master_id))), 'recursive' => -1));
				
				if(count($case_accident_record) > 0){
					$car = 1;
					$Add_Medical_Records_text = '<tr><td colspan="4"><table width="100%" border="0" cellspacing="1" cellpadding="4" ><tr>
					<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; "><strong>Sno.</strong></td>
					<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; "><strong>Record Type</strong></td>					
					<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; "><strong>Status</strong></td>					
					<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; "><strong>Build Interim Report</strong></td>
					</tr>';
					foreach($case_accident_record as $key_case_accident_record => $val_case_accident_record){
						$car_Record_Type 		= $val_case_accident_record['MedicalRecordMaster']['value'];
						$car_requested_date 	= $val_case_accident_record['CaseAccidentRecord']['requested_date'] != '0000-00-00' ? $val_case_accident_record['CaseAccidentRecord']['requested_date'] : '';
						$car_requested_type 	= $val_case_accident_record['CaseAccidentRecord']['requested_type'];
						$car_hold 				= $val_case_accident_record['CaseAccidentRecord']['hold'] ? 'Yes' : 'No';
						$Add_Medical_Records_text .='<tr>
						<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; ">'.$car.'</td>
						<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; ">'.$car_Record_Type.'</td>						
						<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; ">'.$car_requested_type.'</td>						
						<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; ">'.$car_hold.'</td>
						</tr>';
						$car++;
					}
					$Add_Medical_Records_text .= '</table></td></tr>';
				}
				
			}

		}

		$claimant_det_text ='';

		if(!empty($claim_name_text) || !empty($claimant_address_text) || !empty($claimant_dob_text) || !empty($accident_date_text)){
		
		//Added By mskt (concation)
		if($specfic_address){			
			$specfic_address_data = '<tr>
			<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; "><strong>Experts Name</strong></td>
			<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; ">'.$SpecficExpertName.'</td>
			<!-- </tr>
			<tr> -->
			<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; "><strong>Venue</strong></td>
			<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; ">'.$specfic_address.'</td>
			</tr>';
		}
		
		//Added By mskt
		$template_name_data = '';
		if($template_name){
			$template_name_data = '<div align="center" style="font: 15px Cambria, Arial, Helvetica, sans-serif; color: #000; margin-top: -20px;  margin-bottom: 15;"><strong>'.$template_name.'</strong></div>';
		}
		$claimant_det_text = $template_name_data.'<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #6d5049;">
		<tr>
		<td>
		<table width="100%" border="0" cellspacing="1" cellpadding="4" >'.
		$claim_name_text.
		$claimant_address_text.
		$claimant_dob_text.
		$accident_date_text.
		$appointment_date_text.
        $appointment_venue_text.
		$report_date_text.
		$specfic_address_data.
		$report_type_text.
		$accident_type_text.
		$medical_records_text.
		$Add_Medical_Records_text.
		'</table>
		</td>
		</tr>
		</table>';
		}


		$myFile = Configure::read('coral_root_path')."/app/webroot/templates/create_letter_case_content.html";

		//$content = file_get_contents($myFile);

		$file_funs = file($myFile);
		foreach ($file_funs as $file_num => $file_fun) {
			//$file_fun = str_replace('$header_logo$', $header_logo, $file_fun);
			$file_fun = str_replace('$instructor_header$', $instruction_header, $file_fun);
			$file_fun = str_replace('$toaddress_header$', $toaddress_header, $file_fun);
			//Added By mskt
			//$file_fun = str_replace('$our_reference_text$', $our_reference_text, $file_fun);
			if($case_handler_type == 'expert'){
				$file_fun = str_replace('$our_reference_text$', '', $file_fun);
			}else{
				$file_fun = str_replace('$our_reference_text$', $our_reference_text, $file_fun);
			}
			$file_fun = str_replace('$your_reference_text$', $your_reference_text, $file_fun);
			$file_fun = str_replace('$solicitor_reference_text$', $solicitor_reference_text, $file_fun);


			$file_fun = str_replace('$cur_date$', $cur_date, $file_fun);

			$file_fun = str_replace('$claimant_det_text$', $claimant_det_text, $file_fun);

			$file_fun = str_replace('$send_user_comp_name_text$', $send_user_comp_name_text, $file_fun);

			$file_fun = str_replace('$send_user_name$', $send_user_name, $file_fun);

			$file_fun = str_replace('$template_content$', $template_content, $file_fun);

			$file_fun = str_replace('$contact_details$', $contact_details, $file_fun);



			$content.= $file_fun;
		}

                $letter_subject = '';
                $template_file_name = '';
				if($case_master_id!="" && $template_name!=""){

                    $template_file_name = $claim_name.'-'.$template_name;
                    $letter_subject = $claim_name.' , '.$template_name;

                    if($your_reference!=""){
						//Added By mskt
						//$letter_subject = $claim_name.' , Your Ref :'.$your_reference.' , '.$template_name;
						$letter_subject = $claim_name.' , Our Ref :'.$your_reference.' , '.$template_name;
                    }
                }
                else if($case_master_id!="" && $template_name==""){
                    $template_file_name = $claim_name;
                    $letter_subject = $claim_name;
                    if($your_reference!=""){
                        $letter_subject = $claim_name.' , Your Ref :'.$your_reference;
                    }
                }

		$finalArray['content'] = $content;
        $finalArray['letter_subject'] = $letter_subject;
		$finalArray['template_file_name'] = $template_file_name;
			
		//Added By mskt
		$finalArray['template_id'] 		= $template_id;
		if(empty($case_dump['CaseMaster']['preferred_expert_id']) AND $case_handler_type == 'expert'){
			$finalArray['to_user_id'] 		= $specfic_expert_id;
			$finalArray['to_user_type'] 	= $case_handler_type;
			$finalArray['to_user_email_id'] = $case_handler_email;
			$finalArray['to_user_cv'] 		= $SpecficCvId;
		}

		$_SESSION['letter_content'] = $content;


		echo json_encode($finalArray);

		exit;


	}

	function print_letter_preview(){

		$file_name = $_REQUEST['file_name'];


		$file_name = str_replace(" ",'_',$file_name);
                $file_name = str_replace("'",'_',$file_name);

		$checkFolderExits = WWW_ROOT."uploads/expert/";
		if (!file_exists($checkFolderExits)) {
			mkdir($checkFolderExits, 0777);
		}

		$checkFolderExits = WWW_ROOT."uploads/expert/".$this->LinUid;
		if (!file_exists($checkFolderExits)) {
			mkdir($checkFolderExits, 0777);
		}

		$checkFolderExits = WWW_ROOT."uploads/expert/".$this->LinUid."/PreviewLetters";
		if (!file_exists($checkFolderExits)) {
			mkdir($checkFolderExits, 0777);
		}

		$folderPath = WWW_ROOT."uploads/expert/".$this->LinUid."/PreviewLetters/";



		$printContent = $_SESSION['letter_content'];

		$path = $folderPath;
		$fileName = $file_name;
		$print_html_file_name = $folderPath.'/'.$fileName.".html";






		$print_file = fopen($print_html_file_name, 'wb') or die("can't open file");
		fwrite($print_file, $printContent);
		fclose($print_file);


		$Pdf = new LetterPdfComponent();
		// Invoice name (output name)
		$Pdf->filename = $fileName; // Without .pdf
		// You can use download, file or browser here
		$Pdf->output = 'file';

		//$Pdf->headerhtml = '<div align="left" style="height:50px"> </div>';

		//$Pdf->footerhtml = '<div align="left" style="height:50px"> </div>';


		$Pdf->init($path);
		$Pdf->media->set_landscape(false);

		Configure::write('pdf_html_link', $print_html_file_name);
		$Pdf->process(Router::url('/', true) . 'build_letters/download_print_pdf_view/'.$fileName.'/'.$this->logged_in_user_id);

		$file_path = $folderPath.'/'.$fileName.".pdf";

		$file_name = $fileName.".pdf";

		$this->File->output_file($file_path, $file_name);

		exit;





	}

	function download_print_pdf_view($file_name = null, $logged_in_user_id = null) {

		//$this->autoRender = false;

		$expert_uploads=Configure::read('expert_uploads');
		$expert_appointment_folder=$expert_uploads.$logged_in_user_id.'/PreviewLetters/';
		$html_file_path=$expert_appointment_folder.$file_name.".html";

		$content = file_get_contents ($html_file_path);

		$this->set('content',$content);

		$this->layout = "ajax";

	}

	//Added By mskt
	//function create_letter($letterId,$selected_case_master_id=null)
	function create_letter($letterId,$selected_case_master_id=null, $data=null) //Added argument mskt
	{	

        if ($this->Session->read('Auth.User.group_id')==Configure::read('AdminUser')) {

			$logged_in_user_id = $this->Session->read('Auth.User.parent_id');

		} else {

			$logged_in_user_id = $this->Session->read('Auth.User.id');

		}
		
		//Added By mskt
		$specfic_expert_id 		= '';
		$specfic_cv_id 			= '';
		$specfic_expert_data 	= '';
		if($data){
			$specfic_expert_data = $this->EncryptionFunctions->deCrypt($data);
			
			if($specfic_expert_data){
				$expert_cv_id_data   = explode('_', $specfic_expert_data);
				
				$specfic_expert_id   = $expert_cv_id_data[0];
				$specfic_cv_id		 = $expert_cv_id_data[1];				
			}			
		}
		$this->set('specfic_expert_data', $specfic_expert_data);
		$this->set('specfic_expert_id', $specfic_expert_id);
		$this->set('specfic_cv_id', $specfic_cv_id);
		

		$find_case_search_criteria = array();

		if(isset($_SESSION['search_criterea']) && !empty($_SESSION['search_criterea'])){

		$find_case_search_criteria = $_SESSION['search_criterea'];

		}
		//$sendEmailPopup = false;

		//$_SESSION['show_email_popup'] = 'false';

		//If the form is submitted
		if( !empty($this->data) )
		{

			//debug($this->params);
			$edited_letter_id = 0;
			if($this->data['GeneralLetter']['id']>0){
				$edited_letter_id = $this->data['GeneralLetter']['id'];
				$this->data['GeneralLetter']['id'] = 0;
				$this->data['GeneralLetter']['edited'] = 1;
			}

			$preselected_case_master_id = 0;
			$preselected_case_master_id =$this->data['GeneralLetter']['preselected_case_master_id'];

			//debug($this->data);
			//exit;

			$date = date("Y-m-d : H:i:s", time());
			//$description = str_replace("<p>", "", $this->data['GeneralLetter']['description']);
			//$description = str_replace("</p>", "<br>", $description);
			$this->data['GeneralLetter']['description'] = $this->data['GeneralLetter']['description'];

			$description = $this->data['GeneralLetter']['description'];
			$printContent = $this->data['GeneralLetter']['description'];

			$this->data['GeneralLetter']['created_by'] = $_SESSION['Auth']['User']['id'];
			if( (int)$letterId == 0){
				$this->data['GeneralLetter']['created'] = $date;
				$this->data['GeneralLetter']['modified'] = '';
			}else{
				$this->data['GeneralLetter']['modified'] = $date;
			}

			if($this->data['GeneralLetter']['case_id'] == ''){
				$this->data['GeneralLetter']['case_id'] = 0;
			}else{
				$case_master_id = $this->data['GeneralLetter']['case_id'];

			}			

			if( $this->data['GeneralLetter']['template_id'] == ''){
				$this->data['GeneralLetter']['template_id'] = 0;
			}

			if(!empty($this->data['GeneralLetter']['file_name'])){
				$order   = array(" ");
				$replace = '_';
				$file_name = str_replace($order, $replace, $this->data['GeneralLetter']['file_name']);

                                $curent_date_file_name = date('d-m-Y');
				$this->data['GeneralLetter']['file_name'] = $file_name.'_'.$curent_date_file_name;


			}

			//debug($this->data);
			//exit;



			$page_action = $this->data['GeneralLetter']['action'];


			$caseMasterId =0;

			if($this->GeneralLetter->save($this->data))
			{

				$general_letter_id = $this->GeneralLetter->getLastInsertID();

				$checkFolderExits = WWW_ROOT."uploads";
				if (!file_exists($checkFolderExits)) {
					mkdir($checkFolderExits, 0777);
				}




				if($this->data['GeneralLetter']['case_id'] == 0 || empty($this->data['GeneralLetter']['case_id']))
				{
					$checkFolderExits = WWW_ROOT."uploads/expert/";
					if (!file_exists($checkFolderExits)) {
						mkdir($checkFolderExits, 0777);
					}

					$checkFolderExits = WWW_ROOT."uploads/expert/".$this->LinUid;
					if (!file_exists($checkFolderExits)) {
						mkdir($checkFolderExits, 0777);
					}

					$checkFolderExits = WWW_ROOT."uploads/expert/".$this->LinUid."/GenericLetters";
					if (!file_exists($checkFolderExits)) {
						mkdir($checkFolderExits, 0777);
					}

					$folderPath = WWW_ROOT."uploads/expert/".$this->LinUid."/GenericLetters/";

					$type = 1;

				}
				else
				{

					$caseMasterId = $case_master_id;


                                        $case_folder_array = $this->CommonFunctions->make_case_folder($caseMasterId);
                                        $case_directory = $case_folder_array['case_directory'];

					$checkFolderExits = $case_directory."GenericLetters";
					if (!file_exists($checkFolderExits)) {
						mkdir($checkFolderExits, 0777);
					}

					$folderPath = $case_directory."GenericLetters/";
					$type = 2;

					$fileName = $this->data['GeneralLetter']['file_name'];

					$file_name_value = $fileName;
					$file_name_array = explode('_',$file_name_value);
					array_pop($file_name_array);
					$file_name_new_value = implode('_',$file_name_array);

					$to_user_name = $this->get_touser_name($general_letter_id);

					if(!empty($to_user_name)){
						$comment=$file_name_new_value.'('.$to_user_name.')';
					}else{
						$comment=$file_name_new_value;
					}

					if($letterId>0){
						$this->make_case_log_entry($case_master_id, 74,$comment);
					}else{
						$this->make_case_log_entry($case_master_id, 73,$comment);
					}

				}


				$pdf_created = false;
				$path = $folderPath;
				$fileName = $this->data['GeneralLetter']['file_name'];
				$print_html_file_name = $folderPath.'/'.$fileName.".html";





				$print_file = fopen($print_html_file_name, 'wb') or die("can't open file");
				fwrite($print_file, $printContent);
				fclose($print_file);


				$printed_by_text=ucfirst(trim($_SESSION['Auth']['User']['title'].' '.$_SESSION['Auth']['User']['forename'].' '.$_SESSION['Auth']['User']['middlename'].' '.$_SESSION['Auth']['User']['surname'])) .'  @  '.date('H:i:s') .', '.date('l jS F Y');


				$Pdf = new LetterPdfComponent();
				// Invoice name (output name)
				$Pdf->filename = $fileName; // Without .pdf
				// You can use download, file or browser here
				$Pdf->output = 'file';

				$logo ='';

				$stringHeader ='';

				/*$Pdf->headerhtml = '<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" class="table_wrap_content">
				<tr>
				<td height="50px;">

				</td>
				</tr>
				</table>';*/

				//$Pdf->footerhtml = '<div align="left" style="font-size:10px;border-top:1px solid #000000;margin-top:20px;">Printed by: '.$printed_by_text.' </div>';

				/*$Pdf->footerhtml = '<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" class="table_wrap_content">
				<tr>
				<td height="50px;">

				</td>
				</tr>
				</table>';*/

				$Pdf->headerhtml = '<div align="left" style=""> </div>';

				$Pdf->footerhtml = '<div align="left" style=""> </div>';


				$Pdf->init($path);
				$Pdf->media->set_landscape(false);

				Configure::write('pdf_html_link', $print_html_file_name);
				$Pdf->process(Router::url('/', true) . 'build_letters/download_pdf_view/'.$fileName.'/'.$this->logged_in_user_id.'/'.$type.'/'.$caseMasterId);

				$pdf_created = true;

				$_SESSION['general_letter_id'] = 0;



				if($page_action=='saveandemail' && $pdf_created==true){

					$sendEmailPopup = true;

					$_SESSION['show_email_popup'] = 'true';

					$_SESSION['general_letter_id'] = $general_letter_id;


					$email_success_redirect = '';

					$_SESSION['email_success_redirect'] = '';

					if($caseMasterId==0){
						$email_success_redirect = Router::url(array('controller' => 'build_letters', 'action' => 'view_letters'));
					}
					else if($edited_letter_id>0 && $caseMasterId>0){
						$encrypted_casemaster_id = $this->EncryptionFunctions->enCrypt($caseMasterId);
						$encrypted_acc_id = '';
						$encrypted_tab_id = $this->EncryptionFunctions->enCrypt(8);
						$email_success_redirect = Router::url(array('controller'=>'manage_cases','action' => 'show_case',$encrypted_casemaster_id,$encrypted_acc_id,$encrypted_tab_id));

					}else if($preselected_case_master_id){
						 $email_success_redirect = Router::url(array('controller'=>'manage_cases','action' => 'find_cases','medico_legal'));
					}
					else{
						$email_success_redirect = Router::url(array('controller' => 'build_letters', 'action' => 'create_letter',0));
					}

					$_SESSION['email_success_redirect'] = $email_success_redirect;

					$this->redirect(array('action' => 'create_letter',0));

				}else{
					$_SESSION['show_email_popup'] = 'false';

					$_SESSION['general_letter_id'] = 0;

					$this->Session->setFlash("The Letter has been saved successfully.",'default', array('class' => 'message success'));

					if($caseMasterId==0){
						$this->redirect(array('action' => 'view_letters'));
					}else if($edited_letter_id>0 && $caseMasterId>0){
						$encrypted_casemaster_id = $this->EncryptionFunctions->enCrypt($caseMasterId);
						$encrypted_acc_id = '';
						$encrypted_tab_id = $this->EncryptionFunctions->enCrypt(8);
						$this->redirect(array('controller'=>'manage_cases','action' => 'show_case',$encrypted_casemaster_id,$encrypted_acc_id,$encrypted_tab_id));
					}else if($preselected_case_master_id>0){
						$this->redirect(array('controller'=>'manage_cases','action' => 'find_cases','medico_legal'));
					}
					else{
						$this->redirect(array('action' => 'create_letter',0));
					}
				}
			}

		}




		$actionFlag = 'CanEdit';
		$actionMessage = '';

		$search_criterea = array();

		$preselected_case = 0;

		$preselected_case_master_id = 0;

		if(!empty($selected_case_master_id)){

			$preselected_case = 1;

			$preselected_case_master_id = $selected_case_master_id;

			$case_det = $this->CaseMaster->find('first', array('conditions' => array('CaseMaster.id' => $selected_case_master_id), 'recursive' => -1));

			$case_id = $case_det['CaseMaster']['case_id'];

			$search_criterea['CaseId'] = $case_id;

			//debug($find_case_search_criteria);
			//$_SESSION['search_criterea']['Page']='find_case';
			//$_SESSION['search_criterea']['AgentId']='find_case';

			$_SESSION['preselected_case_master_id'] = $preselected_case_master_id;
			//debug($case_det);
		}

		$this->set('preselected_case_master_id',$preselected_case_master_id);

		$this->set('preselected_case',$preselected_case);



		$this->set('search_criterea',$search_criterea);


		$searchResultCaseId = '';

		$InstructorId = '';

		$AgentId = '';

		$ExpertId = '';

		$to_address_content = '';

		$non_case_user_type = '';

		$letterDetails = $this->GeneralLetter->fetchLetterDetails($letterId);
		if(empty($this->data) )
		{
			if( isset($letterDetails[0]) )
			{

				//debug($letterDetails);
				$letterDetails[0]['GeneralLetter']['linkToCase'] = 0;
				if($letterDetails[0]['GeneralLetter']['case_id'] != 0){
					$letterDetails[0]['GeneralLetter']['linkToCase'] = 1;
				}

				$letterDetails[0]['GeneralLetter']['existingTemplate'] = 0;
				if($letterDetails[0]['GeneralLetter']['template_id'] != 0){
					$letterDetails[0]['GeneralLetter']['existingTemplate'] = 1;
				}

				$this->data = $letterDetails[0];

				$edited_time = date("Y-m-d-H-i-s", time());


				$file_name_value = $letterDetails[0]['GeneralLetter']['file_name'];
				$file_name_array = explode('_',$file_name_value);
				array_pop($file_name_array);

				$file_name_new_value = implode('_',$file_name_array);

				$this->data['GeneralLetter']['file_name'] = $file_name_new_value;
				/*if($letterDetails[0]['GeneralLetter']['print_count'] > 0 && $letterDetails[0]['GeneralLetter']['email_count'] > 0){
					$actionFlag = 'CanNotEdit';
					$actionMessage = 'This letter is being printed & emaild already, So you can just view but can not edit this letter.';
				}else if($letterDetails[0]['GeneralLetter']['print_count'] > 0){
					$actionFlag = 'CanNotEdit';
					$actionMessage = 'This letter is being printed already, So you can just view but can not edit this letter.';
				}else if($letterDetails[0]['GeneralLetter']['email_count'] > 0){
					$actionFlag = 'CanNotEdit';
					$actionMessage = 'This letter is being emailed already, So you can just view but can not edit this letter.';
				}*/

				$searchResultCaseId = $letterDetails[0]['GeneralLetter']['case_id'];

				if($letterDetails[0]['GeneralLetter']['instructor_id']!='NULL' && $letterDetails[0]['GeneralLetter']['instructor_id']!=""){
					$InstructorId = $letterDetails[0]['GeneralLetter']['instructor_id'];
					$non_case_user_type = 'instructor';
				}
				if($letterDetails[0]['GeneralLetter']['agency_id']!='NULL' && $letterDetails[0]['GeneralLetter']['agency_id']!=""){
					$AgentId = $letterDetails[0]['GeneralLetter']['agency_id'];
					$non_case_user_type = 'agency';
				}
				if($letterDetails[0]['GeneralLetter']['expert_id']!='NULL' && $letterDetails[0]['GeneralLetter']['expert_id']!=""){
					$ExpertId = $letterDetails[0]['GeneralLetter']['expert_id'];
					$non_case_user_type = 'expert';
				}
				if($letterDetails[0]['GeneralLetter']['addressee']!='NULL' && $letterDetails[0]['GeneralLetter']['addressee']!="")
					$to_address_content = $letterDetails[0]['GeneralLetter']['addressee'];

			}
		}

		$owner_id = $this->get_owner_id();
		$templates = $this->Template->fetchAllTemplatesOfOwner($owner_id);				

		$this->set('InstructorId',$InstructorId);

		$this->set('AgentId',$AgentId);

		$this->set('ExpertId',$ExpertId);

		$this->set('searchResultCaseId',$searchResultCaseId);

		$this->set('to_address_content',$to_address_content);

		$this->set('non_case_user_type',$non_case_user_type);

		//debug($this->agentsList);

		$this->set('agents',$this->agentsList);
		$this->set('instructors',$this->instructorsList);

		//debug($this->expert_array);

		$this->set('experts',$this->expert_array);


		//debug($templates);

		$this->set('templates', $templates);
		$this->set('letterId', $letterId);
		$this->set('actionFlag', $actionFlag);
		$this->set('actionMessage', $actionMessage);

		$type = 'medico_legal';

		$this->set('type', $type);

		$page = 'create_letter';



		//$this->find_case_new('create_letter', $type);

		$this->set('page', $page);


                $claimant_auto= array();

                $callingPage = 'create_letter';

                $type = 'medico_legal';
                if($type=='medico_legal') {
			$case_subtype_id=1;
		}elseif($type=='private') {
			$case_subtype_id=3;
		}elseif($type=='cosmetic') {
			$case_subtype_id=4;
		}else{
			$case_subtype_id='';
		}

                if($callingPage == 'create_letter') {

			if($case_subtype_id!=''){
				$sub_con=" and case_masters.case_subtype_id=$case_subtype_id ";
			}else{
				$sub_con=" ";
			}

                        //$sub_con.=" and case_users.status_id=1 ";

			//debug($_SESSION);
			$admin_name=$this->Session->read('Auth.User.admin_name');
			if(@$admin_name=='CaseHandlerUser' || @$admin_name=='FeeEarnerUser'){
				$logged_in_case_handler=$this->Session->read('Auth.User.id');
				$sub_con.=" and case_users.case_handler_id=$logged_in_case_handler ";
			}

			if($callingPage =='reports' ){
				$grpBY='GROUP BY case_masters.id';
			}else{
				$grpBY='GROUP BY case_id';
			}
			$sqlVal = "SELECT max(case_masters.id) AS id, max(case_masters.case_seq_no) AS sq_no FROM case_masters, case_users WHERE case_users.case_master_id = case_masters.id AND (`case_users`.`additional_info` IS NULL OR `case_users`.`additional_info`='') AND case_users.user_id = $logged_in_user_id  $sub_con $grpBY ORDER BY id";

			$sqlCMres = $this->CaseMaster->query($sqlVal);
		}

                $caseMasterIds = $this->getCaseMasters($sqlCMres, $logged_in_user_id, $callingPage);


                if( !empty($caseMasterIds) ){
			$caseMasterIdsStr = implode(',', $caseMasterIds);

                // to get the claimant name and postcode
                $claimant_auto = array();
		/*$claimant_query = "SELECT case_claimant_details.title, case_claimant_details.forename, case_claimant_details.middlename, case_claimant_details.surname,addresses.postcode FROM case_masters LEFT JOIN case_claimant_details ON (case_claimant_details.case_master_id=case_masters.id) LEFT JOIN addresses ON (addresses.case_claimant_detail_id=case_claimant_details.id) WHERE case_masters.id IN($caseMasterIdsStr)";
		$claimant_arr = $this->CaseMaster->query($claimant_query);

		foreach ($claimant_arr AS $c_key => $c_value) {
				$e_c_forename = '';
				$e_c_middlename = '';
				$e_c_surname = '';
				$e_c_postcode = '';
				$e_c_name = '';
				$e_c_name_key = '';

				$e_c_forename = $this->EncryptionFunctions->aes_decrypt($c_value['case_claimant_details']['forename']);
				$e_c_middlename = $this->EncryptionFunctions->aes_decrypt($c_value['case_claimant_details']['middlename']);
				$e_c_surname = $this->EncryptionFunctions->aes_decrypt($c_value['case_claimant_details']['surname']);
				$e_c_postcode = $this->EncryptionFunctions->aes_decrypt($c_value['addresses']['postcode']);
				//$c_name = $e_c_forename." ".$e_c_middlename." ".$e_c_surname;
				$e_c_name = $e_c_forename." ".$e_c_surname;
				$e_c_name_key = $c_value['case_claimant_details']['forename']."__".$c_value['case_claimant_details']['surname'];

				$claimant_auto['name'][$c_key]['label'] = $e_c_name;
				$claimant_auto['name'][$c_key]['key'] = $e_c_name_key;
				$claimant_auto['forename'][$c_key] = $e_c_forename;
				$claimant_auto['middlename'][$c_key] = $e_c_middlename;
				$claimant_auto['surname'][$c_key] = $e_c_surname;
				$claimant_auto['postcodename'][$c_key] = $e_c_postcode;
                    }*/
                }

                //debug($claimant_auto);
                $this->set('claimant_auto', $claimant_auto);


	}

        function getCaseMasters($sqlCMres=array(), $userId=0, $flag=null)
	{

		$ids = array();
                //debug($sqlCMres);
		foreach($sqlCMres as $res)
		{
			//debug( $res);
			$cmid = 0;
			if($flag == 'RequestAmendmentsAddendums' || $flag == 'ViewRequestedAmendmentsAddendums' || $flag == 'RequestAddendumLetters' || $flag == 'RequestPart35s'  || $flag == 'ViewRequestedAddendumLetters' || $flag == 'FindCaseInCreateEnquiry' || $flag == 'FindCaseInNomination' || $flag == 'ViewGeneratedReports' || $flag == 'GenerateReports' || $flag=='FindCaseInCreateLetter'  || $flag == 'RequestThirdrdPartyPart35s'  ){
				$cmid = $res[0]['id'];
			}
			else if($flag == 'search_case' || $flag == 'unfinished_case'  || $flag == 'unappointed_case' || $flag == 'todays_list' ||  $flag == 'future_list' || $flag == 'incompleted_cases'  || $flag == 'unfinished_reports' ||  $flag == 'awaiting_list' ||  $flag == 'reports_to_mail' ||  $flag == 'dna'  || $flag =='manage_medical_record' || $flag =='reports' || $flag =='GenerateInvoice' || $flag =='ManualInvoice' || $flag =='CancelInvoice' || $flag =='unpaid_invoice' || $flag =='credit_memo' || $flag == 'past_list' || $flag =='overdue'|| $flag=='find_cases'|| $flag=='add_case' || $flag=='create_letter' || $flag=='hold_release' || $flag=='canceled_cases' || $flag=='completed_cases' || $flag=='app_overdue' ){
				$cmid = $res[0]['id'];
                                //debug($cmid);
			}
			else{
				$cmid = $res['case_masters']['id'];
			}

			$uids = array();
			$sqlCUres = $this->CaseUser->query("SELECT user_id FROM case_users WHERE case_master_id=".$cmid." AND (`case_users`.`additional_info` IS NULL OR `case_users`.`additional_info`='')");
			if( !empty($sqlCUres) ) {
				foreach($sqlCUres as $cuRes) {
					array_push($uids, $cuRes['case_users']['user_id']);
				}
			}


		    if( !empty($uids) ) {
				if( in_array($userId, $uids ) ){
					array_push($ids, $cmid);
				}
			}
		}

		return $ids;
	}

	function make_case_log_entry($case_master_id, $action_id=null, $reason=null,$fees_master_id=null,$module=null,$case_usr_type=null)
	{

		$logged_in_user_id = $this->logged_in_user_id;

		$user_details = $this->User->find('first', array('conditions' => array('User.id' => $this->Session->read('Auth.User.id')),'recursive' => -1));
		$logged_user_group_id=$user_details['User']['group_id'];
		$arrayItems['case_master_id'] = $case_master_id;
		$arrayItems['action'] = $action_id;
		$arrayItems['done_by'] = $this->Session->read('Auth.User.id');
		$arrayItems['comments'] = $reason;
		$arrayItems['fees_master_id'] = $fees_master_id;
		$arrayItems['module'] = $module;
		$arrayItems['case_usr_type'] = $case_usr_type;

		$this->CommonFunctions->updateCaseHistory($arrayItems);
	}

	function download_pdf_view($file_name = null, $logged_in_user_id = null, $type = 1,$caseMasterId=null,$filepath_arr=null) {


		if ($type == 1) {
			$expert_uploads=Configure::read('expert_uploads');
			$expert_appointment_folder=$expert_uploads.$logged_in_user_id.'/GenericLetters/';
			$file_path=$expert_appointment_folder.$file_name.".html";
		}elseif($type == 2) {

                        $case_folder_array = $this->CommonFunctions->make_case_folder($caseMasterId);
                        $case_directory = $case_folder_array['case_directory'];

			$case_letter_folder = $case_directory.'GenericLetters/';

			$file_path=$case_letter_folder.$file_name.".html";
		}

		//$file_op = fopen($file_path, 'r');
		$content = file_get_contents ($file_path);
		//fclose($file_op);
		$this->set('content',$content);
		//$rootpath=Configure::read('coral_root_path');
		// $pdfFilePath=$rootpath."uploads/expert/".$logged_in_user_id."/appointment_lists/appointmentlist_".$app_date.".pdf";
		//$this->set('pdfFilePath',$pdfFilePath);
		$this->layout = "ajax";
		//echo 'Click <a href="'.$pdfFilePath.'" target="_blank">Here</a> To Downlad And Print your Schedule.';

		//	return $file_path;
		//die;
	}

	function preview_list_letters(){

		$this->layout = 'shadow_upload';

		$shadow_close='false';

		$preview_content = '';

		$letterId =0;
		if(!empty($_REQUEST['jString']) && !empty($_REQUEST['jString'])){
			$jString = stripslashes($_REQUEST['jString']);
			$filter = json_decode($jString);

			$letterId = $filter->letterId;

		}

		if($letterId>0){

			$letterDetails = $this->GeneralLetter->fetchLetterDetails($letterId);

			$file_name = $letterDetails[0]['GeneralLetter']['file_name'];


			$expert_uploads=Configure::read('expert_uploads');
			$expert_appointment_folder=$expert_uploads.$this->logged_in_user_id.'/GenericLetters/';
			$file_path=$expert_appointment_folder.$file_name.".html";

			$preview_content = file_get_contents ($file_path);

			$this->set('preview_content',$preview_content);

		}



	}

	function update_letter_content(){

                $letter_file_name = '';

		$content = $_POST['description'];

                if(isset($_POST['file_name'])){
                    $letter_file_name = $_POST['file_name'];
                }

		$content = urldecode($content);

		$_SESSION['letter_content'] = $content;

                $_SESSION['letter_file_name'] = $letter_file_name;

		$result = array('response'=>'success');

		$result = json_encode($result);

		echo $result;

		exit;

	}


        function update_letter_content_popup(){

                $letter_file_name = '';

                $case_handler_subusers_id = '';

                $case_handler_id = '';

                $case_master_id = '';

                if(isset($_POST['case_master_id'])){
                    $case_master_id = $_POST['case_master_id'];
                }

                if(isset($_POST['case_handler_id'])){
                    $case_handler_id = $_POST['case_handler_id'];
                }

                if(isset($_POST['case_handler_subusers_id'])){
                    $case_handler_subusers_id = $_POST['case_handler_subusers_id'];
                }

                if(isset($_POST['file_name'])){
                    $letter_file_name = $_POST['file_name'];
                }

                if(isset($_POST['title'])){
                    $title= $_POST['title'];
                }

                if(isset($_POST['template_id'])){
                    $template_id= $_POST['template_id'];
                }

                $content = $_POST['description'];

		$content = urldecode($content);

                $_SESSION['letter_case_master_id'] = $case_master_id;

		$_SESSION['letter_content'] = $content;

                $_SESSION['letter_file_name'] = $letter_file_name;

                $_SESSION['letter_file_subject'] = $title;

                $_SESSION['letter_template_id'] = $template_id;

                $_SESSION['letter_case_handler_user_id'] = $case_handler_id;

                $_SESSION['letter_case_handler_subusers_id'] = $case_handler_subusers_id;

		$result = array('response'=>'success');

		$result = json_encode($result);

		echo $result;

		exit;

	}


	function show_preview_letter($data=null){



		$this->layout = 'shadow_upload';

		$shadow_close='false';

		$preview_content ='';



		if(isset($_SESSION['letter_content'])&&!empty($_SESSION['letter_content'])){

			$preview_content = $_SESSION['letter_content'];
		}

		$this->set('preview_content',$preview_content);



	}

        function show_preview_letter_popup($data=null){



		$this->layout = 'shadow_upload';

		$shadow_close='false';

		$preview_content ='';

                $letter_file_name = '';

		if(isset($_SESSION['letter_content'])&&!empty($_SESSION['letter_content'])){

			$preview_content = $_SESSION['letter_content'];
		}

                if(isset($_SESSION['letter_file_name'])&&!empty($_SESSION['letter_file_name'])){

			$letter_file_name = $_SESSION['letter_file_name'];
		}

                if(isset($_SESSION['letter_case_master_id'])&&!empty($_SESSION['letter_case_master_id'])){

			$case_master_id = $_SESSION['letter_case_master_id'];
		}

		$this->set('preview_content',$preview_content);
                $this->set('letter_file_name',$letter_file_name);
                $this->set('case_master_id',$case_master_id);



	}

	function get_touser_name($letter_id){

		$letterDetails = $this->GeneralLetter->fetchLetterDetails($letter_id);

		$user_id = $letterDetails[0]['GeneralLetter']['to_user_id'];
		$user_type = $letterDetails[0]['GeneralLetter']['to_user_type'];
		$case_master_id = $letterDetails[0]['GeneralLetter']['case_id'];

		$sub_user_id = $letterDetails[0]['GeneralLetter']['to_subuser_id'];
		$sub_user_type = $letterDetails[0]['GeneralLetter']['to_subuser_type'];


		$to_email_name = '';
		if($user_type=="claimant"){
			$case_claiment_dump = $this->CaseMaster->CaseClaimantDetail->find('first', array('conditions' => array('CaseClaimantDetail.case_master_id' => $case_master_id)));

                        if($case_claiment_dump['CaseClaimantDetail']['title']!='' || $case_claiment_dump['CaseClaimantDetail']['title']!='NULL'){
                            $case_claiment_dump['CaseClaimantDetail']['title'] = $this->EncryptionFunctions->aes_decrypt($case_claiment_dump['CaseClaimantDetail']['title']);
                        }
                        if($case_claiment_dump['CaseClaimantDetail']['forename']!='' || $case_claiment_dump['CaseClaimantDetail']['forename']!='NULL'){
                            $case_claiment_dump['CaseClaimantDetail']['forename'] = $this->EncryptionFunctions->aes_decrypt($case_claiment_dump['CaseClaimantDetail']['forename']);
                        }
                        if($case_claiment_dump['CaseClaimantDetail']['surname']!='' || $case_claiment_dump['CaseClaimantDetail']['surname']!='NULL'){
                            $case_claiment_dump['CaseClaimantDetail']['surname'] = $this->EncryptionFunctions->aes_decrypt($case_claiment_dump['CaseClaimantDetail']['surname']);
                        }

                        $claiment_name = ucfirst(trim($case_claiment_dump['CaseClaimantDetail']['title']." ".$case_claiment_dump['CaseClaimantDetail']['forename']." ".$case_claiment_dump['CaseClaimantDetail']['surname']));
			$to_email_name = $claiment_name;

		}elseif($user_type=="expert"){

			if(!empty($sub_user_id))
				$user_id = $sub_user_id;

			$toUserDet = $this->User->find('first', array('conditions' => array('User.id' => $user_id), 'recursive' => 2));

			$user_name = ucfirst(trim($toUserDet['User']['title']." ". $toUserDet['User']['forename']." ".$toUserDet['User']['middlename']." ".$toUserDet['User']['surname']));

			$to_email_name = $user_name;

		}elseif($user_type=="agency"){

			if(!empty($sub_user_id))
				$user_id = $sub_user_id;

			$toUserDet = $this->User->find('first', array('conditions' => array('User.id' => $user_id), 'recursive' => 2));

			if($toUserDet['User']['parent_id']==0){
				$user_name = $toUserDet['Company']['name'];
			}else{
				$user_name = ucfirst(trim($toUserDet['User']['title']." ". $toUserDet['User']['forename']." ".$toUserDet['User']['middlename']." ".$toUserDet['User']['surname']));

			}
			$to_email_name = $user_name;

		}

		//debug($to_email_name);
		//exit;
		return $to_email_name;
	}

	//Argument Added By mskt
	//function emailer(){
	function emailer($gletter_id = null){

		$this->layout = 'shadow_upload';
		$shadow_close='false';
		$value='';
		$caseIdString='';
		$caseArray=array();

		if($this->Session->read('Auth.User.group_id')==Configure::read('AdminUser')){
			$LinUid = $this->Session->read('Auth.User.parent_id');
		}else{
			$LinUid = $this->Session->read('Auth.User.id');
		}

		$logged_user_group_id = $this->logged_user_group_id;

		$user_arr = $this->user_details;

		if(empty($this->data)){
		$general_letter_id =0;
		
		//Added By mskt
		/*if($_SESSION['general_letter_id']!=0){
			$general_letter_id = $_SESSION['general_letter_id'];
		}*/
		if($_SESSION['general_letter_id']!=0){
			$general_letter_id = $_SESSION['general_letter_id'];
		}else{
			$general_letter_id = $gletter_id;
		}

		$_SESSION['show_email_popup'] = 'false';
		$_SESSION['general_letter_id'] = 0;

		//debug($general_letter_id);


		if($general_letter_id!=0){

			$letter_content = '';

			$letter_file_item ='';

			$letterDetails = $this->GeneralLetter->fetchLetterDetails($general_letter_id);

			//debug($letterDetails);

			$email_subject = '';



			if($letterDetails[0]['GeneralLetter']['case_id'] != 0)
			{
				$caseMasterId = 0;
				$caseMasterId = $letterDetails[0]['GeneralLetter']['case_id'];
                                $case_folder_array = $this->CommonFunctions->make_case_folder($caseMasterId);
                                $case_directory = $case_folder_array['case_directory'];

                                $case_directory_value = $case_folder_array['case_directory_value'];

				$letter_file_path = $case_directory_value."/GenericLetters/";
				$letter_file = $letterDetails[0]['GeneralLetter']['file_name'].'.pdf';

				$to_user_type = $letterDetails[0]['GeneralLetter']['to_user_type'];

				$case_dump = $this->CaseMaster->find('first', array('conditions' => array('CaseMaster.id' => $caseMasterId), 'recursive' => 2));


				$case_user_dump = $case_dump['CaseUser'];
				$case_user_dump = array_reverse($case_user_dump, true);

				$case_master_id = $caseMasterId;




				$CaseUsers = $this->CaseUser->find('all', array('conditions' => array('CaseUser.case_master_id' => $case_master_id,'(CaseUser.additional_info IS NULL OR CaseUser.additional_info="")'), 'recursive' =>-1,'order' => array('CaseUser.id ASC')));

				foreach($CaseUsers as $key=>$usrDetail ){
					$user_id=$usrDetail['CaseUser']['user_id'];
					if (($logged_user_group_id == Configure::read('ExpertSuperUser')) && ($user_id==$this->logged_in_user_id)) {
						$last_guy_details=$usrDetail['CaseUser'];
						$secondlast_guy_details=$CaseUsers[$key-1]['CaseUser'];

						$your_reference=$secondlast_guy_details['user_reference'];
						$report_date=$last_guy_details['report_date'];
						$our_reference=$case_dump['CaseMaster']['case_id'];;
					}
					if (($logged_user_group_id == Configure::read('TherapistSuperUser')) && ($user_id==$this->logged_in_user_id)) {
						$last_guy_details=$usrDetail['CaseUser'];
						$secondlast_guy_details=$CaseUsers[$key-1]['CaseUser'];

						$your_reference=$secondlast_guy_details['user_reference'];
						$report_date=$last_guy_details['report_date'];
						$our_reference=$case_dump['CaseMaster']['case_id'];;

					}
					if (($logged_user_group_id == Configure::read('AgentSuperUser')) && ($user_id==$this->logged_in_user_id)) {
						$last_guy_details=$usrDetail['CaseUser'];
						$secondlast_guy_details=$CaseUsers[$key-1]['CaseUser'];

						if($to_user_type=="agency")
							$your_reference=$secondlast_guy_details['user_reference'];
						else if($to_user_type=="expert")
							$your_reference=$case_dump['CaseMaster']['case_id'];
						else
							$your_reference= '';

						$report_date=$secondlast_guy_details['report_date'];
						$our_reference=$last_guy_details['user_reference'];
					}
				}

				$case_master_id = $caseMasterId;
				$case_claiment_dump = $this->CaseMaster->CaseClaimantDetail->find('first', array('conditions' => array('CaseClaimantDetail.case_master_id' => $case_master_id)));

                                if($case_claiment_dump['CaseClaimantDetail']['title']!='' || $case_claiment_dump['CaseClaimantDetail']['title']!='NULL'){
                                    $case_claiment_dump['CaseClaimantDetail']['title'] = $this->EncryptionFunctions->aes_decrypt($case_claiment_dump['CaseClaimantDetail']['title']);
                                }
                                if($case_claiment_dump['CaseClaimantDetail']['forename']!='' || $case_claiment_dump['CaseClaimantDetail']['forename']!='NULL'){
                                    $case_claiment_dump['CaseClaimantDetail']['forename'] = $this->EncryptionFunctions->aes_decrypt($case_claiment_dump['CaseClaimantDetail']['forename']);
                                }
                                if($case_claiment_dump['CaseClaimantDetail']['surname']!='' || $case_claiment_dump['CaseClaimantDetail']['surname']!='NULL'){
                                    $case_claiment_dump['CaseClaimantDetail']['surname'] = $this->EncryptionFunctions->aes_decrypt($case_claiment_dump['CaseClaimantDetail']['surname']);
                                }
                                if($case_claiment_dump['CaseClaimantDetail']['gender']!='' || $case_claiment_dump['CaseClaimantDetail']['gender']!='NULL'){
                                    $case_claiment_dump['CaseClaimantDetail']['gender'] = $this->EncryptionFunctions->aes_decrypt($case_claiment_dump['CaseClaimantDetail']['gender']);
                                }

				$claiment_name = ucfirst(trim($case_claiment_dump['CaseClaimantDetail']['title']." ".$case_claiment_dump['CaseClaimantDetail']['forename']." ".$case_claiment_dump['CaseClaimantDetail']['surname']));
				$date_of_birth = $this->Date->format($case_claiment_dump['CaseClaimantDetail']['dateofbirth']);


                                $gender = $case_claiment_dump['CaseClaimantDetail']['gender'];

                                if($case_claiment_dump['Address']['address1']!='' || $case_claiment_dump['Address']['address1']!='NULL'){
                                    $case_claiment_dump['Address']['address1'] = $this->EncryptionFunctions->aes_decrypt($case_claiment_dump['Address']['address1']);
                                }
                                if($case_claiment_dump['Address']['address2']!='' || $case_claiment_dump['Address']['address2']!='NULL'){
                                    $case_claiment_dump['Address']['address2'] = $this->EncryptionFunctions->aes_decrypt($case_claiment_dump['Address']['address2']);
                                }
                                if($case_claiment_dump['Address']['address3']!='' || $case_claiment_dump['Address']['address3']!='NULL'){
                                    $case_claiment_dump['Address']['address3'] = $this->EncryptionFunctions->aes_decrypt($case_claiment_dump['Address']['address3']);
                                }
                                if($case_claiment_dump['Address']['town']!='' || $case_claiment_dump['Address']['town']!='NULL'){
                                    $case_claiment_dump['Address']['town'] = $this->EncryptionFunctions->aes_decrypt($case_claiment_dump['Address']['town']);
                                }
                                if($case_claiment_dump['Address']['postcode']!='' || $case_claiment_dump['Address']['postcode']!='NULL'){
                                    $case_claiment_dump['Address']['postcode'] = $this->EncryptionFunctions->aes_decrypt($case_claiment_dump['Address']['postcode']);
                                }


				$claiment_address = $case_claiment_dump['Address']['address1'].$case_claiment_dump['Address']['address2'].$case_claiment_dump['Address']['address3']."<br />".$case_claiment_dump['Address']['town']."<br />".$case_claiment_dump['Address']['postcode'];

				$client_details = '<p style="font:15px Cambria, Arial, Helvetica, sans-serif; color:#000; margin-bottom:5px" align="left"><strong>Claimant Details :</strong> </p>
				<br />
				<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #6d5049;">
				<tr>
				<td>

				<table width="100%" border="0" cellspacing="1" cellpadding="4">
				<tr>
				<td width="50%" align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;"><strong>Name</strong>  </td>
				<td width="50%" align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;">'.$claiment_name.'</td>
				</tr>
				<tr>
				<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;"><strong>Date of birth</strong></td>
				<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;"><strong>'.$date_of_birth.'</strong></td>
				</tr>
				<tr>
				<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;"><strong>Gender</strong></td>
				<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;"><strong>'.$gender.'</strong></td>
				</tr>
				<tr>
				<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; "><strong>Address </strong></td>
				<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; ">'.$claiment_address.'</td>
				</tr>
				</table>
				</td>
				</tr>
				</table> ';


				$file_name = $letterDetails[0]['GeneralLetter']['file_name'];

				$subject = $letterDetails[0]['GeneralLetter']['title'];

				$to_email = $letterDetails[0]['GeneralLetter']['to_user_email_id'];

                                if(empty($subject)){
                                    $email_subject = $claiment_name.', Your Ref : '.$your_reference.','.$subject;
                                }else{
                                    $email_subject = $subject;
                                }

				if($to_user_type=="claimant" && empty($subject)){
					$email_subject = $claiment_name.', Our Ref : '.$our_reference.','.$subject;
				}else{
                                        $email_subject = $subject;
                                }

                                //echo 'one-->subject--->'.$email_subject;

				$contact_email ='';
				if(!empty($user_arr['User']['email'])){
					$contact_email =$user_arr['User']['email'];
				}

				if (!empty($user_arr['User']['work_telephone'])) {
					$contact_details = $user_arr['User']['work_telephone']." / ".$contact_email;
				} else if (!empty($user_arr['User']['home_telephone'])) {
					$contact_details = $user_arr['User']['home_telephone']." / ".$contact_email;
				} else if (!empty($rec_user['User']['mobile'])) {
					$contact_details = $user_arr['User']['mobile']." / ".$contact_email;
				} else {
					$contact_details = $contact_email;
				}

				if(!empty($user_arr['Company']['name'])){
					$send_user_comp_name = $user_arr['Company']['name'];
				}

				$send_user_name = ucfirst($user_arr['User']['title'])." " .$user_arr['User']['forename']." " .$user_arr['User']['middlename']." " .$user_arr['User']['surname'];

				//Added By mskt
				$template_name_data = '';
				if($letterDetails[0]['GeneralLetter']['template_id']){
					$templateDetails = $this->Template->fetchTemplateDetails($letterDetails[0]['GeneralLetter']['template_id']);		
					if( isset($templateDetails[0]) ) {
						$template_content 	= $templateDetails[0]['Template']['description'];
						$template_name 		= $templateDetails[0]['Template']['name'];
						if($template_name){
							$template_name_data = '<p style="font:15px Cambria, Arial, Helvetica, sans-serif; color:#000;" align="left"><strong>'.$template_name.'</strong></p>';
						}
					}		
				}
				
				$your_reference_text ='';
				//Added By mskt
				if($to_user_type != 'expert'){
					if(!empty($your_reference)){
						$your_reference_text = $template_name_data.'<p style="font:15px Cambria, Arial, Helvetica, sans-serif; color:#000;" align="left"><strong>Your Reference :</strong>'.$your_reference.'</p>';
					}
				}else{
					$your_reference_text = $template_name_data;
				}

				$our_reference_text = '';
				if(!empty($our_reference))
					$our_reference_text = '<p style="font:15px Cambria, Arial, Helvetica, sans-serif; color:#000;" align="left"><strong>Our Reference :</strong>'.$our_reference.'</p>';

				$tmp_letter_file = Configure::read('coral_root_path')."/app/webroot/templates/email_general_letter_case.html";
				$tmp_file_funs = file($tmp_letter_file);
				$email_content = '';

				foreach ($tmp_file_funs as $file_num => $file_fun) {
					$file_fun = str_replace('$your_reference_text$', $your_reference_text, $file_fun);
					$file_fun = str_replace('$our_reference_text$', $our_reference_text, $file_fun);

					$file_fun = str_replace('$client_details$', $client_details, $file_fun);
					$file_fun = str_replace('$contact_details$', $contact_details, $file_fun);
					$file_fun = str_replace('$case_handler_name$', $send_user_name, $file_fun);
					$file_fun = str_replace('$ins_comp_name$', $send_user_comp_name, $file_fun);

					$email_content.= $file_fun;
				}

				$myFile = Configure::read('coral_root_path')."/app/webroot/templates/email_template_pop_up.html";
				$file_funs = file($myFile);

				$emailDataStr['content'] = '';
				$mail_content = '';

				foreach ($file_funs as $file_num => $file_fun) {
					$file_fun = str_replace('$img_logo$', '', $file_fun);
					$file_fun = str_replace('$img_shadow$', '', $file_fun);
					$file_fun = str_replace('$img_shadow_bottom$', '', $file_fun);
					$file_fun = str_replace('$email_header$', $email_subject, $file_fun);
					$file_fun = str_replace('$email_content$', $email_content, $file_fun);
					$file_fun = str_replace('$disclaimer_content$', $_SESSION['Auth']['User']['disclaimer_content'], $file_fun);

					$mail_content.= $file_fun;
				}

				$letter_content = $mail_content;


			}
			else
			{
				$to_email = $letterDetails[0]['GeneralLetter']['to_user_email_id'];

				$letter_file_path = WWW_ROOT."uploads/expert/".$this->LinUid."/GenericLetters/";
				$letter_file = $letterDetails[0]['GeneralLetter']['file_name'].'.pdf';

				$email_subject = $letterDetails[0]['GeneralLetter']['title'];

				$our_reference = $letterDetails[0]['GeneralLetter']['our_reference'];

				$your_reference = $letterDetails[0]['GeneralLetter']['your_reference'];


				if(!empty($your_reference)){
					$email_subject = 'Your Ref : '.$your_reference.' , '.$email_subject;
				}

				//echo 'two-->subject--->'.$email_subject;



				$your_reference_text ='';
				if(!empty($your_reference))
					$your_reference_text = '<strong>Your Reference :</strong> '.$your_reference.'</p>';
				$our_reference_text ='';
				if(!empty($our_reference))
					$our_reference_text = '<strong>Our Reference :</strong> '.$our_reference.'</p>';

				$contact_email ='';
				if(!empty($user_arr['User']['email'])){
					$contact_email =$user_arr['User']['email'];
				}

				if (!empty($user_arr['User']['work_telephone'])) {
					$contact_details = $user_arr['User']['work_telephone']." / ".$contact_email;
				} else if (!empty($user_arr['User']['home_telephone'])) {
					$contact_details = $user_arr['User']['home_telephone']." / ".$contact_email;
				} else if (!empty($rec_user['User']['mobile'])) {
					$contact_details = $user_arr['User']['mobile']." / ".$contact_email;
				} else {
					$contact_details = $contact_email;
				}

				if(!empty($user_arr['Company']['name'])){
					$send_user_comp_name = $user_arr['Company']['name'];
				}

				$send_user_name = ucfirst($user_arr['User']['title'])." " .$user_arr['User']['forename']." " .$user_arr['User']['middlename']." " .$user_arr['User']['surname'];

				$tmp_letter_file = Configure::read('coral_root_path')."/app/webroot/templates/email_general_letter.html";
				$tmp_file_funs = file($tmp_letter_file);
				$email_content = '';

				foreach ($tmp_file_funs as $file_num => $file_fun) {
					$file_fun = str_replace('$our_reference_text$', $our_reference_text, $file_fun);
					$file_fun = str_replace('$your_reference_text$', $your_reference_text, $file_fun);


					$file_fun = str_replace('$contact_details$', $contact_details, $file_fun);
					$file_fun = str_replace('$case_handler_name$', $send_user_name, $file_fun);
					$file_fun = str_replace('$ins_comp_name$', $send_user_comp_name, $file_fun);

					$email_content.= $file_fun;
				}

				$myFile = Configure::read('coral_root_path')."/app/webroot/templates/email_template_pop_up.html";
				$file_funs = file($myFile);

				$emailDataStr['content'] = '';
				$mail_content = '';

				foreach ($file_funs as $file_num => $file_fun) {
					$file_fun = str_replace('$img_logo$', '', $file_fun);
					$file_fun = str_replace('$img_shadow$', '', $file_fun);
					$file_fun = str_replace('$img_shadow_bottom$', '', $file_fun);
					$file_fun = str_replace('$email_header$', $email_subject, $file_fun);
					$file_fun = str_replace('$email_content$', $email_content, $file_fun);
					$file_fun = str_replace('$disclaimer_content$', $_SESSION['Auth']['User']['disclaimer_content'], $file_fun);

					$mail_content.= $file_fun;
				}

				$letter_content = $mail_content;


			}

			//$letter_content =$letterDetails[0]['GeneralLetter']['description'];

			$letter_file_item = $letter_file_path.$letter_file;

			$this->set('letter_content',$letter_content);

			$this->set('general_letter_id',$general_letter_id);

			$this->set('letter_file_path',$letter_file_path);
			$this->set('letter_file',$letter_file);

			$this->set('letter_file_item',$letter_file_item);

			$this->set('email_subject',$email_subject);

			$this->set('to_email',$to_email);




		}

	 }

	 $redirect_url = '';

		if(!empty($this->data)){

			$attachment=array();


			$general_letter_id=$this->data['Emailer']['general_letter_id'];



			if($general_letter_id!=0){
				$letterDetails = $this->GeneralLetter->fetchLetterDetails($general_letter_id);



				$caseMasterId = 0;

				if($letterDetails[0]['GeneralLetter']['case_id'] != 0)
				{

					$caseMasterId = $letterDetails[0]['GeneralLetter']['case_id'];

					$case_master_id = $caseMasterId;

					$caseMasterId = $letterDetails[0]['GeneralLetter']['case_id'];
					$otherDocs_folder = WWW_ROOT."uploads/cases/".$caseMasterId."/otherDocs/";

					$fileName = $letterDetails[0]['GeneralLetter']['file_name'];

					$file_name_value = $letterDetails[0]['GeneralLetter']['file_name'];
					$file_name_array = explode('_',$file_name_value);
					array_pop($file_name_array);
					$file_name_new_value = implode('_',$file_name_array);

					$to_user_name = $this->get_touser_name($general_letter_id);

					if(!empty($to_user_name)){
						//Added By mskt
						//$comment=$file_name_new_value.'('.$to_user_name.')';
						$comment=$file_name_new_value.'('.$to_user_name.') : ('.$this->data["Emailer"]["To"].')';
					}else{
						$comment=$fileName;
					}


					$this->make_case_log_entry($case_master_id, 75,$comment);

				}
				else
				{
					$otherDocs_folder = WWW_ROOT."uploads/expert/".$this->LinUid."/otherDocs/";

				}

			}

			$no_of_files= count($_FILES['file_1_']['name']);

			if (!file_exists($otherDocs_folder)) {
				@mkdir($otherDocs_folder, 0777);
			}
			foreach ($_FILES["file_1_"]["error"]as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["file_1_"]["tmp_name"][$key];
					$name = $_FILES["file_1_"]["name"][$key];
					move_uploaded_file($tmp_name, "$otherDocs_folder/$name");
					$attachment[$key]= $otherDocs_folder.$name;
				}
			}



			$no_of_files= count($_FILES['file_1_']['name']);

			$to=explode(',',$this->data['Emailer']['To']);
			$Cc=explode(',',$this->data['Emailer']['Cc']);
			$Bcc=explode(',',$this->data['Emailer']['Bcc']);
			$subject=$this->data['Emailer']['Subject'];
			$content=$this->data['Emailer']['Content'];


			//if($letterDetails[0]['GeneralLetter']['case_id'] == 0)
			//{
				$to_email = $this->data['Emailer']['To'];
				$to_content = $this->data['Emailer']['Content'];
				$to_subject = $this->data['Emailer']['Subject'];
				$email_cc = $this->data['Emailer']['Cc'];
				$email_bcc = $this->data['Emailer']['Bcc'];
				$now = date("Y-m-d H:i:s");


				$update_array = array('GeneralLetter.to_user_email_id'=>"'$to_email'",
										'GeneralLetter.email_subject'=>"'$to_subject'",
										'GeneralLetter.email_content'=>"'$to_content'",
										'GeneralLetter.email_cc'=>"'$email_cc'",
										'GeneralLetter.email_bcc'=>"'$email_bcc'",
										'GeneralLetter.email_count'=>1,
										'GeneralLetter.email_date'=>"'$now'",
						);

				$update_condition = array('GeneralLetter.id'=>$general_letter_id);

				$this->GeneralLetter->updateAll($update_array,$update_condition);
			//}



			/*$case_type_id=$this->data['Emailer']['case_type_id'];
			$report_id=explode(',',$this->data['Emailer']['report_id']);
			$scndElementUsrID=$this->data['Emailer']['scndElementUsrID'];
			$lastElementUsrID=$this->data['Emailer']['lastElementUsrID'];
			$case_master_id=$this->data['Emailer']['case_master_id'];*/

			$letter_file=$this->data['Emailer']['letter_file'];


			$cntAtt=count($attachment);
			$attachment[$cntAtt+1] = $letter_file;

			if (!empty($this->data['Emailer']['embedded'])) {
				$embedded = json_decode($this->data['Emailer']['embedded']);
			} else {
				$embedded = array();
			}

			// as per Thiru request
			$embedded = array();
			$this->send_email($to,'',$subject,$content,$attachment,$Cc,$Bcc,$embedded);
			$shadow_close=true;

			$this->set('shadow_close',$shadow_close);
			$this->Session->setFlash("Letter has generated and send successfully",'default', array('class' => 'message success'));

			$redirect_url = $_SESSION['email_success_redirect'];

			unset($_SESSION['email_success_redirect']);
			
			$redirect_url = array('controller' => 'manage_cases', 'action' => 'show_case/'.$this->EncryptionFunctions->enCrypt($caseMasterId));
		}



		//Added By mskt
		//$this->set('redirect_url',$redirect_url);
		$this->set('redirect_url',Router::url( $redirect_url, true ));

		$this->set('shadow_close',$shadow_close);
	}


function send_email($to,$to_name=null,$subject,$content,$attachment=null,$cc=null,$bcc=null, $embedded=array()) {
		$this->Email->IsHTML(true);
		// the email content is just a (html) view in app/views/{controller}/emails/testmail.ctp
		//$this->Email->renderBody('test');
		$this->Email->Body = $content;
		// subject
		$this->Email->Subject = $subject;

		// sender
		$getFromEmailDetails = $this->User->find('first', array('conditions' => array('User.id' =>$this->logged_in_user_id), 'recursive'=>2 ));
		$log_user_id = $this->Session->read('Auth.User.id');
		$communicatio_arr = $this->Communication->find('first', array('recursive' => -1, 'conditions' => array('Communication.user_id' => $log_user_id)));

		if (!empty($_SESSION['Auth.User.Dna'])) {
			// for dna
			if (!empty($communicatio_arr['Communication']['dna_email'])) {
				$from_email = $communicatio_arr['Communication']['dna_email'];
			} else {
				$from_email = $getFromEmailDetails['User']['email'];
			}
			unset($_SESSION['Auth.User.Dna']);
		} else {
			// for invoice
			if (!empty($communicatio_arr['Communication']['report_email'])) {
				$from_email = $communicatio_arr['Communication']['report_email'];
			} else {
				$from_email = $getFromEmailDetails['User']['email'];
			}
		}

		if (!empty($getFromEmailDetails['Company']['name'])) {
			$from_name = $getFromEmailDetails['Company']['name'];
		} else {
			$from_name = ucfirst(trim($getFromEmailDetails['User']['title']." ". $getFromEmailDetails['User']['forename']." ".				$getFromEmailDetails['User']['middlename']." ".$getFromEmailDetails['User']['surname']));
		}
		$this->Email->SetFrom($from_email, $from_name);

		//$from_email = Configure::read('to_email');
		//$this->Email->SetFrom($from_email, 'Coral Technologies Admin');

		// Attachment
		if($attachment){
			foreach($attachment as $file){
				//echo "---attchmnt--".	$file;
				$this->Email->Addattachment($file);
			}
		}

		// recipients
		if($to){
			foreach($to as $key=>$val){
				$to=$val;
				$to_name='';

				if (!empty($to)) {
					$this->Email->AddAddress($to, $to_name);
				}
			}
		}

		//cc
		if($cc){
			foreach($cc as $key=>$val){
				$cc_email=$val;
				$cc_name='';

				if (!empty($cc_email)) {
					$this->Email->AddCC($cc_email, $cc_name);
				}
			}

		}
		//cc
		if($bcc){
			foreach($bcc as $key=>$val){
				$bcc_email=$val;
				$bcc_name='';

				if (!empty($bcc_email)) {
					$this->Email->AddBCC($bcc_email, $bcc_name);
				}
			}

		}
		//die;
		// send!

		if (!empty($embedded)) {
			//debug($embedded);
			foreach ($embedded AS $image) {
				//debug($image->filename." ".$image->cid." ".$image->name);
				$this->Email->AddEmbeddedImage($image->filename,$image->cid,$image->name);
			}
		}

		if(@$this->Email->Send()){
			//echo "Email send";
			return true;
		} else {
			//echo "Email not send ".$this->Email->ErrorInfo;
			return false;

		}
	}



	function view_letters()
	{
		$conditions = array('GeneralLetter.created_by' => $_SESSION['Auth']['User']['id'],'GeneralLetter.case_id'=>0);
		$letterDetails = $this->paginate('GeneralLetter',array($conditions));

		//debug($letterDetails);

		$this->set('agents',$this->agentsList);
		$this->set('instructors',$this->instructorsList);

		$this->set('letterDetails',$letterDetails);
		$this->set('limit', $this->paginate['limit']);
	}




	function letter_lists($limit=null){

		$this->layout = 'ajax';
		//Filter Conditions
		$resultCondtions = "1=1 ";
		if(!empty($_REQUEST['jString']) && !empty($_REQUEST['jString'])){
			$jString = stripslashes($_REQUEST['jString']);
			$filter = json_decode($jString);
			if(count($filter) > 0){
				foreach($filter as $key => $filterValue){

					if($key == 'file_name' && !empty($filterValue)){
						$resultCondtions .= " AND GeneralLetter.file_name like '%$filterValue%'";
					}else if($key == 'title' && !empty($filterValue)){
						$resultCondtions .= " AND GeneralLetter.title  like '%$filterValue%'";
					}
					else if($key == 'created_date_from' && !empty($filterValue)){
						$filterValue = $this->Date->DbFormat($filterValue);
						$resultCondtions .= " AND DATE(GeneralLetter.created) >= '$filterValue'";
					}
					else if($key == 'created_date_to' && !empty($filterValue)){
						$filterValue = $this->Date->DbFormat($filterValue);
						$resultCondtions .= " AND DATE(GeneralLetter.created) <= '$filterValue'";
					}else if($key == 'created_by' && !empty($filterValue)){
							$filterValue = strtolower($filterValue);
							$resultCondtions .= " AND LOWER( CONCAT_WS('', User.forename, User.surname)) LIKE '%$filterValue%'";
					}else if($key == 'addressed_to' && !empty($filterValue)){
						$resultCondtions .= " AND GeneralLetter.addressee  like '%$filterValue%'";
					}
					else if($key == 'InstructorId' && !empty($filterValue)){
						$resultCondtions .= " AND GeneralLetter.instructor_id ='$filterValue'";
					}
					else if($key == 'AgentId' && !empty($filterValue)){
						$resultCondtions .= " AND GeneralLetter.agency_id='$filterValue'";
					}
				}

			}
		}

		$resultCondtions.= " AND GeneralLetter.created_by = ".$_SESSION['Auth']['User']['id']." AND GeneralLetter.case_id = 0";


		//debug($resultCondtions);
		// Ajax Request
		if($limit != null){
			$this->paginate['limit'] = $limit;
			//$this->layout = 'ajax';
		}
		$letterDetails = $this->paginate('GeneralLetter',array($resultCondtions));
		$this->set('letterDetails',$letterDetails);
		$this->set('limit', $this->paginate['limit']);

	}





	/**
	 * This fuction is used Print the General Letter.
	 * Returns 			: Unknown
	 * Added By 		: Nandini Hulsurkar
	 * Date				: 21 Oct 2011
	 * Last Modified	: 21 Oct 2011
	 **/
	function print_letter($letterId)
	{
		//$this->layout = "ajax";
		$this->layout = "shadow_upload";

		$letterDetails = $this->GeneralLetter->fetchLetterDetails($letterId);
		$this->set('letterDetails', $letterDetails);
	}

	/**
	 * This fuction is used list Print the General Letter.
	 * Returns 			: Unknown
	 * Added By 		: Nandini Hulsurkar
	 * Date				: 21 Oct 2011
	 * Last Modified	: 21 Oct 2011
	 **/
	function email_letter($letterId, $caseId, $flag)
	{
		//$this->layout = "ajax";
		$this->layout = "shadow_upload";

		$users = $this->CommonFunctions->featchUsersRelatedToParticularCase($caseId, null);

		$internalEmails = $this->GeneralLettersEmailDetail->fetchLetterEmailsToInternals($letterId);
		$externalEmails = $this->GeneralLettersEmailDetail->fetchLetterEmailsToExternals($letterId);

		$this->set('internalEmails', $internalEmails);
		$this->set('externalEmails', $externalEmails);
		$this->set('users', $users);
		$this->set('letterId', $letterId);
		$this->set('caseId', $caseId);
		$this->set('flag', $flag);
	}

	/**
	 * This fuction is being used through an Ajax Call to Send Letter(s) through Emails
	 * Returns 			: Unknown
	 * Added By 		: Nandini Hulsurkar
	 * Date				: 21 Oct 2011
	 * Last Modified	: 21 Oct 2011
	 **/
	function ajax_email_letter()
	{
		$this->layout = '';
		$saveData = array();
		$date = date("Y-m-d : H:i:s", time());
		$letterId = $_POST['letterId'];

		$i=0;
		if($_POST['internalDataString'] != '')
		{
			$internalData = explode('%%', $_POST['internalDataString']);
			foreach($internalData as $dataValues)
			{
				$data = explode('##', $dataValues);

				$saveData[$i]['general_letter_id'] = $letterId;
				$saveData[$i]['user_id'] = $data[0];
				$saveData[$i]['email_id'] = $data[1];
				$saveData[$i]['user_type'] = 'Internal';
				$saveData[$i]['date'] = $date;

				$i++;
			}
		}

		$externalData = $_POST['externalDataString'];
		if($externalData != '')
		{
			$externalData = explode('%%', $externalData);
			if($i==0)
			$j = $i;
			else
			$j = ($i+1);

			foreach($externalData as $data)
			{
				$saveData[$j]['general_letter_id'] = $letterId;
				$saveData[$j]['user_id'] = 0;
				$saveData[$j]['email_id'] = $data;
				$saveData[$j]['user_type'] = 'External';
				$saveData[$j]['date'] = $date;

				$j++;
			}
		}

		$this->GeneralLettersEmailDetail->saveAll($saveData);

		$details = $this->GeneralLetter->fetchLetterDetails($letterId);
		$emailCount = ((int)$details[0]['GeneralLetter']['email_count'])+1;
		$GeneralLetter['id'] = $letterId;
		$GeneralLetter['email_count'] = $emailCount;
		$this->GeneralLetter->save($GeneralLetter);

		//Send email functionality
		$emailDetails['from'] = $_SESSION['Auth']['User']['email'];
		$emailDetails['from_name'] = $_SESSION['Auth']['User']['forename']." ".$_SESSION['Auth']['User']['surname'];
		$emailDetails['subject'] = "Case ID : ".$details[0]['GeneralLetter']['case_id']." - ".$details[0]['GeneralLetter']['file_name'].".pdf";

		$emailMgs = "Dear Sir/Madam,<br/><br/>Please check the attachment file..";
		$emailDetails['content'] = $this->prepareEmailTemplate($emailMgs,  "Generic Letter");

		$emailDetails['attachment'] = '';
		if($details[0]['GeneralLetter']['case_id'] != 0)
		{
			$caseMasterId = 0;
			$getCaseMasterId = $this->CaseMaster->query("SELECT CaseMaster.id FROM case_masters AS CaseMaster WHERE CaseMaster.case_id = ".$details[0]['GeneralLetter']['case_id']." GROUP BY CaseMaster.case_id");
			if( !empty($getCaseMasterId) && isset($getCaseMasterId[0]['CaseMaster']['id']) ) {
				$caseMasterId = $getCaseMasterId[0]['CaseMaster']['id'];
			}


                        $case_folder_array = $this->CommonFunctions->make_case_folder($caseMasterId);

                        $case_directory = $case_folder_array['case_directory'];

			$FileExits = $case_directory."GenericLetters/".$details[0]['GeneralLetter']['file_name'].'.pdf';
			if ( file_exists($FileExits) ) {
				//$emailDetails['attachment'] = $FileExits;
				$this->Email->Addattachment($FileExits);
			}
		}
		else
		{
			$FileExits = WWW_ROOT."uploads/expert/".$this->LinUid."/GenericLetters/".$details[0]['GeneralLetter']['file_name'].'.pdf';
			if ( file_exists($FileExits) ) {
				//$emailDetails['attachment'] = $FileExits;
				$this->Email->Addattachment($FileExits);
			}
		}

		foreach($saveData as $data)  {
			$this->Email->AddAddress($data['email_id']);
		}

		$this->Email->IsHTML(true);
		$this->Email->Body = $emailDetails['content'];
		$this->Email->Subject = $emailDetails['subject'];
		$this->Email->SetFrom($emailDetails['from'], $emailDetails['from_name']);

		$output = 0;
		if( $this->Email->send() ) {
			$output = 1;
		}


		echo $output."%%Saparator%%";
		exit;

	}

	function output_file($file, $file_path) {
		$file = $this->EncryptionFunctions->deCrypt($file);
		$file_path = $this->EncryptionFunctions->deCrypt($file_path).$file;

		debug($file);
		debug($file_path);
		exit;

		$this->File->output_file($file_path, $file);
		exit();
	}


	function delete_letter($letterId = 0){
		$user_id = $this->Session->read('Auth.User.id');
		if (($letterId != 0 || $letterId != '0')) {

			$details = $this->GeneralLetter->fetchLetterDetails($letterId);

			$pdf_file = WWW_ROOT."uploads/expert/".$this->logged_in_user_id."/GenericLetters/".$details[0]['GeneralLetter']['file_name'].'.pdf';

			$html_file = WWW_ROOT."uploads/expert/".$this->logged_in_user_id."/GenericLetters/".$details[0]['GeneralLetter']['file_name'].'.html';

			if (file_exists($pdf_file) ) {
				unlink($pdf_file);
				unlink($html_file);
			}

			$this->GeneralLetter->delete($letterId);

			$this->Session->setFlash("The letter has been deleted successfully.",'default', array('class' => 'message success'));
			$this->redirect(array('action' => 'view_letters'));

		}


	}


	function letter_emailer($letterId=null) {

		$this->layout = 'shadow_upload';
		$shadow_close='false';
		$to_email = '';
		$email_cc = '';
		$email_bcc = '';
		$email_subject = '';
		$emailDataStr = array();
		$embedded = array();
		$mail_content = '';

		$user_arr = $this->user_details;

		if (empty($this->data)) {

			$letter_details = $this->GeneralLetter->fetchLetterDetails($letterId);

                        echo '<pre>';
                        print_r($letter_details);

			if(!empty($letter_details[0]['GeneralLetter']['to_user_email_id'])){
				$to_email = $letter_details[0]['GeneralLetter']['to_user_email_id'];
			}


			if(!empty($letter_details[0]['GeneralLetter']['email_cc'])){
				$email_cc = $letter_details[0]['GeneralLetter']['email_cc'];
			}


			if(!empty($letter_details[0]['GeneralLetter']['email_bcc'])){
				$email_bcc = $letter_details[0]['GeneralLetter']['email_bcc'];
			}

			if(!empty($letter_details[0]['GeneralLetter']['email_subject'])){
				$email_subject = $letter_details[0]['GeneralLetter']['email_subject'];
			}

			if(empty($email_subject)){
				$email_subject = $letter_details[0]['GeneralLetter']['title'];
			}

                        debug($email_subject);

			if(!empty($letter_details[0]['GeneralLetter']['email_content'])){
				$mail_content = $letter_details[0]['GeneralLetter']['email_content'];
			}


			$our_reference = $letter_details[0]['GeneralLetter']['our_reference'];

			$your_reference = $letter_details[0]['GeneralLetter']['your_reference'];


			if(!empty($your_reference)){
				$email_subject = 'Your Ref : '.$your_reference.' , '.$email_subject;
			}

			$your_reference_text ='';
			if(!empty($your_reference))
				$your_reference_text = '<strong>Your Reference :</strong> '.$your_reference.'</p>';
			$our_reference_text ='';
			if(!empty($our_reference))
				$our_reference_text = '<strong>Our Reference :</strong> '.$our_reference.'</p>';

			$contact_email ='';
			if(!empty($user_arr['User']['email'])){
				$contact_email =$user_arr['User']['email'];
			}

			if (!empty($user_arr['User']['work_telephone'])) {
				$contact_details = $user_arr['User']['work_telephone']." / ".$contact_email;
			} else if (!empty($user_arr['User']['home_telephone'])) {
				$contact_details = $user_arr['User']['home_telephone']." / ".$contact_email;
			} else if (!empty($rec_user['User']['mobile'])) {
				$contact_details = $user_arr['User']['mobile']." / ".$contact_email;
			} else {
				$contact_details = $contact_email;
			}

			if(!empty($user_arr['Company']['name'])){
				$send_user_comp_name = $user_arr['Company']['name'];
			}

			$send_user_name = ucfirst($user_arr['User']['title'])." " .$user_arr['User']['forename']." " .$user_arr['User']['middlename']." " .$user_arr['User']['surname'];

			$tmp_letter_file = Configure::read('coral_root_path')."/app/webroot/templates/email_general_letter.html";
			$tmp_file_funs = file($tmp_letter_file);
			$email_content = '';

			foreach ($tmp_file_funs as $file_num => $file_fun) {
				$file_fun = str_replace('$our_reference_text$', $our_reference_text, $file_fun);
				$file_fun = str_replace('$your_reference_text$', $your_reference_text, $file_fun);


				$file_fun = str_replace('$contact_details$', $contact_details, $file_fun);
				$file_fun = str_replace('$case_handler_name$', $send_user_name, $file_fun);
				$file_fun = str_replace('$ins_comp_name$', $send_user_comp_name, $file_fun);

				$email_content.= $file_fun;
			}

			$myFile = Configure::read('coral_root_path')."/app/webroot/templates/email_template_pop_up.html";
			$file_funs = file($myFile);

			$emailDataStr['content'] = '';
			$mail_content = '';

			foreach ($file_funs as $file_num => $file_fun) {
				$file_fun = str_replace('$img_logo$', '', $file_fun);
				$file_fun = str_replace('$img_shadow$', '', $file_fun);
				$file_fun = str_replace('$img_shadow_bottom$', '', $file_fun);
				$file_fun = str_replace('$email_header$', $email_subject, $file_fun);
				$file_fun = str_replace('$email_content$', $email_content, $file_fun);
				$file_fun = str_replace('$disclaimer_content$', $_SESSION['Auth']['User']['disclaimer_content'], $file_fun);

				$mail_content.= $file_fun;
			}




			$to_name = '';

			$file = WWW_ROOT."uploads/expert/".$this->logged_in_user_id."/GenericLetters/".$letter_details[0]['GeneralLetter']['file_name'].'.pdf';

			$file_path = WWW_ROOT."uploads/expert/".$this->logged_in_user_id."/GenericLetters/";

			$file_name = $letter_details[0]['GeneralLetter']['file_name'].'.pdf';

			$emailDataStr['letterAttachment']['Letter'] = $file;
			$emailDataStr['letterAttachment']['LetterPath'] = $file_path;
			$emailDataStr['letterAttachment']['LetterName'] = $file_name;

			// for the email content
			$img_logo = Configure::read('coral_root_path')."img/email/logo.png";
			$img_shadow = Configure::read('coral_root_path')."img/email/shadow.jpg";
			$img_shadow_bottom = Configure::read('coral_root_path')."img/email/shadow_btm.jpg";
			$img_account_access = Configure::read('coral_root_path')."img/email/account_access.png";



			$embedded = array();

			$emailDataStr['content'] = $mail_content;
			$emailDataStr['embedded'] = json_encode($embedded);

		} else if (!empty($this->data)) {
			$attachment=array();



			$general_letter_id=$this->data['Emailer']['general_letter_id'];



			if($general_letter_id!=0){
				$letterDetails = $this->GeneralLetter->fetchLetterDetails($general_letter_id);

				if($letterDetails[0]['GeneralLetter']['case_id'] != 0)
				{
					$caseMasterId = 0;

					$caseMasterId = $letterDetails[0]['GeneralLetter']['case_id'];
					$otherDocs_folder = WWW_ROOT."uploads/cases/".$caseMasterId."/otherDocs/";
				}
				else
				{
					$otherDocs_folder = WWW_ROOT."uploads/expert/".$this->LinUid."/otherDocs/";

				}

			}

			$no_of_files= count($_FILES['file_1_']['name']);

			foreach ($_FILES["file_1_"]["error"]as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["file_1_"]["tmp_name"][$key];
					$name = $_FILES["file_1_"]["name"][$key];
					move_uploaded_file($tmp_name, "$otherDocs_folder/$name");
					$attachment[$key]= $otherDocs_folder.$name;
				}
			}

			$to = explode(',',$this->data['Emailer']['To']);
			$Cc = '';
			if (!empty($this->data['Emailer']['Cc'])) {
				$Cc = explode(',',$this->data['Emailer']['Cc']);
			}
			$Bcc = '';
			if (!empty($this->data['Emailer']['Bcc'])) {
				$Bcc = explode(',',$this->data['Emailer']['Bcc']);
			}
			$subject = $this->data['Emailer']['Subject'];
			$content = $this->data['Emailer']['Content'];

			if (!empty($this->data['Emailer']['embedded'])) {
				$embedded = json_decode($this->data['Emailer']['embedded']);
			} else {
				$embedded = array();
			}


			$cntAtt=count($attachment);

			$letter_file=$this->data['Emailer']['letter_file'];


			$attachment[$cntAtt+1] = $letter_file;



			$to_email = $this->data['Emailer']['To'];
			$to_content = $this->data['Emailer']['Content'];
			$to_subject = $this->data['Emailer']['Subject'];
			$email_cc = $this->data['Emailer']['Cc'];
			$email_bcc = $this->data['Emailer']['Bcc'];
			$now = date("Y-m-d H:i:s");


			$update_array = array('GeneralLetter.to_user_email_id'=>"'$to_email'",
					'GeneralLetter.email_subject'=>"'$to_subject'",
					'GeneralLetter.email_content'=>"'$to_content'",
					'GeneralLetter.email_cc'=>"'$email_cc'",
					'GeneralLetter.email_bcc'=>"'$email_bcc'",
					'GeneralLetter.email_count'=>1,
					'GeneralLetter.email_date'=>"'$now'",
			);

			$update_condition = array('GeneralLetter.id'=>$general_letter_id);

			$this->GeneralLetter->updateAll($update_array,$update_condition);


			// as per Thiru request
			$embedded = array();



			$this->send_email($to,'',$subject,$content,$attachment,$Cc,$Bcc,$embedded);
			$shadow_close = true;



			$this->set('shadow_close',$shadow_close);

			//$this->Session->setFlash("Invoice has generated and send successfully",'default', array('class' => 'message success'));

		}


		$this->set('letterId',$letterId);
		$this->set('to_email', $to_email);
		$this->set('email_cc', $email_cc);
		$this->set('email_bcc', $email_bcc);
		$this->set('email_subject', $email_subject);
		$this->set('emailDataStr', $emailDataStr);
		$this->set('shadow_close', $shadow_close);

	}


	function view_letter_pdf($letter_id=null) {
		$this->layout = 'ajax';
		if (!empty($letter_id)) {
			$letter_id = $this->EncryptionFunctions->deCrypt($letter_id);

			$details = $this->GeneralLetter->fetchLetterDetails($letter_id);

			$print_count = $details[0]['GeneralLetter']['print_count'];

			$print_count = $print_count+1;

			$now = date("Y-m-d H:i:s");

			$update_array = array(
					'GeneralLetter.print_count'=>$print_count,
					'GeneralLetter.print_date'=>"'$now'",
			);

			$update_condition = array('GeneralLetter.id'=>$letter_id);

			$this->GeneralLetter->updateAll($update_array,$update_condition);




			$file_name = $details[0]['GeneralLetter']['file_name'].'.pdf';



			$file_path = WWW_ROOT."uploads/expert/".$this->logged_in_user_id."/GenericLetters/".$file_name;




			$this->File->output_file($file_path, $file_name);



			exit;
		}
	}

	function list_documents() {
		$template_dump = array();
		$user_id = $this->Session->read('Auth.User.id');

		if ($this->Session->read('Auth.User.group_id') == Configure::read('AdminUser')) {
			$owner_id = $this->Session->read('Auth.User.parent_id');
		} else {
			$owner_id = $user_id;
		}

		$template_dump = $this->Template->find('all', array('conditions' => array('Template.owner_id' => $owner_id)));

		$template_list = array();
		foreach ($template_dump AS $key => $value) {
			$template_list[$value['Template']['id']] = $value['Template']['name'];
		}

		$this->set('template_list', $template_list);
		$this->set('template_dump',$template_dump);
	}

	function create_or_edit_document($templateId = 0) {
		// set variables
		$user_id = $this->Session->read('Auth.User.id');

		if (($templateId != 0 || $templateId != '0') && empty($this->data)) {
			$templateId = $this->EncryptionFunctions->deCrypt($templateId);
			$this->data = $this->Template->find('first', array('conditions' => array('Template.id' => $templateId)));
		} else if (!empty($this->data)){
			$this->data['Template']['created_by'] = $user_id;

			if ($this->Session->read('Auth.User.group_id') == Configure::read('AdminUser')) {
				$this->data['Template']['owner_id'] = $this->Session->read('Auth.User.parent_id');
			} else {
				$this->data['Template']['owner_id'] = $user_id;
			}

			$template_list = $this->Template->find('list', array('conditions' => array('Template.owner_id' => $user_id)));
			if (!empty($this->data)) {
				$expert_folder = $this->Expert->createExpertDir($user_id);
				$template_dir = $expert_folder.'/template/';

				if ($templateId == 0 && $this->data['Template']['name'] == 'other') {
					$this->data['Template']['name'] = $this->data['Template']['other'];
				}

				if ($templateId == 0) {
					foreach ($template_list AS $key => $value) {
						if ($this->data['Template']['name'] == $value) {
							$this->data['Template']['id'] = $key;
						}
					}
				}

				if (!empty($this->data['Template']['content']) && $this->data['Template']['content']['error'] != 4 && (in_array($this->data['Template']['content']['type'], array('image/jpeg', 'image/gif', 'image/png', 'image/bmp')))) {
					$tmp_name = $this->data['Template']['content']['tmp_name'];
					$name = date('His')."_".$this->data['Template']['content']['name'];

					$image_info = getimagesize($tmp_name);
					$image_type = $image_info[2];
					if ($image_type == IMAGETYPE_JPEG) {
						$image = imagecreatefromjpeg($tmp_name);
					} elseif ($image_type == IMAGETYPE_GIF) {
						$image = imagecreatefromgif($tmp_name);
					} elseif ($image_type == IMAGETYPE_PNG) {
						$image = imagecreatefrompng($tmp_name);
					} elseif ($image_type == IMAGETYPE_WBMP) {
						$image = imagecreatefromwbmp($tmp_name);
					}

					$width = 550;
					$original_width = imagesx($image);
					$original_height = imagesy($image);
					if ($width < $original_width) {
						$ratio = $original_height / $original_width;
						$new_height = $width * $ratio;
						$new_image = imagecreatetruecolor($width, $new_height);
						imagecopyresampled($new_image, $image, 0, 0, 0, 0, $width, $new_height, $original_width, $original_height);
						$image = $new_image;
					}

					$filename = $template_dir.$name;
					if ($image_type == IMAGETYPE_JPEG) {
						imagejpeg($image, $filename, "75");
					} elseif ($image_type == IMAGETYPE_GIF) {
						imagegif($image, $filename);
					} elseif ($image_type == IMAGETYPE_PNG) {
						imagepng($image, $filename);
					} elseif( $image_type == IMAGETYPE_WBMP ) {
						imagewbmp($image, $filename);
					}

					if (isset($this->data['Template']['content_file'])) {
						unlink($template_dir.$this->data['Template']['content_file']);
						unset($this->data['Template']['content_file']);
					}
					unset($this->data['Template']['content']);
					$this->data['Template']['description'] = $name;
				} elseif (!empty($this->data['Template']['content']) && $this->data['Template']['content']['error'] != 4) {
					$tmp = $this->data['Template']['content']['tmp_name'];
					$name = date('His')."_".$this->data['Template']['content']['name'];
					$dst = $template_dir.$name;
					if (move_uploaded_file($tmp, $dst)) {
						if(isset($this->data['Template']['content_file'])){
							unlink($template_dir.$this->data['Template']['content_file']);
							unset($this->data['Template']['content_file']);
						}

						unset($this->data['Template']['content']);
						$this->data['Template']['description'] = $name;
					}
				}
				//debug($this->data); exit();
				if ($this->Template->save($this->data['Template'])) {
					// this will save the template content into a file
					/*$filename = $template_dir.$this->data['Template']['name'].".html";
					 $old_content = $this->data['Template']['content'];

					 if ($_SERVER['HTTP_HOST'] == 'localhost') {
						$content = str_replace('/coralms2/app/webroot/uploads/template_images/', Configure::read('coral_root_path').'uploads/template_images/', $old_content);
						} else if ($_SERVER['HTTP_HOST'] == 'coraltechnologies.co.uk' || $_SERVER['HTTP_HOST'] == 'www.coraltechnologies.co.uk') {
						$content = str_replace('/application/app/webroot/uploads/template_images/', Configure::read('coral_root_path').'uploads/template_images/', $old_content);
						}

						$handle = fopen($filename, 'w+');
						fwrite($handle, $content);
						fclose($handle);*/

					$this->Session->setFlash("The template has been created successfully.",'default', array('class' => 'message success'));
					$this->redirect(array('action' => 'list_documents'));
				}
			}

			$this->set('template_list', $template_list);
		}
		$this->set('templateId', $templateId);
	}

        function create_letter_popup($case_master_id=NULL,$edit_flag=NULL){

            $this->layout = 'shadow_upload';
            $shadow_close='false';

            unset($_SESSION['show_email_popup']);

            $_SESSION['show_email_popup'] = '';

            $logged_in_user_id = $this->logged_in_user_id;
            $logged_user_group_id = $this->logged_user_group_id;

            $owner_id = $this->get_owner_id();
            $templates = $this->Template->fetchAllTemplatesOfOwner($owner_id);


            $to_email_options = array();

            $case_user_ids = array();

            $letter_content = '';

            $letter_file_subject = '';

            $letter_file_name = '';

            $letter_case_handler_id = '';

            $letter_template_id = '';

            $template_checked = '';

            if($case_master_id!=''){

            $caseUsersArr = $this->CommonFunctions->GetCaseUsersDetails($case_master_id);


            if($edit_flag==1){
                $letter_content = $_SESSION['letter_content'];
                $letter_file_subject = $_SESSION['letter_file_subject'];
                $letter_file_name = $_SESSION['letter_file_name'];
                $letter_case_handler_id = $_SESSION['letter_case_handler_id'];
                $letter_template_id = $_SESSION['letter_template_id'];

                if(!empty($letter_template_id)){
                    $template_checked = 1;
                }
            }


            if(count($caseUsersArr)>0){
			for($k=0;$k<count($caseUsersArr);$k++){
				if($caseUsersArr[$k]['case_users']['user_id']==$this->logged_in_user_id){
					if ($logged_user_group_id == Configure::read('ExpertSuperUser') || $logged_user_group_id == Configure::read('TherapistSuperUser')) {
						$case_user_ids[] = $caseUsersArr[$k-1]['case_users']['user_id'];
					}else{
						$case_user_ids[] = $caseUsersArr[$k-1]['case_users']['user_id'];
                                                if(!empty($caseUsersArr[$k+1]['case_users']['user_id'])){
                                                    $case_user_ids[] = $caseUsersArr[$k+1]['case_users']['user_id'];
                                                }
					}
				}
			}
		}



		if(!empty($case_user_ids)&&count($case_user_ids)>0){
				foreach($case_user_ids as $to_user_id){
					$toCaseUsersDet[] = $this->User->find('first', array('fields'=>array('User.id','User.group_id','User.title','User.forename','User.middlename','User.surname','User.email','Company.name'),'conditions' => array('User.id' => $to_user_id), 'recursive' =>1));
				}
		}



		if(!empty($toCaseUsersDet)){
			foreach($toCaseUsersDet as $k=>$caseUsers){

				$name_val = '';

				if($caseUsers['User']['group_id']==Configure::read('ExpertSuperUser') || $caseUsers['User']['group_id']== Configure::read('TherapistSuperUser')){
					$type = 'expert';
					if(!empty($caseUsers['User']['title']))
						$name_val = ucfirst($caseUsers['User']['title'])." ".$caseUsers['User']['forename']." ".$caseUsers['User']['surname'];
					else
						$name_val = $caseUsers['User']['forename']." ".$caseUsers['User']['surname'];

					$email = $caseUsers['User']['email'];
				}else{
					$type = 'agency';
					$name_val = $caseUsers['Company']['name'];

					$case_user_id = $caseUsers['User']['id'];

					$report_email = '';

					if(!empty($case_user_id)){
						$case_user_det = $this->CaseUser->find('first',array('conditions'=>array('CaseUser.user_id'=>$case_user_id,'CaseUser.case_master_id'=>$case_master_id,'(CaseUser.additional_info IS NULL OR CaseUser.additional_info="")')));
						$report_email = $case_user_det['CaseUser']['report_invoice_email'];
					}

					if(empty($report_email)){
						//$case_user_id = $caseUsers['case_users']['user_id'];
						$communicatio_arr = $this->Communication->find('first', array('recursive' => -1, 'conditions' => array('Communication.user_id' => $case_user_id)));
						$report_email = $communicatio_arr['Communication']['report_email'];
					}

					$email = $report_email;
				}

				$finalArray[$k] = array('id'=>$caseUsers['User']['id'],
										'type' => $type,
										'name' => $name_val,
										'email'=> $email,
										);

			}

            }


            $finalarraycount = count($finalArray);


            $case_dump = $this->CaseMaster->find('first', array('conditions' => array('CaseMaster.id' => $case_master_id), 'recursive' => 2));

            $claimant_id = $case_dump['CaseClaimantDetail']['id'];



            if($case_dump['CaseClaimantDetail']['title']!='' || $case_dump['CaseClaimantDetail']['title']!='NULL'){
                    $case_dump['CaseClaimantDetail']['title'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['title']);
             }
                if($case_dump['CaseClaimantDetail']['forename']!='' || $case_dump['CaseClaimantDetail']['forename']!='NULL'){
                    $case_dump['CaseClaimantDetail']['forename'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['forename']);
                }
                if($case_dump['CaseClaimantDetail']['surname']!='' || $case_dump['CaseClaimantDetail']['surname']!='NULL'){
                    $case_dump['CaseClaimantDetail']['surname'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['surname']);
                }
                if($case_dump['CaseClaimantDetail']['email']!='' || $case_dump['CaseClaimantDetail']['email']!='NULL'){
                    $case_dump['CaseClaimantDetail']['email'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['email']);
                }

		$claimant_name=$case_dump['CaseClaimantDetail']['title']." ".$case_dump['CaseClaimantDetail']['forename']." ".$case_dump['CaseClaimantDetail']['surname'];

		$claimant_email = $case_dump['CaseClaimantDetail']['email'];


            $finalArray[$finalarraycount] = array('id'=>$claimant_id,
						'type' =>'claimant',
						'name' => $claimant_name,
						'email'=> $claimant_email,
						);



            if(!empty($finalArray)){
                foreach($finalArray as $items){
                    $to_email_options[$items['id'].'_'.$items['type'].'_'.$items['email']]=$items['name'];

                }

            }

            }


            $this->set('to_email_options',$to_email_options);
            $this->set('templates',$templates);
            $this->set('shadow_close',$shadow_close);
            $this->set('case_master_id',$case_master_id);


            $this->set('letter_content',$letter_content);
            $this->set('letter_file_subject',$letter_file_subject);
            $this->set('letter_file_name',$letter_file_name);
            $this->set('letter_case_handler_id',$letter_case_handler_id);
            $this->set('letter_template_id',$letter_template_id);
            $this->set('template_checked',$template_checked);
            $this->set('edit_flag',$edit_flag);



            if( !empty($this->data) )
		{


			$edited_letter_id = 0;
			if($this->data['GeneralLetter']['id']>0){
				$edited_letter_id = $this->data['GeneralLetter']['id'];
				$this->data['GeneralLetter']['id'] = 0;
				$this->data['GeneralLetter']['edited'] = 1;
			}

			$preselected_case_master_id = 0;
			$preselected_case_master_id =$this->data['GeneralLetter']['preselected_case_master_id'];

                        $to_user_type = '';
                        $to_user_id = '';
                        $to_user_email_id = '';

                        $email_user_data = $this->data['CaseUser']['case_handler_subusers_id'];
                        if(empty($email_user_data)){
                          $email_user_data = $this->data['CaseUser']['case_handler_user_id'];
                        }

                        if(!empty($email_user_data)){
                            $email_user_data_array = explode("_", $email_user_data);
                            $to_user_type=  $email_user_data_array[0];
                            $to_user_id = $email_user_data_array[1];
                            $to_user_email_id = $email_user_data_array[2];
                        }

			//debug($this->data);
			//exit;

			$date = date("Y-m-d : H:i:s", time());
			//$description = str_replace("<p>", "", $this->data['GeneralLetter']['description']);
			//$description = str_replace("</p>", "<br>", $description);
			$this->data['GeneralLetter']['description'] = $this->data['GeneralLetter']['description'];

			$description = $this->data['GeneralLetter']['description'];
			$printContent = $this->data['GeneralLetter']['description'];

			$this->data['GeneralLetter']['created_by'] = $_SESSION['Auth']['User']['id'];
			if( (int)$letterId == 0){
				$this->data['GeneralLetter']['created'] = $date;
				$this->data['GeneralLetter']['modified'] = '';
			}else{
				$this->data['GeneralLetter']['modified'] = $date;
			}

			if($this->data['GeneralLetter']['case_id'] == ''){
				$this->data['GeneralLetter']['case_id'] = 0;
			}else{
				$case_master_id = $this->data['GeneralLetter']['case_id'];

			}


                        $this->data['GeneralLetter']['to_user_type'] = $to_user_type;
                        $this->data['GeneralLetter']['to_user_id'] = $to_user_id;
                        $this->data['GeneralLetter']['to_user_email_id'] = $to_user_email_id;

			if( $this->data['GeneralLetter']['template_id'] == ''){
				$this->data['GeneralLetter']['template_id'] = 0;
			}

			if(!empty($this->data['GeneralLetter']['file_name'])){
				$order   = array(" ");
				$replace = '_';
				$file_name = str_replace($order, $replace, $this->data['GeneralLetter']['file_name']);

                                $curent_date_file_name = date('d-m-Y');
				$this->data['GeneralLetter']['file_name'] = $file_name.'_'.$curent_date_file_name;


			}

			//debug($this->data);
			//exit;



			$page_action = $this->data['GeneralLetter']['action'];


			$caseMasterId =0;

			if($this->GeneralLetter->save($this->data))
			{

				$general_letter_id = $this->GeneralLetter->getLastInsertID();

				$checkFolderExits = WWW_ROOT."uploads";
				if (!file_exists($checkFolderExits)) {
					mkdir($checkFolderExits, 0777);
				}




				if($this->data['GeneralLetter']['case_id'] == 0 || empty($this->data['GeneralLetter']['case_id']))
				{
					$checkFolderExits = WWW_ROOT."uploads/expert/";
					if (!file_exists($checkFolderExits)) {
						mkdir($checkFolderExits, 0777);
					}

					$checkFolderExits = WWW_ROOT."uploads/expert/".$this->LinUid;
					if (!file_exists($checkFolderExits)) {
						mkdir($checkFolderExits, 0777);
					}

					$checkFolderExits = WWW_ROOT."uploads/expert/".$this->LinUid."/GenericLetters";
					if (!file_exists($checkFolderExits)) {
						mkdir($checkFolderExits, 0777);
					}

					$folderPath = WWW_ROOT."uploads/expert/".$this->LinUid."/GenericLetters/";

					$type = 1;

				}
				else
				{

					$caseMasterId = $case_master_id;

                                        $case_folder_array = $this->CommonFunctions->make_case_folder($caseMasterId);

                                        $case_directory = $case_folder_array['case_directory'];



					$checkFolderExits = $case_directory."GenericLetters";
					if (!file_exists($checkFolderExits)) {
						mkdir($checkFolderExits, 0777);
					}

					$folderPath = $case_directory."GenericLetters";
					$type = 2;

					$fileName = $this->data['GeneralLetter']['file_name'];

					$file_name_value = $fileName;
					$file_name_array = explode('_',$file_name_value);
					array_pop($file_name_array);
					$file_name_new_value = implode('_',$file_name_array);

					$to_user_name = $this->get_touser_name($general_letter_id);

					if(!empty($to_user_name)){
						$comment=$file_name_new_value.'('.$to_user_name.')';
					}else{
						$comment=$file_name_new_value;
					}

					if($letterId>0){
						$this->make_case_log_entry($case_master_id, 74,$comment);
					}else{
						$this->make_case_log_entry($case_master_id, 73,$comment);
					}

				}


				$pdf_created = false;
				$path = $folderPath;
				$fileName = $this->data['GeneralLetter']['file_name'];
				$print_html_file_name = $folderPath.'/'.$fileName.".html";



				$print_file = fopen($print_html_file_name, 'wb') or die("can't open file");
				fwrite($print_file, $printContent);
				fclose($print_file);


				$printed_by_text=ucfirst(trim($_SESSION['Auth']['User']['title'].' '.$_SESSION['Auth']['User']['forename'].' '.$_SESSION['Auth']['User']['middlename'].' '.$_SESSION['Auth']['User']['surname'])) .'  @  '.date('H:i:s') .', '.date('l jS F Y');


				$Pdf = new LetterPdfComponent();
				// Invoice name (output name)
				$Pdf->filename = $fileName; // Without .pdf
				// You can use download, file or browser here
				$Pdf->output = 'file';

				$logo ='';

				$stringHeader ='';

				/*$Pdf->headerhtml = '<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" class="table_wrap_content">
				<tr>
				<td height="50px;">

				</td>
				</tr>
				</table>';*/

				//$Pdf->footerhtml = '<div align="left" style="font-size:10px;border-top:1px solid #000000;margin-top:20px;">Printed by: '.$printed_by_text.' </div>';

				/*$Pdf->footerhtml = '<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" class="table_wrap_content">
				<tr>
				<td height="50px;">

				</td>
				</tr>
				</table>';*/

				$Pdf->headerhtml = '<div align="left" style=""> </div>';

				$Pdf->footerhtml = '<div align="left" style=""> </div>';


				$Pdf->init($path);
				$Pdf->media->set_landscape(false);

				Configure::write('pdf_html_link', $print_html_file_name);
				$Pdf->process(Router::url('/', true) . 'build_letters/download_pdf_view/'.$fileName.'/'.$this->logged_in_user_id.'/'.$type.'/'.$caseMasterId);

				$pdf_created = true;

				$_SESSION['general_letter_id'] = 0;

                                debug($page_action);

				if($page_action=='saveandemail' && $pdf_created==true){

					$sendEmailPopup = true;

					$_SESSION['show_email_popup'] = 'true';

					$_SESSION['general_letter_id'] = $general_letter_id;


				}else{
					$_SESSION['show_email_popup'] = '';

					$_SESSION['general_letter_id'] = 0;

				}

                                 $shadow_close='true';
                                 //debug($shadow_close);
                                 //debug($_SESSION['show_email_popup']);
                                 //exit;
			}

		}
                $this->set('shadow_close',$shadow_close);




        }


        function ajax_save_letter_popup(){
            $this->layout = '';
            $case_master_id = $_POST['case_master_id'];

            if(!empty($case_master_id) )
		{


                        $to_user_type = '';
                        $to_user_id = '';
                        $to_user_email_id = '';

                        $email_user_data = $_SESSION['letter_case_handler_subusers_id'];
                        if(empty($email_user_data)){
                          $email_user_data = $_SESSION['letter_case_handler_user_id'];
                        }

                        if(!empty($email_user_data)){
                            $email_user_data_array = explode("_", $email_user_data);
                            $to_user_type=  $email_user_data_array[0];
                            $to_user_id = $email_user_data_array[1];
                            $to_user_email_id = $email_user_data_array[2];
                        }


			$date = date("Y-m-d : H:i:s", time());

			$this->data['GeneralLetter']['description'] = $_SESSION['letter_content'];

			$description = $this->data['GeneralLetter']['description'];
			$printContent = $this->data['GeneralLetter']['description'];

			$this->data['GeneralLetter']['created_by'] = $_SESSION['Auth']['User']['id'];

			$this->data['GeneralLetter']['modified'] = $date;

			$this->data['GeneralLetter']['case_id'] = $case_master_id;


                        $this->data['GeneralLetter']['title'] = $_SESSION['letter_file_subject'];

                        $this->data['GeneralLetter']['to_user_type'] = $to_user_type;
                        $this->data['GeneralLetter']['to_user_id'] = $to_user_id;
                        $this->data['GeneralLetter']['to_user_email_id'] = $to_user_email_id;

                        $this->data['GeneralLetter']['template_id'] = $_SESSION['letter_template_id'];



			if(!empty($_SESSION['letter_file_name'])){
				$order   = array(" ");
				$replace = '_';
				$file_name = str_replace($order, $replace, $_SESSION['letter_file_name']);

                                $curent_date_file_name = date('d-m-Y');
				$this->data['GeneralLetter']['file_name'] = $file_name.'_'.$curent_date_file_name;


			}




			$caseMasterId =0;

			if($this->GeneralLetter->save($this->data))
			{

				$general_letter_id = $this->GeneralLetter->getLastInsertID();

				$checkFolderExits = WWW_ROOT."uploads";
				if (!file_exists($checkFolderExits)) {
					mkdir($checkFolderExits, 0777);
				}


				$caseMasterId = $case_master_id;


					$case_folder_array = $this->CommonFunctions->make_case_folder($caseMasterId);

                                        $case_directory = $case_folder_array['case_directory'];



					$checkFolderExits = $case_directory."GenericLetters";
					if (!file_exists($checkFolderExits)) {
						mkdir($checkFolderExits, 0777);
					}

					$folderPath = $case_directory."GenericLetters";

					$type = 2;

					$fileName = $this->data['GeneralLetter']['file_name'];

					$file_name_value = $fileName;
					$file_name_array = explode('_',$file_name_value);
					array_pop($file_name_array);
					$file_name_new_value = implode('_',$file_name_array);

					$to_user_name = $this->get_touser_name($general_letter_id);

					if(!empty($to_user_name)){
						$comment=$file_name_new_value.'('.$to_user_name.')';
					}else{
						$comment=$file_name_new_value;
					}


					$this->make_case_log_entry($case_master_id, 73,$comment);





				$pdf_created = false;
				$path = $folderPath;
				$fileName = $this->data['GeneralLetter']['file_name'];
				$print_html_file_name = $folderPath.'/'.$fileName.".html";



				$print_file = fopen($print_html_file_name, 'wb') or die("can't open file");
				fwrite($print_file, $printContent);
				fclose($print_file);


				$printed_by_text=ucfirst(trim($_SESSION['Auth']['User']['title'].' '.$_SESSION['Auth']['User']['forename'].' '.$_SESSION['Auth']['User']['middlename'].' '.$_SESSION['Auth']['User']['surname'])) .'  @  '.date('H:i:s') .', '.date('l jS F Y');


				$Pdf = new LetterPdfComponent();
				// Invoice name (output name)
				$Pdf->filename = $fileName; // Without .pdf
				// You can use download, file or browser here
				$Pdf->output = 'file';

				$logo ='';

				$stringHeader ='';



				$Pdf->headerhtml = '<div align="left" style=""> </div>';

				$Pdf->footerhtml = '<div align="left" style=""> </div>';


				$Pdf->init($path);
				$Pdf->media->set_landscape(false);

				Configure::write('pdf_html_link', $print_html_file_name);
				$Pdf->process(Router::url('/', true) . 'build_letters/download_pdf_view/'.$fileName.'/'.$this->logged_in_user_id.'/'.$type.'/'.$caseMasterId);

				$pdf_created = true;

				$_SESSION['general_letter_id'] = 0;

                                $_SESSION['general_letter_id'] = $general_letter_id;

                                $finalArray['general_letter_id'] = $general_letter_id;
                                $finalArray['response'] = 'success';



                                echo json_encode($finalArray);

                                exit;


                            }

		}

                $finalArray['response'] = 'success';
                echo json_encode($finalArray);
                exit;

        }

        function ajax_fill_case_details_popup(){

		$this->layout = '';

		$case_master_id = $_POST['caseId'];

		$template_id = $_POST['templateId'];



		$case_handler_id_det = $_POST['case_handler_id'];

		$case_handler_subusers_id = $_POST['case_handler_subusers_id'];

                $template_to_address = '';

		$template_our_ref = '';

		$template_your_ref = '';

		$template_content = '';
		$template_name = '';

		if(!empty($template_id)){
			$templateDetails = $this->Template->fetchTemplateDetails($template_id);

			if( isset($templateDetails[0]) ) {
				$template_content = $templateDetails[0]['Template']['description'];
                                $template_name = $templateDetails[0]['Template']['name'];
			}

		}




		$logged_user_group_id = $this->logged_user_group_id;

		$user_arr = $this->user_details;

                $user_arr_current_login = $this->User->find('first', array('conditions' => array('User.id' => $this->Session->read('Auth.User.id')),'recursive' => 2));

		$instruction_qualification = "";

		$our_reference_text = "";

		$your_reference_text = "";

		$content = "";

		$instruction_comp_name="<strong>".$user_arr['Company']['name']."</strong>";
		//echo $instruction_comp_name; exit;
		if(empty($instruction_comp_name)){
			//Get the Qualification
			$instruction_qualification = "";
			if(!empty($user_arr['ExpertProfession']['Qualification'])){
				$i=0;
				foreach($user_arr['ExpertProfession']['Qualification'] as $value){
					if($i==0){
						$instruction_qualification = strtoupper($value['qualification']);
					}else{
						$instruction_qualification .= ", ".strtoupper($value['qualification']);
					}
					$i++;
				}
			}
			$instruction_comp_name = "<strong>".ucfirst($user_arr['User']['title'])." " .$user_arr['User']['forename']." " .$user_arr['User']['middlename']." " .$user_arr['User']['surname']." ".$instruction_qualification."</strong>";
		}
		$instruction_header=$instruction_comp_name ."<br>".$user_arr['Address'][0]['address1'];
		if(isset($user_arr['Address'][0]['address2']) && $user_arr['Address'][0]['address2'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['address2'];
		}
		if(isset($user_arr['Address'][0]['address3']) && $user_arr['Address'][0]['address3'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['address3'];
		}
		if(isset($user_arr['Address'][0]['address4']) && $user_arr['Address'][0]['address4'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['address4'];
		}
		if(isset($user_arr['Address'][0]['address5']) && $user_arr['Address'][0]['address5'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['address5'];
		}
		if(isset($user_arr['Address'][0]['town']) && $user_arr['Address'][0]['town'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['town'];
		}
		$instruction_header .="<br>".$user_arr['Address'][0]['postcode'];
		if(isset($user_arr['Address'][0]['work_telephonec']) && $user_arr['Address'][0]['work_telephonec'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['work_telephonec']." (W)";
		}
		if(isset($user_arr['Address'][0]['mobile']) && $user_arr['Address'][0]['mobile'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['mobile']." (M)";
		}

		$send_user_comp_name = '';
		if(!empty($user_arr['Company']['name'])){
			$send_user_comp_name = $user_arr['Company']['name'];

			$send_user_comp_name_text = 'For and on behalf of <strong>'.$send_user_comp_name.'</strong>';
		}

		$send_user_name = '';

		$send_user_name = ucfirst($user_arr_current_login['User']['title'])." " .$user_arr_current_login['User']['forename']." " .$user_arr_current_login['User']['middlename']." " .$user_arr_current_login['User']['surname']." ".$instruction_qualification;


		$toaddress_header ='';

		if(!empty($template_to_address)){
			$order   = array("\r\n", "\n", "\r");
			$replace = '<br/>';
			$template_to_address = str_replace($order, $replace, $template_to_address);
			$toaddress_header = $template_to_address;
		}


		if(!empty($template_our_ref)){
			$our_reference_text = 'Our Reference: '.$template_our_ref;
		}

		if(!empty($template_your_ref)){
			$your_reference_text = 'Your Reference: '.$template_your_ref;
		}



                $communicatio_arr = $this->Communication->find('first', array('recursive' => -1, 'conditions' => array('Communication.user_id' => $this->Session->read('Auth.User.id'))));

		$contact_details = '';
		$contact_email ='';
		$contact_phone = '';

                if(!empty($communicatio_arr['Communication']['appointment_email'])){
                    $contact_email = $communicatio_arr['Communication']['appointment_email'];
                }

		if(!empty($user_arr['User']['email']) && empty($contact_email)){
			$contact_email =$user_arr_current_login['User']['email'];
		}

		if(!empty($user_arr['User']['work_telephone'])) {
			$contact_phone = $user_arr_current_login['User']['work_telephone'];
		} else if (!empty($user_arr['User']['home_telephone'])) {
			$contact_phone = $user_arr_current_login['User']['home_telephone'];
		} else if (!empty($rec_user['User']['mobile'])) {
			$contact_phone = $user_arr_current_login['User']['mobile'];
		}

		if(!empty($contact_phone)){
			$contact_details = 'Tel : '.$contact_phone.'<br/>';
		}
		$contact_details .= 'Email : '.$contact_email;


		$solicitor_reference_text = '';

		$cur_date=date('d-m-Y');

		if (!empty($case_master_id)) {


			if(!empty($case_handler_id_det)){

				$case_handler_id_det = explode('_',$case_handler_id_det);

				$case_handler_id = $case_handler_id_det[0];

				$case_handler_type = $case_handler_id_det[1];

			}

			if($case_handler_type=="expert" && !empty($case_handler_id) && !empty($case_handler_subusers_id)){

				$case_handler_subuser_id_det = explode('_',$case_handler_subusers_id);

				$case_handler_subusers_id = $case_handler_subuser_id_det[0];

				$to_user_id = $case_handler_subusers_id;

				$to_user_id_address = $case_handler_id;

				$to_user_company_id = $case_handler_id;
			}

			else if($case_handler_type=="expert" && !empty($case_handler_id) && empty($case_handler_subusers_id)){

				$to_user_id = $case_handler_id;

				$to_user_id_address = $case_handler_id;

				$to_user_company_id = $case_handler_id;

			}
			else if($case_handler_type=="agency" && !empty($case_handler_id) && empty($case_handler_subusers_id)){

				//$to_user_id = $case_handler_id;

				$to_user_id = '';

				$to_user_id_address = $case_handler_id;

				$to_user_company_id = $case_handler_id;

			}
			else if($case_handler_type=="agency" && !empty($case_handler_id) && !empty($case_handler_subusers_id)){

				//$to_user_id = $case_handler_id;

				$to_user_id = $case_handler_subusers_id;

				$to_user_id_address = $case_handler_id;

				$to_user_company_id = $case_handler_id;

			}
			else if ($case_handler_type=="claimant" && !empty($case_handler_id)){

				$to_user_id = 0;

				$to_user_id_address = 0;

				$to_user_company_id = 0;
			}

			//debug($to_user_id);

			//debug($case_handler_id);

			//debug($case_handler_type);


			$caseUsersArr = $this->CommonFunctions->GetCaseUsersDetails($case_master_id);

			if(count($caseUsersArr)>0){
				for($k=0;$k<count($caseUsersArr);$k++){
					if($caseUsersArr[$k]['case_users']['user_id']==$this->logged_in_user_id){

						//$to_user_id = $caseUsersArr[$k-1]['case_users']['user_id'];

						//$agentCompananyName=$this->Common->company_name($caseUsersArr[$k-1]['users']['id']);

						//$yourref = $caseUsersArr[$k-1]['case_users']['user_reference'];

					}

					if($caseUsersArr[$k]['case_users']['user_type']=='Instructor'){
						$solicitor_reference = $caseUsersArr[$k]['case_users']['user_reference'];
					}
				}
			}

			if(!empty($solicitor_reference)){
				$solicitor_reference_text = '<strong>Solicitor Reference : '.$solicitor_reference.'</strong><br>';

			}


			if(!empty($case_handler_id)){
				//$to_user_id = $case_handler_id;
			}



			if (!empty($case_master_id)) {

				$toaddress_name ='';
				if(!empty($to_user_id))
				$toUserDet = $this->User->find('first', array('conditions' => array('User.id' => $to_user_id), 'recursive' => 2));

				//debug($toUserDet);


				if(!empty($toUserDet)){
					if(!empty($to_user_company_id))
					$toUserCompanyDet = $this->User->find('first', array('conditions' => array('User.id' => $to_user_company_id), 'recursive' => 2));
					$touser_company_name=$toUserCompanyDet['Company']['name'];
					if(!empty($touser_company_name)){
						$toaddress_name = ucfirst($toUserDet['User']['title'])." " .$toUserDet['User']['forename']." " .$toUserDet['User']['middlename']." " .$toUserDet['User']['surname']."<br/>";
						$toaddress_name .=$touser_company_name;
					}else{
						$toaddress_name = ucfirst($toUserDet['User']['title'])." " .$toUserDet['User']['forename']." " .$toUserDet['User']['middlename']." " .$toUserDet['User']['surname'];
					}
				}else{
					if(!empty($to_user_company_id)){
						$toUserCompanyDet = $this->User->find('first', array('conditions' => array('User.id' => $to_user_company_id), 'recursive' => 2));
						$toaddress_name=$toUserCompanyDet['Company']['name'];
					}

				}
				if(!empty($to_user_id_address))
				$toAddress = $this->Address->find('first', array('conditions' => array('Address.user_id' => $to_user_id_address,'address_type'=>'billing'), 'recursive' => -1));
				if(empty($toAddress)){
					$toAddress = $this->Address->find('first', array('conditions' => array('Address.user_id' => $to_user_id_address), 'recursive' => -1));
				}

				if(!empty($toAddress)){
					if(!empty($toaddress_name))
						$toaddress_header=$toaddress_name ."<br>".$toAddress['Address']['address1'];
					else
						$toaddress_header= $toAddress['Address']['address1'];

				if(isset($toAddress['Address']['address2']) && $toAddress['Address']['address2'] !=""){
					$toaddress_header .="<br>".$toAddress['Address']['address2'];
				}
				if(isset($toAddress['Address']['address3']) && $toAddress['Address']['address3'] !=""){
					$toaddress_header .="<br>".$toAddress['Address']['address3'];
				}
				if(isset($toAddress['Address']['address4']) && $toAddress['Address']['address4'] !=""){
					$toaddress_header .="<br>".$toAddress['Address']['address4'];
				}
				if(isset($toAddress['Address']['address5']) && $toAddress['Address']['address5'] !=""){
					$toaddress_header .="<br>".$toAddress['Address']['address5'];
				}
				if(isset($toAddress['Address']['town']) && $toAddress['Address']['town'] !=""){
					$toaddress_header .="<br>".$toAddress['Address']['town'];
				}
				$toaddress_header .="<br>".$toAddress['Address']['postcode'];
				if(isset($instructor_company_arr['Address']['work_telephonec']) && $instructor_company_arr['Address']['work_telephonec'] !=""){
					$toaddress_header .="<br>".$instructor_company_arr['Address']['work_telephonec']." (W)";
				}
				if(isset($instructor_company_arr['Address']['mobile']) && $instructor_company_arr['Address']['mobile'] !=""){
					$toaddress_header .="<br>".$instructor_company_arr['Address']['mobile']." (M)";
				}

				}


			}







			$claimant_address_text = '';

			$claimant_det_text ='';


			if($case_master_id!=''){

				$case_dump = $this->CaseMaster->find('first', array('conditions' => array('CaseMaster.id' => $case_master_id), 'recursive' => 2));

			}
				// looping throught CaseMaster dump
				/*	foreach ($case_dump AS $key => $value) {}*/
				/*$case_user_dump = $case_dump['CaseUser'];
				$case_user_dump = array_reverse($case_user_dump, true);
				// looping throught CaseUserDump
				if ($logged_user_group_id == Configure::read('ExpertSuperUser') || $logged_user_group_id == Configure::read('TherapistSuperUser')) {
					// for expert login
					$last_guy_details = current($case_user_dump);
					$secondlast_guy_details = next($case_user_dump);
				}

				$lastElement=array();
				$seconLastElement=array();
				if(!empty($last_guy_details)){
					//lat guy details
					$lastElement['id']=$last_guy_details['id'];
					$lastElement['user_id']=$last_guy_details['user_id'];
					$lastElement['user_reference']=$last_guy_details['user_reference'];
					$lastElement['report_date']=$last_guy_details['report_date'];
					$lastElement['user_type']=$last_guy_details['user_type'];
					$lastElement['case_handler_id']=$last_guy_details['case_handler_id'];
					$lastElement['fees_master_id']=$last_guy_details['fees_master_id'];
					$lastElement['report_file_name']=$last_guy_details['report_file_name'];
					$lastElement['report_file_path']=$last_guy_details['report_file_path'];

					//secondlast guy details
					$seconLastElement['user_id']=$secondlast_guy_details['user_id'];
					$seconLastElement['user_reference']=$secondlast_guy_details['user_reference'];
					$seconLastElement['report_date']=$secondlast_guy_details['report_date'];
					$seconLastElement['user_type']=$secondlast_guy_details['user_type'];
					$seconLastElement['case_handler_id']=$secondlast_guy_details['case_handler_id'];
					$seconLastElement['fees_master_id']=$secondlast_guy_details['fees_master_id'];
					$seconLastElement['report_file_name']=$secondlast_guy_details['report_file_name'];
					$seconLastElement['report_file_path']=$secondlast_guy_details['report_file_path'];
					$last_user_id=$lastElement['user_id'];
					$secnd_last_user_id=$seconLastElement['user_id'];

				}
				if($logged_user_group_id!=Configure::read('ExpertSuperUser') || $logged_user_group_id!=Configure::read('TherapistSuperUser')){
					$your_reference=$case_dump['CaseMaster']['case_id'];
					$report_date=$seconLastElement['report_date'];
				}else{
					$your_reference=$lastElement['user_reference'];
					$report_date=$lastElement['report_date'];
				}
				$our_reference=$seconLastElement['user_reference'];
				//$claim_name = $case_dump['CaseClaimantDetail']['forename'];
			}*/


			$CaseUsers = $this->CaseUser->find('all', array('conditions' => array('CaseUser.case_master_id' => $case_master_id,'(CaseUser.additional_info IS NULL OR CaseUser.additional_info="")'), 'recursive' =>-1,'order' => array('CaseUser.id ASC')));

                        //echo '<pre>';
                        //print_r($CaseUsers);

			foreach($CaseUsers as $key=>$usrDetail ){
				$user_id=$usrDetail['CaseUser']['user_id'];
				if (($logged_user_group_id == Configure::read('ExpertSuperUser')) && ($user_id==$this->logged_in_user_id)) {
					$last_guy_details=$usrDetail['CaseUser'];
					$secondlast_guy_details=$CaseUsers[$key-1]['CaseUser'];

					$your_reference=$secondlast_guy_details['user_reference'];
					$report_date=$last_guy_details['report_date'];
					$our_reference=$case_dump['CaseMaster']['case_id'];;
				}
				if (($logged_user_group_id == Configure::read('TherapistSuperUser')) && ($user_id==$this->logged_in_user_id)) {
					$last_guy_details=$usrDetail['CaseUser'];
					$secondlast_guy_details=$CaseUsers[$key-1]['CaseUser'];

					$your_reference=$secondlast_guy_details['user_reference'];
					$report_date=$last_guy_details['report_date'];
					$our_reference=$case_dump['CaseMaster']['case_id'];;

				}
				if (($logged_user_group_id == Configure::read('AgentSuperUser')) && ($user_id==$this->logged_in_user_id)) {

                                        $last_guy_details=$usrDetail['CaseUser'];
					$secondlast_guy_details=$CaseUsers[$key-1]['CaseUser'];

					if($case_handler_type=="agency")
						$your_reference=$secondlast_guy_details['user_reference'];
					else
						$your_reference=$case_dump['CaseMaster']['case_id'];


					$report_date=$secondlast_guy_details['report_date'];
					$our_reference=$last_guy_details['user_reference'];
				}
			}

			//debug($our_reference);
			//echo $your_reference;


			if(!empty($our_reference)){
				$our_reference_text = 'Our Reference: '.$our_reference;
			}

			if(!empty($your_reference)){
				$your_reference_text = 'Your Reference: '.$your_reference;
			}

			//debug($case_dump);

			$appointment_date_text = '';

                        $appointment_venue_text = '';

                        if($case_master_id!=""){

                        $appointment_id =  $case_dump['CaseMaster']['appointment_id'];

                        $case_appointment_details = $this->Appointment->find('first', array('recursive' => -1, 'conditions' => array('id' => $appointment_id, 'dna_status' => 0, 'status_id' => 10)));

                        }


			if(!empty($case_appointment_details['Appointment']['slot_date']) && $case_appointment_details['Appointment']['status_id']!='17'){

                        $app_date_time=date("d/m/Y",strtotime($case_appointment_details['Appointment']['slot_date'])).' @ '.date('H:i ',strtotime($case_appointment_details['Appointment']['slot_start_time']));
			$appointment_date_text = '<tr>
    			<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; "><strong>Appointment Date</strong></td>
    			<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; ">'.$app_date_time.'</td>
  				</tr>';

                        $slot_parent_id = $case_appointment_details['Appointment']['slot_parent_id'];

                        $slot_parent_details = $this->SlotParent->find('first', array('recursive' => -1, 'conditions' => array('SlotParent.id' => $slot_parent_id)));

                        $venue_id = $slot_parent_details['SlotParent']['consulting_venue_id'];



                        $venue_details = $this->ConsultingVenue->find('first', array('recursive' => -2, 'conditions' => array('ConsultingVenue.id' => $venue_id)));


                        $venue_address = '';
                        if(isset($venue_details['ConsultingVenue']['name']) && $venue_details['ConsultingVenue']['name'] !=""){
				$venue_address =$venue_details['ConsultingVenue']['name'];
			}

			if(isset($venue_details['Address']['address1']) && $venue_details['Address']['address1'] !=""){
				$venue_address =$venue_details['Address']['address1'];
			}
			if(isset($venue_details['Address']['address2']) && $venue_details['Address']['address2'] !=""){
				$venue_address .="<br>".$venue_details['Address']['address2'];
			}
			if(isset($venue_details['Address']['address3']) && $venue_details['Address']['address3'] !=""){
				$venue_address .="<br>".$venue_details['Address']['address3'];
			}

			if(isset($venue_details['Address']['town']) && $venue_details['Address']['town'] !=""){
				$venue_address .="<br>".$venue_details['Address']['town'];
			}
			if(isset($venue_details['Address']['county']) && $venue_details['Address']['county'] !=""){
				$venue_address .="<br>".$venue_details['Address']['county'];
			}
			if(isset($venue_details['Address']['postcode']) && $venue_details['Address']['postcode'] !=""){
				$venue_address .="<br>".$venue_details['Address']['postcode'];
			}

                        if(!empty($venue_address)){
                            $appointment_venue_text = '<tr>
                            <td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;"><strong>Clinic Address</strong></td>
                            <td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;">'.$venue_address.'</td>
                            </tr>';
			}

			}

			//debug($case_dump);


                        if($case_dump['CaseClaimantDetail']['title']!='' || $case_dump['CaseClaimantDetail']['title']!='NULL'){
                            $case_dump['CaseClaimantDetail']['title'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['title']);
                        }
                        if($case_dump['CaseClaimantDetail']['forename']!='' || $case_dump['CaseClaimantDetail']['forename']!='NULL'){
                            $case_dump['CaseClaimantDetail']['forename'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['forename']);
                        }
                        if($case_dump['CaseClaimantDetail']['surname']!='' || $case_dump['CaseClaimantDetail']['surname']!='NULL'){
                            $case_dump['CaseClaimantDetail']['surname'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['surname']);
                        }

			$claim_name=$case_dump['CaseClaimantDetail']['title']." ".$case_dump['CaseClaimantDetail']['forename']." ".$case_dump['CaseClaimantDetail']['surname'];

			$claim_name_text='<tr>
			<td width="39%" align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;"><strong>Claimant Name</strong>  </td>
			<td width="61%" align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;">'.$claim_name.'</td>
			</tr>';

			$claim_dob = '';
			if (!empty($case_dump['CaseClaimantDetail']['dateofbirth']) && $case_dump['CaseClaimantDetail']['dateofbirth']!='NULL' && $case_dump['CaseClaimantDetail']['dateofbirth']!='0000-00-00') {
				$claim_dob=$this->Date->format($case_dump['CaseClaimantDetail']['dateofbirth']);
			}

                        $claimant_dob_text = '';

			if($claim_dob!=''){
			$claimant_dob_text = '<tr>
    				<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;"><strong>Date of Birth</strong></td>
    				<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;">'.$claim_dob.'</td>
  					</tr>';

			}
			$claimant_detail = $case_dump['CaseClaimantDetail'];

			//debug($claimant_detail);

                        if($claimant_detail['Address']['address1']!='' || $claimant_detail['Address']['address1']!='NULL'){
                            $claimant_detail['Address']['address1'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['address1']);
                        }
                        if($claimant_detail['Address']['address2']!='' || $claimant_detail['Address']['address2']!='NULL'){
                            $claimant_detail['Address']['address2'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['address2']);
                        }
                        if($claimant_detail['Address']['address3']!='' || $claimant_detail['Address']['address3']!='NULL'){
                            $claimant_detail['Address']['address3'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['address3']);
                        }
                        if($claimant_detail['Address']['address4']!='' || $claimant_detail['Address']['address5']!='NULL'){
                            $claimant_detail['Address']['address4'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['address5']);
                        }
                        if($claimant_detail['Address']['address5']!='' || $claimant_detail['Address']['address5']!='NULL'){
                            $claimant_detail['Address']['address5'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['address5']);
                        }
                        if($claimant_detail['Address']['town']!='' || $claimant_detail['Address']['town']!='NULL'){
                            $claimant_detail['Address']['town'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['town']);
                        }
                        if($claimant_detail['Address']['county']!='' || $claimant_detail['Address']['county']!='NULL'){
                            $claimant_detail['Address']['county'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['county']);
                        }
                        if($claimant_detail['Address']['postcode']!='' || $claimant_detail['Address']['postcode']!='NULL'){
                            $claimant_detail['Address']['postcode'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['postcode']);
                        }

			$claimant_address = '';
			if(isset($claimant_detail['Address']['address1']) && $claimant_detail['Address']['address1'] !=""){
				$claimant_address =$claimant_detail['Address']['address1'];
			}
			if(isset($claimant_detail['Address']['address2']) && $claimant_detail['Address']['address2'] !=""){
				$claimant_address .="<br>".$claimant_detail['Address']['address2'];
			}
			if(isset($claimant_detail['Address']['address3']) && $claimant_detail['Address']['address3'] !=""){
				$claimant_address .="<br>".$claimant_detail['Address']['address3'];
			}
			if(isset($claimant_detail['Address']['address4']) && $claimant_detail['Address']['address4'] !=""){
				$claimant_address .="<br>".$claimant_detail['Address']['address4'];
			}
			if(isset($claimant_detail['Address']['address5']) && $claimant_detail['Address']['address5'] !=""){
				$claimant_address .="<br>".$claimant_detail['Address']['address5'];
			}
			if(isset($claimant_detail['Address']['town']) && $claimant_detail['Address']['town'] !=""){
				$claimant_address .="<br>".$claimant_detail['Address']['town'];
			}
			if(isset($claimant_detail['Address']['county']) && $claimant_detail['Address']['county'] !=""){
				$claimant_address .="<br>".$claimant_detail['Address']['county'];
			}
			if(isset($claimant_detail['Address']['postcode']) && $claimant_detail['Address']['postcode'] !=""){
				$claimant_address .="<br>".$claimant_detail['Address']['postcode'];
			}




			if($case_handler_type=="claimant"){
				$toaddress_header = $claim_name.'<br/>'.$claimant_address;
				//$our_reference_text = '';
				$your_reference_text = '';
			}

			if(!empty($claimant_address)){
			$claimant_address_text = '<tr>
			<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;"><strong>Address</strong></td>
			<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000;">'.$claimant_address.'</td>
			</tr>';
			}
			//debug($case_dump);

			$accident_date = '';
			if (!empty($case_dump['CaseAccidentDetail'][0]['accident_date']) && $case_dump['CaseAccidentDetail'][0]['accident_date']!='NULL' && $case_dump['CaseAccidentDetail'][0]['accident_date']!='0000-00-00') {
				$accident_date=date('d/m/Y',strtotime($case_dump['CaseAccidentDetail'][0]['accident_date']));
			}
			$accident_date_text= '';
			if($accident_date!=""){

			$accident_date_text = '<tr>
			<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; "><strong>Accident Date</strong></td>
			<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; ">'.$accident_date.'</td>
			</tr>';
			}

			$report_date_text = '';

			if(!empty($report_date)){
				$report_date=date('d/m/Y',strtotime($report_date));

				$report_date_text = '<tr>
				<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; "><strong>Report Date</strong></td>
				<td align="left" valign="top" style="font:14px Cambria, Arial, Helvetica, sans-serif; color:#000; ">'.$report_date.'</td>
				</tr>';

			}

		}

		$claimant_det_text ='';

		if(!empty($claim_name_text) || !empty($claimant_address_text) || !empty($claimant_dob_text) || !empty($accident_date_text)){
		$claimant_det_text = '<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #6d5049;">
		<tr>
		<td>

		<table width="100%" border="0" cellspacing="1" cellpadding="4" >'.
		$claim_name_text.
		$claimant_address_text.
		$claimant_dob_text.
		$accident_date_text.
		$appointment_date_text.
                $appointment_venue_text.
		$report_date_text.
		'</table>
		</td>
		</tr>
		</table>';
		}


		$myFile = Configure::read('coral_root_path')."/app/webroot/templates/create_letter_case_content.html";

		//$content = file_get_contents($myFile);

		$file_funs = file($myFile);
		foreach ($file_funs as $file_num => $file_fun) {
			//$file_fun = str_replace('$header_logo$', $header_logo, $file_fun);
			$file_fun = str_replace('$instructor_header$', $instruction_header, $file_fun);
			$file_fun = str_replace('$toaddress_header$', $toaddress_header, $file_fun);
			$file_fun = str_replace('$our_reference_text$', $our_reference_text, $file_fun);
			$file_fun = str_replace('$your_reference_text$', $your_reference_text, $file_fun);
			$file_fun = str_replace('$solicitor_reference_text$', $solicitor_reference_text, $file_fun);


			$file_fun = str_replace('$cur_date$', $cur_date, $file_fun);

			$file_fun = str_replace('$claimant_det_text$', $claimant_det_text, $file_fun);

			$file_fun = str_replace('$send_user_comp_name_text$', $send_user_comp_name_text, $file_fun);

			$file_fun = str_replace('$send_user_name$', $send_user_name, $file_fun);

			$file_fun = str_replace('$template_content$', $template_content, $file_fun);

			$file_fun = str_replace('$contact_details$', $contact_details, $file_fun);



			$content.= $file_fun;
		}

                $letter_subject = '';
                $template_file_name = '';
		if($case_master_id!="" && $template_name!=""){

                    $template_file_name = $claim_name.'-'.$template_name;
                    $letter_subject = $claim_name.' , '.$template_name;

                    if($your_reference!=""){
                         $letter_subject = $claim_name.' , Your Ref :'.$your_reference.' , '.$template_name;
                    }
                }
                else if($case_master_id!="" && $template_name==""){
                    $template_file_name = $claim_name;
                    $letter_subject = $claim_name;
                    if($your_reference!=""){
                         $letter_subject = $claim_name.' , Your Ref :'.$your_reference;
                    }
                }

		$finalArray['content'] = $content;
                $finalArray['letter_subject'] = $letter_subject;
		$finalArray['template_file_name'] = $template_file_name;

		$_SESSION['letter_content'] = $content;


		echo json_encode($finalArray);

		exit;


	}
	
	/**
	 * updated by vajesh starts(24-Jan-2018, 08-Feb-2018 )
	 *
	 * */	
	function ajax_instruction_letter($id = null, $print_option = null){
		$this->layout 					= 'ajax';
		$shadow_close 					= 'false';
		$case_master 					= $this->EncryptionFunctions->deCrypt($id);
		$letterId						= 0;
		
		$this->set('print_option',$print_option);
		$this->set('shadow_close',$shadow_close);
		//updated by vajesh starts(05-02-2018)
		$joins							= array();
		$joins[]						= array(
										'table'=>'users',
										'alias'=>'User',
										'type'=>'LEFT',
										'conditions'=>array('CaseMaster.preferred_expert_id=User.id'),
										);
	 	$case_details	 				= $this->CaseMaster->find('first',array('fields'=>array('CaseMaster.id,CaseMaster.case_id,CaseMaster.special_instruction,User.id,User.email,User.title,User.forename,User.surname'),'conditions'=>array('CaseMaster.id'=>$case_master),'joins'=>$joins,'recursive'=>-1));
		$join							= array();
		$join[]							= array(
										'table'=>'users',
										'alias'=>'UserA',
										'type'=>'LEFT',
										'conditions'=>array('Appointment.expert_id=UserA.id'),
										);
		$appt_details					= $this->Appointment->find('first',array('fields'=>array('Appointment.expert_id,UserA.id,UserA.email,UserA.title,UserA.forename,UserA.surname'),'conditions'=>array('Appointment.case_id'=>$case_details['CaseMaster']['case_id'],'Appointment.status_id'=>Configure::read('status_Booked')),'joins'=>$join,'recursive'=>-1));
		$case_details['Appointment']	= $appt_details['Appointment'];
		$case_details['UserA']			= $appt_details['UserA'];
		//updated by vajesh ends(05-02-2018)
		$_SESSION['instruction_email']	= 0;
		$_SESSION['general_letter_id']	= 0;
		//$this->set('shadow_close',$shadow_close);
		if(count($case_details)>0){
			
			if($case_details['Appointment']['expert_id']){
				$case_handler 					= $case_details['Appointment']['expert_id']."_expert_".$case_details['UserA']['email'];
			}else{
				$case_handler 					= $case_details['User']['id']."_expert_".$case_details['User']['email'];
			}
			$this->set('case_handler_id',$case_handler);
			$this->set('case_details',$case_details);
		}
		
		$edit													= 0;
		if(!empty($this->data)){
			//debug($this->data);
			$edited_letter_id 									= 0;
			$save_details										= array();
			$save_details['id']									= 0;
			$save_details['preselected_case_master_id'] 		= $case_master;
			$save_details['description'] 						= $this->data['User']['descp'];
			$date 												= date("Y-m-d : H:i:s", time());
			$save_details['created'] 							= $date;
			$save_details['modified'] 							= '';
			$save_details['template_id'] 						= 13;
			
			if(!empty($this->data['User']['FileName'])){
				$order   										= array(" ");
				$replace 										= '_';
				$file_name 										= str_replace($order, $replace,$this->data['User']['FileName']);
				$curent_date_file_name 							= date('d-m-Y');
				$save_details['file_name'] 						= $file_name.'_'.$curent_date_file_name.'_'.time();
			}
			$save_details['created_by']				 			= $_SESSION['Auth']['User']['id'];
			if($edit == 0){
				$save_details['created'] 						= $date;
				$save_details['modified'] 						= '';
			}else{
				$save_details['modified'] 						= $date;
			}
			
			$save_details['case_id']							= $case_master;
			$save_details['title']								= $this->data['User']['Title'];
			$save_details['to_user_type']						= 'expert';
			if($case_details['Appointment']['expert_id']){
				$save_details['to_user_id']						= $case_details['UserA']['id'];
				$save_details['to_user_email_id']				= $case_details['UserA']['email'];
			}else{
				$save_details['to_user_id']						= $case_details['User']['id'];
				$save_details['to_user_email_id']				= $case_details['User']['email'];
			}
			if($this->data['User']['email'] == 1 ){
				$save_details['email_count']					= 1;
			}else{
				$save_details['email_count']					= 0;
			}
			$case_master_id										= $case_master;
			
			if($this->GeneralLetter->save($save_details)){
				$shadow_close						= true;
				$general_letter_id 					= $this->GeneralLetter->getLastInsertID();
				$checkFolderExits		 			= WWW_ROOT."uploads";
				if (!file_exists($checkFolderExits)) {
					mkdir($checkFolderExits, 0777);
				}
				$host_path	= '';
				if($case_master == 0 || empty($case_master)) {
					$checkFolderExits = WWW_ROOT."uploads/expert/";
					if (!file_exists($checkFolderExits)) {
						mkdir($checkFolderExits, 0777);
					}

					$checkFolderExits = WWW_ROOT."uploads/expert/".$this->LinUid;
					if (!file_exists($checkFolderExits)) {
						mkdir($checkFolderExits, 0777);
					}

					$checkFolderExits = WWW_ROOT."uploads/expert/".$this->LinUid."/GenericLetters";
					if (!file_exists($checkFolderExits)) {
						mkdir($checkFolderExits, 0777);
					}

					$folderPath = WWW_ROOT."uploads/expert/".$this->LinUid."/GenericLetters/";
					$host_path	= "uploads/expert/".$this->LinUid."/GenericLetters/";
					$type = 1;

				}else{

					$caseMasterId 			= $case_master_id;
					$case_folder_array 		= $this->CommonFunctions->make_case_folder($caseMasterId);
					$case_directory 		= $case_folder_array['case_directory_value'];
					$checkFolderExits 		= WWW_ROOT.$case_directory."/GenericLetters";
					//echo $checkFolderExits;
					
					if (! is_dir($checkFolderExits)) {
						 mkdir($checkFolderExits,0777,true);
					}

					$folderPath = WWW_ROOT.$case_directory."/GenericLetters/";
					$host_path	= "uploads/expert/".$this->LinUid."/GenericLetters/";
					$type = 2;
					//\uploads\case_files\2017\11\86783\GenericLetters
					$fileName = $save_details['file_name'];

					$file_name_value = $fileName;
					$file_name_array = explode('_',$file_name_value);
					array_pop($file_name_array);
					$file_name_new_value = implode('_',$file_name_array);

					$to_user_name = $this->get_touser_name($general_letter_id);

					if(!empty($to_user_name)){
						$comment=$file_name_new_value.'('.$to_user_name.')';
					}else{
						$comment=$file_name_new_value;
					}

					if($letterId>0){
						$this->make_case_log_entry($case_master_id, 74,$comment);
					}else{
						$this->make_case_log_entry($case_master_id, 73,$comment);
					}

				}
				
		 		$pdf_created 			= false;
				$path 					= $folderPath;
				$fileName 				= $save_details['file_name'];
				$print_html_file_name 	= $folderPath.$fileName.".html";
				$printContent 			= '<style type="text/css">@page {@bottom-right {margin-bottom:40px;font-size:10px;content: "Page " counter(page) " of " counter(pages);}}	</style>'.$this->data['User']['descp'];
				$print_file = fopen($print_html_file_name, 'wb') or die("can't open file");
				fwrite($print_file, $printContent);
				fclose($print_file);


				$printed_by_text=ucfirst(trim($_SESSION['Auth']['User']['title'].' '.$_SESSION['Auth']['User']['forename'].' '.$_SESSION['Auth']['User']['middlename'].' '.$_SESSION['Auth']['User']['surname'])) .'  @  '.date('H:i:s') .', '.date('l jS F Y');

				App::import('Component','LetterPdf');	
				$Pdf = new LetterPdfComponent();
				// Invoice name (output name)
				$Pdf->filename = $fileName; // Without .pdf
				// You can use download, file or browser here
				$Pdf->output = 'file';
				
				$logo ='';

				$stringHeader ='';

			/*
				$Pdf->headerhtml = '<div align="left" style=""> </div>';

				$Pdf->footerhtml = '<div align="left" style=""> </div>';
			*/

				$Pdf->init($path);
				
				$Pdf->media->set_landscape(false);
				$Pdf->media->set_margins(array('left'   => 0, 

                              'right'  => 10, 

                              'top'    => 20, 

                              'bottom' => 20));
				
				Configure::write('pdf_html_link', $print_html_file_name);
				
				$Pdf->process(Router::url('/', true) . 'build_letters/download_pdf_view/'.$fileName.'/803/'.$type.'/'.$caseMasterId);
				
				$pdf_created = true;
				$_SESSION['general_letter_id'] = $general_letter_id;
				$email			= $this->data['User']['email'];
				
				if(isset($_SESSION['instruct_expert'])){
					unset($_SESSION['instruct_expert']);
				}
				if($email == '1'){
					$_SESSION['instruction_email']		= 1;
				}else{
					$this->Session->setFlash("Instruction letter created successfully.",'default', array('class' => 'message success'));		
				}
			}
		}
		
		
		$this->set('print_option',$print_option);
		$this->set('shadow_close',$shadow_close);
	}	 
	
	function cancel_instruction_letter($id = null){
		$this->layout 					= 'ajax';
		$shadow_close 					= 'false';
		$case_master_id 				= $this->EncryptionFunctions->deCrypt($id);
		$letterId						= 0;
		$join							= array();
		$join[]							= array(
										'table'=>'users',
										'alias'=>'User',	
										'type'=>'LEFT',
										'conditions'=>array('GeneralLetter.to_user_id =User.id'),
										);
		$letter                         = $this->GeneralLetter->find('all',array('fields'=>array('GeneralLetter.id,GeneralLetter.case_id,User.id,User.title,User.forename,User.surname'),'conditions'=>array('GeneralLetter.case_id'=>$case_master_id,'GeneralLetter.file_name LIKE'=>'%-Instruction_Letter%','GeneralLetter.to_user_id IS NOT NULL' ),'joins'=>$join,'recursive'=>-1));    
		/*debug($letter);
		exit;
		*/
		$sender_details					= array();
		
		foreach($letter as $ltr_key => $ltr_val){
			$sender_details[$ltr_val['User']['id']] 	= ucfirst($ltr_val['User']['title'].' '.$ltr_val['User']['forename'].' '. $ltr_val['User']['surname']);
		} 
		$this->set('sender_details',$sender_details);
		$this->set('letter',$letter);
		
		//echo $content;
		$edit	=0;
		if(!empty($this->data)){
			$edited_letter_id 									= 0;
			$save_details										= array();
			$save_details['id']									= 0;
			$save_details['preselected_case_master_id'] 		= $case_master_id;
			$save_details['description'] 						= $this->data['User']['descp'];
			$date 												= date("Y-m-d : H:i:s", time());
			$save_details['created'] 							= $date;
			$save_details['modified'] 							= '';
			$save_details['template_id'] 						= 13;
			
			if(!empty($this->data['User']['FileName'])){
				$order   										= array(" ");
				$replace 										= '_';
				$file_name 										= str_replace($order, $replace,$this->data['User']['FileName']);
				$curent_date_file_name 							= date('d-m-Y');
				$save_details['file_name'] 						= $file_name.'_'.$curent_date_file_name.'_'.time();
			}
			$save_details['created_by']				 			= $_SESSION['Auth']['User']['id'];
			if($edit == 0){
				$save_details['created'] 						= $date;
				$save_details['modified'] 						= '';
			}else{
				$save_details['modified'] 						= $date;
			}
			
			$save_details['case_id']							= $case_master_id;
			$save_details['title']								= $this->data['User']['Title'];
			$save_details['to_user_type']						= 'expert';
			$save_details['to_user_id']							= $this->data['User']['ToUserId'];
			$save_details['to_user_email_id']					= $this->data['User']['ToUserEmail'];
			//$case_master_id										= $case_master_id;
			
			if($this->GeneralLetter->save($save_details)){
				$shadow_close						= true;
				$general_letter_id 					= $this->GeneralLetter->getLastInsertID();
				$checkFolderExits		 			= WWW_ROOT."uploads";
				if (!file_exists($checkFolderExits)) {
					mkdir($checkFolderExits, 0777);
				}
				if($case_master_id == 0 || empty($case_master_id)) {
					$checkFolderExits = WWW_ROOT."uploads/expert/";
					if (!file_exists($checkFolderExits)) {
						mkdir($checkFolderExits, 0777);
					}

					$checkFolderExits = WWW_ROOT."uploads/expert/".$this->LinUid;
					if (!file_exists($checkFolderExits)) {
						mkdir($checkFolderExits, 0777);
					}

					$checkFolderExits = WWW_ROOT."uploads/expert/".$this->LinUid."/GenericLetters";
					if (!file_exists($checkFolderExits)) {
						mkdir($checkFolderExits, 0777);
					}

					$folderPath = WWW_ROOT."uploads/expert/".$this->LinUid."/GenericLetters/";

					$type = 1;

				}else{

					$caseMasterId 			= $case_master_id;
					$case_folder_array 		= $this->CommonFunctions->make_case_folder($caseMasterId);
					$case_directory 		= $case_folder_array['case_directory_value'];
					$checkFolderExits 		= WWW_ROOT.$case_directory."/GenericLetters";
					//echo $checkFolderExits;
					
					if (! is_dir($checkFolderExits)) {
						 mkdir($checkFolderExits,0777,true);
					}

					$folderPath = WWW_ROOT.$case_directory."/GenericLetters/";
					$type = 2;

					$fileName = $save_details['file_name'];

					$file_name_value = $fileName;
					$file_name_array = explode('_',$file_name_value);
					array_pop($file_name_array);
					$file_name_new_value = implode('_',$file_name_array);

					$to_user_name = $this->get_touser_name($general_letter_id);

					if(!empty($to_user_name)){
						$comment=$file_name_new_value.'('.$to_user_name.')';
					}else{
						$comment=$file_name_new_value;
					}

					if($letterId>0){
						$this->make_case_log_entry($case_master_id, 74,$comment);
					}else{
						$this->make_case_log_entry($case_master_id, 73,$comment);
					}

				}
				
				$pdf_created 			= false;
				$path 					= $folderPath;
				$fileName 				= $save_details['file_name'];
				$print_html_file_name 	= $folderPath.$fileName.".html";
				$printContent 			= '<style type="text/css">@page {@bottom-right {margin-bottom:40px;font-size:10px;content: "Page " counter(page) " of " counter(pages);}}	</style>'.$this->data['User']['descp'];
				$print_file = fopen($print_html_file_name, 'wb') or die("can't open file");
				fwrite($print_file, $printContent);
				fclose($print_file);


				$printed_by_text=ucfirst(trim($_SESSION['Auth']['User']['title'].' '.$_SESSION['Auth']['User']['forename'].' '.$_SESSION['Auth']['User']['middlename'].' '.$_SESSION['Auth']['User']['surname'])) .'  @  '.date('H:i:s') .', '.date('l jS F Y');

				App::import('Component','LetterPdf');	
				$Pdf = new LetterPdfComponent();
				// Invoice name (output name)
				$Pdf->filename = $fileName; // Without .pdf
				// You can use download, file or browser here
				$Pdf->output = 'file';
				
				$logo ='';

				$stringHeader ='';

			/*
				$Pdf->headerhtml = '<div align="left" style=""> </div>';

				$Pdf->footerhtml = '<div align="left" style=""> </div>';
			*/

				$Pdf->init($path);
				
				$Pdf->media->set_landscape(false);
				$Pdf->media->set_margins(array('left'   => 0, 

                              'right'  => 10, 

                              'top'    => 20, 

                              'bottom' => 20));
				
				Configure::write('pdf_html_link', $print_html_file_name);
				
				$Pdf->process(Router::url('/', true) . 'build_letters/download_pdf_view/'.$fileName.'/803/'.$type.'/'.$case_master_id);
				
				$pdf_created = true;
				$_SESSION['general_letter_id'] = $general_letter_id;
				$email			= $this->data['User']['email'];
				if($email == '1'){
					$_SESSION['cancel_instruction_email']		= 1;
				}else{
					$this->Session->setFlash("Cancel Instruction letter created successfully.",'default', array('class' => 'message success'));		
				}
			}
		}
		
		$this->set('shadow_close',$shadow_close);
	}
	
	
	function ajax_cancel_letter(){
		
		$case_master_id					= $_POST['case_master_id'];
		
		$to_user_id						= $_POST['user_id'];
		$to_user_company_id 			= $_POST['user_id'];
		$to_user_id_address				= $_POST['user_id'];
		
		$logged_user_group_id 			= $this->logged_user_group_id;
		$user_arr 						= $this->user_details;

		$user_arr 						= $this->User->find('first', array('conditions' => array('User.id' => $this->Session->read('Auth.User.id')),'recursive' => 2));
		$case_dump						= $this->CaseMaster->find('first', array('conditions' => array('CaseMaster.id' => $case_master_id), 'recursive' => 2));
		$your_reference_text			= '';
		
		//$this->GeneralLetter->find('all',array('fields'=>array('GeneralLetter.description,GeneralLetter.'),'conditions'=>array('GeneralLetter.case_id'=>$case_master_id)));
		
		//debug($case_dump);
		
		$_SESSION['instruction_email']	= 0;
		$_SESSION['general_letter_id']	= 0;
		$case_handler_type				= '';
		$communicatio_arr 				= $this->Communication->find('first', array('recursive' => -1, 'conditions' => array('Communication.user_id' => $this->Session->read('Auth.User.id'))));
				
		$contact_details = '';
		$contact_email ='';
		$contact_phone = '';

		if(!empty($communicatio_arr['Communication']['appointment_email'])){
			$contact_email = $communicatio_arr['Communication']['appointment_email'];
		}

		if(!empty($user_arr['User']['email']) && empty($contact_email)){
			$contact_email =$user_arr['User']['email'];
		}

		if(!empty($user_arr['User']['work_telephone'])) {
			$contact_phone = $user_arr['User']['work_telephone'];
		} else if (!empty($user_arr['User']['home_telephone'])) {
			$contact_phone = $user_arr['User']['home_telephone'];
		} else if (!empty($rec_user['User']['mobile'])) {
			$contact_phone = $user_arr['User']['mobile'];
		}

		if(!empty($contact_phone)){
			$contact_details = 'Tel : '.$contact_phone.'<br/>';
		}
		$contact_details .= 'Email : '.$contact_email;


		$solicitor_reference_text = '';

		$cur_date=date('d-m-Y');

		//debug($case_dump);


		if($case_dump['CaseClaimantDetail']['title']!='' || $case_dump['CaseClaimantDetail']['title']!='NULL'){
			$case_dump['CaseClaimantDetail']['title'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['title']);
		}
		if($case_dump['CaseClaimantDetail']['forename']!='' || $case_dump['CaseClaimantDetail']['forename']!='NULL'){
			$case_dump['CaseClaimantDetail']['forename'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['forename']);
		}
		if($case_dump['CaseClaimantDetail']['surname']!='' || $case_dump['CaseClaimantDetail']['surname']!='NULL'){
			$case_dump['CaseClaimantDetail']['surname'] = $this->EncryptionFunctions->aes_decrypt($case_dump['CaseClaimantDetail']['surname']);
		}

		$claim_name  = $case_dump['CaseClaimantDetail']['title']." ".$case_dump['CaseClaimantDetail']['forename']." ".$case_dump['CaseClaimantDetail']['surname'];
		
		$claim_name_text='<tr>
		<td align="left" valign="top" style="font:16px Arial; color:#000;"><strong>Claimant Name</strong>  </td>
		<td align="left" valign="top" style="font:16px Arial; color:#000;">'.$claim_name.'</td>
		';

		$claim_dob = '';
		if (!empty($case_dump['CaseClaimantDetail']['dateofbirth']) && $case_dump['CaseClaimantDetail']['dateofbirth']!='NULL' && $case_dump['CaseClaimantDetail']['dateofbirth']!='0000-00-00') {
			$claim_dob=$this->Date->format($case_dump['CaseClaimantDetail']['dateofbirth']);
		}

					$claimant_dob_text = '';

		if($claim_dob!=''){
			$claimant_dob_text = '<tr>
								<td align="left" valign="top" style="font:16px Arial; color:#000;"><strong>Date of Birth</strong></td>
								<td align="left" valign="top" style="font:16px Arial; color:#000;">'.$claim_dob.'</td>
								';

		}
		
		$claimant_detail = $case_dump['CaseClaimantDetail'];

		//debug($claimant_detail);

		if($claimant_detail['Address']['address1']!='' || $claimant_detail['Address']['address1']!='NULL'){
			$claimant_detail['Address']['address1'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['address1']);
		}
		if($claimant_detail['Address']['address2']!='' || $claimant_detail['Address']['address2']!='NULL'){
			$claimant_detail['Address']['address2'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['address2']);
		}
		if($claimant_detail['Address']['address3']!='' || $claimant_detail['Address']['address3']!='NULL'){
			$claimant_detail['Address']['address3'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['address3']);
		}
		if($claimant_detail['Address']['address4']!='' || $claimant_detail['Address']['address5']!='NULL'){
			$claimant_detail['Address']['address4'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['address5']);
		}
		if($claimant_detail['Address']['address5']!='' || $claimant_detail['Address']['address5']!='NULL'){
			$claimant_detail['Address']['address5'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['address5']);
		}
		if($claimant_detail['Address']['town']!='' || $claimant_detail['Address']['town']!='NULL'){
			$claimant_detail['Address']['town'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['town']);
		}
		if($claimant_detail['Address']['county']!='' || $claimant_detail['Address']['county']!='NULL'){
			$claimant_detail['Address']['county'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['county']);
		}
		if($claimant_detail['Address']['postcode']!='' || $claimant_detail['Address']['postcode']!='NULL'){
			$claimant_detail['Address']['postcode'] = $this->EncryptionFunctions->aes_decrypt($claimant_detail['Address']['postcode']);
		}

		$claimant_address = '';
		if(isset($claimant_detail['Address']['address1']) && $claimant_detail['Address']['address1'] !=""){
			$claimant_address =$claimant_detail['Address']['address1'];
		}
		if(isset($claimant_detail['Address']['address2']) && $claimant_detail['Address']['address2'] !=""){
			$claimant_address .="<br>".$claimant_detail['Address']['address2'];
		}
		if(isset($claimant_detail['Address']['address3']) && $claimant_detail['Address']['address3'] !=""){
			$claimant_address .="<br>".$claimant_detail['Address']['address3'];
		}
		if(isset($claimant_detail['Address']['address4']) && $claimant_detail['Address']['address4'] !=""){
			$claimant_address .="<br>".$claimant_detail['Address']['address4'];
		}
		if(isset($claimant_detail['Address']['address5']) && $claimant_detail['Address']['address5'] !=""){
			$claimant_address .="<br>".$claimant_detail['Address']['address5'];
		}
		if(isset($claimant_detail['Address']['town']) && $claimant_detail['Address']['town'] !=""){
			$claimant_address .="<br>".$claimant_detail['Address']['town'];
		}
		if(isset($claimant_detail['Address']['county']) && $claimant_detail['Address']['county'] !=""){
			$claimant_address .="<br>".$claimant_detail['Address']['county'];
		}
		if(isset($claimant_detail['Address']['postcode']) && $claimant_detail['Address']['postcode'] !=""){
			$claimant_address .="<br>".$claimant_detail['Address']['postcode'];
		}
		
		if(!empty($claimant_address)){
			$claimant_address_text = '
			<td align="left" valign="top" style="font:16px Arial; color:#000;"><strong>Address</strong></td>
			<td align="left" valign="top" style="font:16px Arial; color:#000;">'.$claimant_address.'</td>
			</tr>';
		}

		$accident_date = '';
		if (!empty($case_dump['CaseAccidentDetail'][0]['accident_date']) && $case_dump['CaseAccidentDetail'][0]['accident_date']!='NULL' && $case_dump['CaseAccidentDetail'][0]['accident_date']!='0000-00-00') {
			$accident_date=date('d/m/Y',strtotime($case_dump['CaseAccidentDetail'][0]['accident_date']));
		}
		$accident_date_text= '';
		if($accident_date!=""){
			$accident_date_text = '<!-- <tr> -->
								<td align="left" valign="top" style="font:16px Arial; color:#000; "><strong>Accident Date</strong></td>
								<td align="left" valign="top" style="font:16px Arial; color:#000; ">'.$accident_date.'</td>
								</tr>';
		}	
		
		$SpecficCvId					= '';
		if (!empty($case_master_id)) {

			$toaddress_name ='';
			if(!empty($to_user_id))
			$toUserDet 					= $this->User->find('first', array('conditions' => array('User.id' => $to_user_id), 'recursive' => 2));

			//debug($toUserDet);
			//Added By mskt
			if($SpecficCvId){
				$SpecficExpertName		= ucfirst($toUserDet['User']['title'])." " .$toUserDet['User']['forename']." " .$toUserDet['User']['middlename']." " .$toUserDet['User']['surname'];
			}


			if(!empty($toUserDet)){
				if(!empty($to_user_company_id))
				$toUserCompanyDet 		= $this->User->find('first', array('conditions' => array('User.id' => $to_user_company_id), 'recursive' => 2));
				$touser_company_name=$toUserCompanyDet['Company']['name'];
				if(!empty($touser_company_name)){
					$toaddress_name 	= ucfirst($toUserDet['User']['title'])." " .$toUserDet['User']['forename']." " .$toUserDet['User']['middlename']." " .$toUserDet['User']['surname']."<br/>";
					$toaddress_name .=$touser_company_name;
					$toaddress_nam		= $toUserDet['User']['forename']." " .$toUserDet['User']['middlename']." " .$toUserDet['User']['surname'];	
				}else{
					$toaddress_name 	= ucfirst($toUserDet['User']['title'])." " .$toUserDet['User']['forename']." " .$toUserDet['User']['middlename']." " .$toUserDet['User']['surname'];
				}
			}else{
				if(!empty($to_user_company_id)){
					$toUserCompanyDet 	= $this->User->find('first', array('conditions' => array('User.id' => $to_user_company_id), 'recursive' => 2));
					$toaddress_name=$toUserCompanyDet['Company']['name'];
				}

			}
			if(!empty($to_user_id_address))
				$toAddress 				= $this->Address->find('first', array('conditions' => array('Address.user_id' => $to_user_id_address,'address_type'=>'billing'), 'recursive' => -1));
			if(empty($toAddress)){
				$toAddress 				= $this->Address->find('first', array('conditions' => array('Address.user_id' => $to_user_id_address), 'recursive' => -1));
			}

			if(!empty($toAddress)){
				if(!empty($toaddress_name))
					$toaddress_header	= $toaddress_name ."<br>".$toAddress['Address']['address1'];
				else
					$toaddress_header	= $toAddress['Address']['address1'];

			if(isset($toAddress['Address']['address2']) && $toAddress['Address']['address2'] !=""){
				$toaddress_header .="<br>".$toAddress['Address']['address2'];
			}
			if(isset($toAddress['Address']['address3']) && $toAddress['Address']['address3'] !=""){
				$toaddress_header .="<br>".$toAddress['Address']['address3'];
			}
			if(isset($toAddress['Address']['address4']) && $toAddress['Address']['address4'] !=""){
				$toaddress_header .="<br>".$toAddress['Address']['address4'];
			}
			if(isset($toAddress['Address']['address5']) && $toAddress['Address']['address5'] !=""){
				$toaddress_header .="<br>".$toAddress['Address']['address5'];
			}
			if(isset($toAddress['Address']['town']) && $toAddress['Address']['town'] !=""){
				$toaddress_header .="<br>".$toAddress['Address']['town'];
			}
			$toaddress_header .="<br>".$toAddress['Address']['postcode'];
			if(isset($instructor_company_arr['Address']['work_telephonec']) && $instructor_company_arr['Address']['work_telephonec'] !=""){
				$toaddress_header .="<br>".$instructor_company_arr['Address']['work_telephonec']." (W)";
			}
			if(isset($instructor_company_arr['Address']['mobile']) && $instructor_company_arr['Address']['mobile'] !=""){
				$toaddress_header .="<br>".$instructor_company_arr['Address']['mobile']." (M)";
			}

			}
			$our_reference			= $case_dump['CaseMaster']['case_id'];
			//$your_reference			= $case_dump['CaseMaster']['case_id'];	
		}
		
		
		if(!empty($our_reference)){
				$our_reference_text = 'Our Reference: '.$our_reference;
		}

		if(!empty($your_reference)){
			$your_reference_text 	= 'Your Reference: '.$your_reference;
		}
		$CaseUsers = $this->CaseUser->find('all', array('conditions' => array('CaseUser.case_master_id' => $case_master_id,'(CaseUser.additional_info IS NULL OR CaseUser.additional_info="")'), 'recursive' =>-1,'order' => array('CaseUser.id ASC')));

                        //echo '<pre>';
                        //print_r($CaseUsers);

			foreach($CaseUsers as $key=>$usrDetail ){
				$user_id=$usrDetail['CaseUser']['user_id'];
				if (($logged_user_group_id == Configure::read('ExpertSuperUser')) && ($user_id==$this->logged_in_user_id)) {
					$last_guy_details=$usrDetail['CaseUser'];
					$secondlast_guy_details=$CaseUsers[$key-1]['CaseUser'];

					$your_reference=$secondlast_guy_details['user_reference'];
					$report_date=$last_guy_details['report_date'];
					$our_reference=$case_dump['CaseMaster']['case_id'];;
					
					$medical_records = $case_dump['CaseUser'][$key-1]['FeesMaster']['name']; //Added By mskt
				}
				if (($logged_user_group_id == Configure::read('TherapistSuperUser')) && ($user_id==$this->logged_in_user_id)) {
					$last_guy_details=$usrDetail['CaseUser'];
					$secondlast_guy_details=$CaseUsers[$key-1]['CaseUser'];

					$your_reference=$secondlast_guy_details['user_reference'];
					$report_date=$last_guy_details['report_date'];
					$our_reference=$case_dump['CaseMaster']['case_id'];;
					
					$medical_records = $case_dump['CaseUser'][$key-1]['FeesMaster']['name']; //Added By mskt

				}
				if (($logged_user_group_id == Configure::read('AgentSuperUser')) && ($user_id==$this->logged_in_user_id)) {

                                        $last_guy_details=$usrDetail['CaseUser'];
					$secondlast_guy_details=$CaseUsers[$key-1]['CaseUser'];

					if($case_handler_type=="agency")
						$your_reference=$secondlast_guy_details['user_reference'];
					else
						$your_reference=$case_dump['CaseMaster']['case_id'];


					$report_date=$secondlast_guy_details['report_date'];
					$our_reference=$last_guy_details['user_reference'];
					
					$medical_records = $case_dump['CaseUser'][$key-1]['FeesMaster']['name']; //Added By mskt
				}
			}
		
			$report_date_text = '';

			if(!empty($report_date)){
				$report_date=date('d/m/Y',strtotime($report_date));

				$report_date_text = '<tr>
				<td align="left" valign="top" style="font:16px Arial; color:#000; "><strong>Report Date</strong></td>
				<td align="left" valign="top" style="font:16px Arial; color:#000; ">'.$report_date.'</td>
				</tr>';

			}
			//debug($case_dump);

			$appointment_date_text = '';

			$appointment_venue_text = '';

			if($case_master_id!=""){

			$appointment_id =  $case_dump['CaseMaster']['appointment_id'];

			$case_appointment_details = $this->Appointment->find('first', array('recursive' => -1, 'conditions' => array('id' => $appointment_id, 'dna_status' => 0, 'status_id' => 10)));

			}
			$instruction_qualification	 ='';

	 
		$instruction_comp_name="<strong>".$user_arr['Company']['name']."</strong>";
		//echo $instruction_comp_name; exit;
		if(empty($instruction_comp_name)){
			//Get the Qualification
			$instruction_qualification = "";
			if(!empty($user_arr['ExpertProfession']['Qualification'])){
				$i=0;
				foreach($user_arr['ExpertProfession']['Qualification'] as $value){
					if($i==0){
						$instruction_qualification = strtoupper($value['qualification']);
					}else{
						$instruction_qualification .= ", ".strtoupper($value['qualification']);
					}
					$i++;
				}
			}
			$instruction_comp_name = "<strong>".ucfirst($user_arr['User']['title'])." " .$user_arr['User']['forename']." " .$user_arr['User']['middlename']." " .$user_arr['User']['surname']." ".$instruction_qualification."</strong>";
		}
		
			if(!empty($case_appointment_details['Appointment']['slot_date']) && $case_appointment_details['Appointment']['status_id']!='17'){

				$app_date_time=date("d/m/Y",strtotime($case_appointment_details['Appointment']['slot_date'])).' @ '.date('H:i ',strtotime($case_appointment_details['Appointment']['slot_start_time']));
				$appointment_date_text = '<tr>
    			<td align="left" valign="top" style="font:16px Arial; color:#000; "><strong>Appointment Date</strong></td>
    			<td align="left" valign="top" style="font:16px Arial; color:#000; ">'.$app_date_time.'</td>
  				</tr>';

                        $slot_parent_id = $case_appointment_details['Appointment']['slot_parent_id'];

                        $slot_parent_details = $this->SlotParent->find('first', array('recursive' => -1, 'conditions' => array('SlotParent.id' => $slot_parent_id)));

                        $venue_id = $slot_parent_details['SlotParent']['consulting_venue_id'];



                        $venue_details = $this->ConsultingVenue->find('first', array('recursive' => -2, 'conditions' => array('ConsultingVenue.id' => $venue_id)));


                        $venue_address = '';
                        if(isset($venue_details['ConsultingVenue']['name']) && $venue_details['ConsultingVenue']['name'] !=""){
				$venue_address =$venue_details['ConsultingVenue']['name'];
			}

			if(isset($venue_details['Address']['address1']) && $venue_details['Address']['address1'] !=""){
				$venue_address =$venue_details['Address']['address1'];
			}
			if(isset($venue_details['Address']['address2']) && $venue_details['Address']['address2'] !=""){
				$venue_address .="<br>".$venue_details['Address']['address2'];
			}
			if(isset($venue_details['Address']['address3']) && $venue_details['Address']['address3'] !=""){
				$venue_address .="<br>".$venue_details['Address']['address3'];
			}

			if(isset($venue_details['Address']['town']) && $venue_details['Address']['town'] !=""){
				$venue_address .="<br>".$venue_details['Address']['town'];
			}
			if(isset($venue_details['Address']['county']) && $venue_details['Address']['county'] !=""){
				$venue_address .="<br>".$venue_details['Address']['county'];
			}
			if(isset($venue_details['Address']['postcode']) && $venue_details['Address']['postcode'] !=""){
				$venue_address .="<br>".$venue_details['Address']['postcode'];
			}

			if(!empty($venue_address)){
				$appointment_venue_text = '<tr>
				<td align="left" valign="top" style="font:16px Arial; color:#000;"><strong>Clinic Address</strong></td>
				<td align="left" valign="top" style="font:16px Arial; color:#000;">'.$venue_address.'</td>
				</tr>';
			}

			}
		
		$report_type_text = '';
		if(!empty($case_dump['CaseMaster']['report_master_id'])){
			$report_types_data = $this->ReportMaster->find('first',array('fields'=>array('id','value'),'conditions'=>array('ReportMaster.medico_legal'=>1, 'ReportMaster.id'=>$case_dump['CaseMaster']['report_master_id'])));
			
			if(count($report_types_data) > 0){
				$report_type_text = '<tr>
				<td align="left" valign="top" style="font:16px Arial; color:#000; "><strong>Report Type</strong></td>
				<td align="left" valign="top" style="font:16px Arial; color:#000; ">'.$report_types_data['ReportMaster']['value'].'</td>
				 ';
			}
		}
		$medical_records_text = '';
		if(!empty($medical_records)){
			$medical_records_text = '<tr>
			<td align="left" valign="top" style="font:16px Arial; color:#000; "><strong>Medical Records</strong></td>
			<td align="left" valign="top" style="font:16px Arial; color:#000; " colspan="3">'.$medical_records.'</td>
			</tr>';
		}
		$accident_type_text = '';
		if(!empty($case_dump['CaseAccidentDetail'][0]['accident_type'])){
			$accident_type_text = ' 
			<td align="left" valign="top" style="font:16px Arial; color:#000; "><strong>Accident Type</strong></td>
			<td align="left" valign="top" style="font:16px Arial; color:#000; ">'.$case_dump['CaseAccidentDetail'][0]['accident_type'].'</td>
			</tr>';
		}	
		
		$claimant_det_text 		= '';
		$template_name			= 'Cancel Instruction Letter - Expert'; 
		if($template_name){
			$template_name_data = '<div align="center" style="font:large Arial; color: #f70d0d; margin-top: -20px;  margin-bottom: 15px;cl"><strong>'.$template_name.'</strong></div>';
		}
		if(!empty($claim_name_text) || !empty($claimant_address_text) || !empty($claimant_dob_text) || !empty($accident_date_text)){
		$claimant_det_text = $template_name_data.'<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #6d5049;">
		<tr>
		<td>

		<table width="100%" border="0" cellspacing="1" cellpadding="4" >'.
		$claim_name_text.
		$claimant_address_text.
		$claimant_dob_text.
		$accident_date_text.
		$appointment_date_text.
		$appointment_venue_text.
		$report_date_text.
		$report_type_text.
		$accident_type_text.
		$medical_records_text.
		'</table>
		</td>
		</tr>
		</table>';
		}

		$send_user_comp_name = '';
		if(!empty($user_arr['Company']['name'])){
			$send_user_comp_name = $user_arr['Company']['name'];

			$send_user_comp_name_text = '<strong>'.$send_user_comp_name.'</strong>';
		}
		
		$send_user_name = '';

		//$send_user_name = ucfirst($user_arr['User']['title'])." " .$user_arr['User']['forename']." " .$user_arr['User']['middlename']." " .$user_arr['User']['surname']." ".$instruction_qualification;

		$myFile = Configure::read('coral_root_path')."/app/webroot/templates/create_letter_case_content.html";

		$instruction_header=$instruction_comp_name ."<br>".$user_arr['Address'][0]['address1'];
		if(isset($user_arr['Address'][0]['address2']) && $user_arr['Address'][0]['address2'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['address2'];
		}
		if(isset($user_arr['Address'][0]['address3']) && $user_arr['Address'][0]['address3'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['address3'];
		}
		if(isset($user_arr['Address'][0]['address4']) && $user_arr['Address'][0]['address4'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['address4'];
		}
		if(isset($user_arr['Address'][0]['address5']) && $user_arr['Address'][0]['address5'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['address5'];
		}
		if(isset($user_arr['Address'][0]['town']) && $user_arr['Address'][0]['town'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['town'];
		}
		$instruction_header .="<br>".$user_arr['Address'][0]['postcode'];
		if(isset($user_arr['Address'][0]['work_telephonec']) && $user_arr['Address'][0]['work_telephonec'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['work_telephonec']." (W)";
		}
		if(isset($user_arr['Address'][0]['mobile']) && $user_arr['Address'][0]['mobile'] !=""){
			$instruction_header .="<br>".$user_arr['Address'][0]['mobile']." (M)";
		}
		$template_content  = '<p style="font:large Arial;color:#000;">Further to our recent instructions, unfortunately our client\'s Solicitors have cancelled their request for a medico-legal report. <br><br> 

							 Please return any X-rays or MRI Scans that we may have sent to you relating to this client.<br><br>

							 We apologise for any inconvenience this may have caused.</p>';
		$content 			= '';
		//$content = 'dfsdfdsfd';
		//echo $instruction_header;
		//$content = file_get_contents($myFile);
		
			
		$file_funs = file($myFile);
		foreach ($file_funs as $file_num => $file_fun) {
			//$file_fun = str_replace('$header_logo$', $header_logo, $file_fun);
			$file_fun = str_replace('$instructor_header$', $instruction_header, $file_fun);
			$file_fun = str_replace('$toaddress_header$', $toaddress_header, $file_fun);
			$file_fun = str_replace('$our_reference_text$', $our_reference_text, $file_fun);
			
			$file_fun = str_replace('$your_reference_text$', $your_reference_text, $file_fun);
			
			$file_fun = str_replace('$solicitor_reference_text$', $solicitor_reference_text, $file_fun);

			$file_fun = str_replace('$cur_date$', $cur_date, $file_fun);

			$file_fun = str_replace('$claimant_det_text$', $claimant_det_text, $file_fun);

			$file_fun = str_replace('$send_user_comp_name_text$', $send_user_comp_name_text, $file_fun);

			$file_fun = str_replace('$send_user_name$', $send_user_name, $file_fun);

			$file_fun = str_replace('$template_content$', $template_content, $file_fun);

			$file_fun = str_replace('$contact_details$', $contact_details, $file_fun);

			$content.= $file_fun;
		}
		
		$img			= '';
		if($this->Session->read('Auth.User.id') == '803' || $this->Session->read('Auth.User.parent_id') =='803'){
			$img	  	= Configure::read('coral_root_path')."img/h_a.png";
		}else if($this->Session->read('Auth.User.id') == '1870' || $this->Session->read('Auth.User.parent_id') =='1870'){
			$img	  	= Configure::read('coral_root_path')."img/q_m.png";
		}
		
		$img_src  = '<td valign="top" width="35%" style="font:large Cambria, Arial, Helvetica, sans-serif; color:#000;padding-bottom:20px;" align="left"><img style="height:120px" src="'.$img.'" /></td>';
		$contentt = str_replace('Sir / Madam',$toaddress_nam,$content);
		$contentt = str_replace('Cambria, Arial, Helvetica, sans-serif','Arial',$contentt);
		$contentt = str_replace('15px Arial','large Arial',$contentt);
		//$contentt = str_replace('18px','large',$contentt);
		if($img !=''){
			$contentt = str_replace('<td valign="top" width="35%" style="font:large Arial; color:#000;" align="left"></td>',$img_src,$contentt);
		}
		$finalArray					= array();
		$finalArray['content']		= $contentt;
		$finalArray['file_name']	= $claim_name.'-Cancel Instruction Letter - Expert' ;
		$finalArray['file_title']	= $claim_name.', Our Ref :'.$our_reference.' , Cancel Instruction Letter - Expert';		
		$finalArray['user_id']		= $to_user_id;		
		$finalArray['user_email']	= $toUserDet['User']['email'];
		echo json_encode($finalArray);
		exit;
	}
	
	/**
	 * updated by vajesh starts( 20-Feb-2018, 23-Feb-2018, 07-Mar-2018, 09-Mar-2018 )
	 *
	 * */	
	function report_chase_email(){
        //$this->layout 										= 'csv';
		$this->autoRender 										= false;
		$cur_date												= date('Y-m-d');
		$qrry													= array();
		$report_a												= array();
	 	$qry													= $this->Appointment->find('list',array('fields'=>array('Appointment.case_master_id'),'conditions'=>array('Appointment.slot_date <='=>$cur_date,'Appointment.case_master_id IS NOT NULL','Appointment.status_id'=>Configure::read('status_Booked'), 'Appointment.slot_date >= DATE_SUB(NOW(),INTERVAL 2 YEAR)')));
		
	 	if(count($qry) > 0){
			$case_master_id										= implode(',',$qry);
			$case_master_id										= trim($case_master_id,',');
			$condition             	 							= "case_master_id in ($case_master_id)";
			/*$report_qry             							= "SELECT `Report`.`case_master_id` FROM `reportmaster` AS `Report` WHERE $condition";
			$db                     							= ConnectionManager::getDataSource("default"); // name of your database connection
			$qrry                   							= $db->fetchAll($report_qry);
			foreach($qrry as $key => $value){
				$report_a[]										= $value['Report']['case_master_id'];
			}
		 	$result = array_diff($qry, $report_a);*/
			$result 											= $qry;
		 	$joins												= array();
			$joins[]											= array(
																'table'=>'case_masters',
																'alias'=>'CaseMaster',
																'type'=>'LEFT',
																'conditions'=>array('Appointment.case_master_id = CaseMaster.id'),
																);
			$joins[]											= array(
																'table'=>'users',
																'alias'=>'User',
																'type'=>'LEFT',
																'conditions'=>array('Appointment.expert_id = User.id'),
																);
			$joins[]											= array(
																'table'=>'communications',
																'alias'=>'Communication',
																'type'=>'LEFT',
																'conditions'=>array('Appointment.expert_id = Communication.user_id'),
																);
			$joins[]											= array(
																'table'=>'case_claimant_details',
																'alias'=>'CaseClaimantDetail',
																'type'=>'LEFT',
																'conditions'=>array('Appointment.case_master_id = CaseClaimantDetail.case_master_id'),
																);
			/*$joins[]											= array(
																'table'=>'addresses',
																'alias'=>'Address',
																'type'=>'LEFT',
																'conditions'=>array('Address.user_id = Appointment.expert_id'),
																);*/
			$joins[]											= array(
																'table'=>'case_accident_details',
																'alias'=>'CaseAccidentDetail',
																'type'=>'LEFT',
																'conditions'=>array('CaseAccidentDetail.case_master_id = Appointment.case_master_id'),
																);
			$joins[]											= array(
																'table'=>'addresses',
																'alias'=>'AddressC',
																'type'=>'LEFT',
																'conditions'=>array('CaseClaimantDetail.id = AddressC.case_claimant_detail_id'),
																);
			$joins[]											= array(
																'table'=>'report_masters',
																'alias'=>'ReportMaster',
																'type'=>'LEFT',
																'conditions'=>array('CaseMaster.report_master_id = ReportMaster.id'),
																);
			$joins[]											= array(
																'table'=>'slot_parents',
																'alias'=>'SlotParent',
																'type'=>'LEFT',
																'conditions'=>array('Appointment.slot_parent_id = SlotParent.id')
																);
			$joins[]											= array(
																'table'=>'consulting_venues',
																'alias'=>'ConsultingVenue',
																'type'=>'LEFT',
																'conditions'=>array('ConsultingVenue.id = SlotParent.consulting_venue_id')
																);
			$joins[]											= array(
																'table'=>'addresses',
																'alias'=>'AddressE',
																'type'=>'LEFT',
																'conditions'=>array('ConsultingVenue.id = AddressE.consulting_venue_id')
																);
																
			$joins[]											= array(
																'table'=>'case_users',
																'alias'=>'CaseUser',
																'type'=>'LEFT',
																'conditions'=>array('CaseUser.case_master_id = CaseMaster.id')
																);
			$joins[]											= array(
																'table'=>'companies',
																'alias'=>'CompanyName',
																'type'=>'LEFT',
																'conditions'=>array('CompanyName.user_id = CaseUser.user_id')
																);
			$joins[]											= array(
																'table'=>'users',
																'alias'=>'UserP',
																'type'=>'LEFT',
																'conditions'=>array('UserP.id = CaseUser.user_id')
																);
																
			
			$send_arr											= array();
			$send_arr											= $this->User->find('list',array('fields'=>array('User.id'),'conditions'=>array('User.package_id'=>1,'User.parent_id'=>0,'User.group_id'=>Configure::read('AgentSuperUser'))));
			$sender_user_id										= $send_arr;
			
			//$sender_user_id									= array(803);
			if(count($result)> 0){
				$status_Arr										= array();
				$status_Arr[]									= Configure::read('status_hold');
				$status_Arr[]									= Configure::read('status_Cancelled');
				$case_details									= $this->Appointment->find('all',array('fields'=>array('User.*,CaseMaster.*,CaseClaimantDetail.*, AddressC.*,CaseAccidentDetail.*,Appointment.*,ReportMaster.id,ReportMaster.value,AddressE.*,CompanyName.name,CaseUser.user_id, CaseUser.fees_master_id,Communication.report_email'),'conditions'=>array('Appointment.case_master_id'=>$result,'Appointment.status_id'=>Configure::read('status_Booked'), 'CaseUser.user_type IN ("Primary Agent", "Sub Agent")','CaseUser.status_id !='=>Configure::read('status_hold'),'CaseUser.user_id'=>$sender_user_id,array('NOT'=>array('CaseUser.status_id'=>$status_Arr)),array('OR'=>array('CaseUser.report_file_path is NULL','CaseUser.report_file_path'=>'')),'CaseUser.report_date is NULL','UserP.status'=>'active', '(CaseUser.additional_info IS NULL OR CaseUser.additional_info="")'),'joins'=>$joins, 'group'=>array('CaseMaster.id'), 'recursive'=> -1)); //Address.*, 'Address.address_type'=>'',
				$test_cases										= array(57935437,20801504,96131313,12584456,29451601,37829814,66503742,62305520,14667484,22516807,26830411,23014699,89722124, 30075780, 58117002, 84153141, 52422190, 15645767, 82217360, 65787585, 40183599, 8114619, 24315101, 6104397, 30592059, 66611913, 99569301, 46762144, 28261918, 25703060, 78491528, 43373490, 77691702, 97137243, 11599617, 24696367);
				$i = 0;
				//debug($case_details); exit;
				foreach($case_details as $c_key =>$c_val){
				//	$i++;					
					//debug($result);
					if(!in_array($c_val['CaseMaster']['case_id'],$test_cases)){						
						
						if($c_val['CaseUser']['fees_master_id'] == 1){
							$result 	= $this->CommonFunctions->getAccidentRecordsDetails($c_val['CaseMaster']['id'], $c_val['CaseUser']['user_id']);
						} else {
							$result 	= 'success';
						}
						$date_addition	= date('Y-m-d', strtotime($c_val['Appointment']['slot_date']. ' + 3 days'));
						
						//debug($i.'---'.$c_val['CaseMaster']['case_id'].'---'.$result);
						if($result == 'success'){	
							if (date('Y-m-d') > $date_addition) {
								/*$address								= '';
								$address	.= ucwords($c_val['User']['title']).' '.$c_val['User']['forename'].' '.$c_val['User']['surname'].'<br>';
								if($c_val['Address']['address1'] !=''){
									$address	.= $c_val['Address']['address1'].'<br>';
								}
								if($c_val['Address']['address2'] !=''){
									$address	.= $c_val['Address']['address2'].'<br>';
								}
								if($c_val['Address']['town'] !=''){
									$address	.= $c_val['Address']['town'].'<br>';
								}
								if($c_val['Address']['address1'] !=''){
									$address	.= $c_val['Address']['postcode'].'<br>';
								}*/
								
								$address_c								= '';
								if($c_val['AddressC']['address1']!='' || $c_val['AddressC']['address1']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['address1']).'<br>';
								}
								if($c_val['AddressC']['address2']!='' || $c_val['AddressC']['address2']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['address2']).'<br>';
								}
								if($c_val['AddressC']['address3']!='' || $c_val['AddressC']['address3']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['address3']).'<br>';
								}
								if($c_val['AddressC']['address4']!='' || $c_val['AddressC']['address4']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['address4']).'<br>';
								}
								if($c_val['AddressC']['address5']!='' || $c_val['AddressC']['address5']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['address5']).'<br>';
								}
								if($c_val['AddressC']['town']!='' || $c_val['AddressC']['town']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['town']).'<br>';
								}
								if($c_val['AddressC']['county']!='' || $c_val['AddressC']['county']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['county']).'<br>';
								}
								if($c_val['AddressC']['postcode']!='' || $c_val['AddressC']['postcode']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['postcode']).'<br>';
								}
								
								
								$venue_address	='';
								if(isset($c_val['ConsultingVenue']['name']) && $c_val['ConsultingVenue']['name'] !=""){
									$venue_address =$c_val['ConsultingVenue']['name'];
								}
								if(isset($c_val['AddressE']['address1']) && $c_val['AddressE']['address1'] !=""){
									$venue_address =$c_val['AddressE']['address1'];
								}
								if(isset($c_val['AddressE']['address2']) && $c_val['AddressE']['address2'] !=""){
									$venue_address .="<br>".$c_val['AddressE']['address2'];
								}
								if(isset($c_val['AddressE']['address3']) && $c_val['AddressE']['address3'] !=""){
									$venue_address .="<br>".$c_val['AddressE']['address3'];
								}
								if(isset($c_val['AddressE']['town']) && $c_val['AddressE']['town'] !=""){
									$venue_address .="<br>".$c_val['AddressE']['town'];
								}
								if(isset($c_val['AddressE']['county']) && $c_val['AddressE']['county'] !=""){
									$venue_address .="<br>".$c_val['AddressE']['county'];
								}
								if(isset($c_val['AddressE']['postcode']) && $c_val['AddressE']['postcode'] !=""){
									$venue_address .="<br>".$c_val['AddressE']['postcode'];
								}
								
								$report_send_count									= $this->ChaseEmailDetail->find('all',array('conditions'=>array('ChaseEmailDetail.case_id'=>$c_val['CaseMaster']['case_id'],'ChaseEmailDetail.case_master_id'=>$c_val['CaseMaster']['id'],'ChaseEmailDetail.part35_id IS NULL')));
								if(count($report_send_count)> 0){
									$email_count	= $report_send_count[0]['ChaseEmailDetail']['email_count'] + 1;
								}else{
									$email_count	= 1;
								}
							//	echo $email_count."----<br>";
								$app_date_time 										= '';
								$app_date_time										= date("d/m/Y",strtotime($c_val['Appointment']['slot_date'])).' @ '.date('H:i ',strtotime($c_val['Appointment']['slot_start_time']));
								$print_Content										= 	'<div>
																					<table cellspacing="0" cellpadding="15" border="0" width="70%"  style="border:1px solid #000;font-family:Cambria,serif;font-size: 11.5pt;;">
																					<tbody>
																						<tr>
																							<td align="left" valign="top" width="100%" colspan="2" style="line-height:2">
																							<strong>Dear '.ucwords($c_val['User']['title']).' '.$c_val['User']['forename'].' '.$c_val['User']['surname'].'</strong><br>
																							</td>
																						</tr>
																						<tr style="font-size: 11.5pt;">
																						<td colspan="2">
																							<div style="width: 100%;text-align: center;padding: 10px 0px;font: bold 20px Arial;">
																								Report Chase - '.$email_count.'
																							</div>
																							<div>
																								<table cellspacing="0" cellpadding="5" border="0" width="100%" style="border:1px solid #000;font-size:11.5pt;">
																								<tbody>
																								<tr>
																								<td align="left" valign="top" style="font-weight:bold;" width="25%">
																								Claimant Name
																								</td>
																								<td align="left" valign="top" width="25%" >
																								'.ucwords($this->EncryptionFunctions->aes_decrypt($c_val['CaseClaimantDetail']['title'])).' '.$this->EncryptionFunctions->aes_decrypt($c_val['CaseClaimantDetail']['forename']).' '.$this->EncryptionFunctions->aes_decrypt($c_val['CaseClaimantDetail']['surname']).'
																								</td>
																								<td align="left" valign="top" style="font-weight:bold;" width="25%">
																								Address
																								</td>
																								<td align="left" valign="top" width="25%">
																								'.$address_c.'
																								</td>
																								</tr>
																								<tr>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Date of Birth	
																								</td>
																								<td align="left" valign="top">
																								'.date('d/m/Y',strtotime($c_val['CaseClaimantDetail']['dateofbirth'])).'
																								</td>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Accident Date
																								</td>
																								<td align="left" valign="top" >
																								'.date('d/m/Y',strtotime($c_val['CaseAccidentDetail']['accident_date'])).'
																								</td>
																								</tr>
																								<tr>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Appointment Date
																								</td>
																								<td align="left" valign="top" >
																								<span style="color:red	">'.$app_date_time.'</span>
																								</td>
																								</tr>
																								<tr>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Clinic Address
																								</td>
																								<td align="left" valign="top" >
																								'.$venue_address.'
																								</td>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Our reference
																								</td>
																								<td align="left" valign="top" >
																								'.$c_val['Appointment']['case_id'].'
																								</td>
																								</tr>
																								<tr>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Report Type
																								</td>
																								<td align="left" valign="top" >
																								'.$c_val['ReportMaster']['value'].'
																								</td>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Accident Type
																								</td>
																								<td align="left" valign="top" >
																								'.$c_val['CaseAccidentDetail']['accident_type'].'
																								</td>
																								</tr>
																								</tbody>
																								</table>
																							</div>	 
																							</td>
																						</tr>
																						<tr style="font-size: 11.5pt;">
																							<td colspan="2">
																								<p>
																								We are waiting to receive the report for our client , whom you examined  on ('.date('d/m/Y',strtotime($c_val['Appointment']['slot_date'])).')
																								</p>
																								<p>
																								If you are awaiting for further notes, records or documentation from ourselves, please contact us immediately in order that we can progress matters.
																								</p>
																								<p>
																								If you have forwarded the report within the last few days, then please ignore this email.
																								</p>
																								<p>
																								If the report is still being processed, we will anticipate receipt of your report as soon as possible from the date of this email, unless we hear from you to the contrary.
																								</p>
																								<p>
																								Thank you for your co-operation with this request.
																								</p>
																								
																								<p>
																								<p>Yours sincerely,</p>
																								<p><strong>'.$c_val['CompanyName']['name'].'</strong></p>
																								<p style= "border-top: solid 1px #000;font-size:11px;">
																								<strong>Disclaimer - </strong>This email and any files transmitted with it are confidential and
																								contain privileged or copyright information. You must not present
																								this message to another party without gaining permission from the
																								sender. If you are not the intended recipient you must not copy,
																								distribute or use this email or the information contained in it for
																								any purpose other than to notify us <br />
																								<br />
																								If you have received this message in error, please notify the sender
																								immediately, and delete this email from your system. We do not
																								guarantee that this material is free from viruses or any other
																								defects although due care has been taken to minimise the risk. Any
																								views expressed in this message are those of the individual sender,
																								except where the sender specifically states them to be the views of
																								Coral Technologies Ltd. <br />
																								<br />
																								Coral Technologies Limited, Registered in England and Wales, number
																								01614133470, Office: Readon House,2A Gatley Road,Cheadle SK8 1PY.
																								</p>
																							</td>
																						</tr>
																						</tbody>
																					</table>
																				</div>';		
								$subject										= 'Report Chase '.$email_count;
								//$to_email										= $c_val['Communication']['report_email'];
								//$to_email										= 'admin@hamedical.co.uk';
								//$this->send($to_email,'',$subject,$print_Content);
								$to_email										= array();
								$to_email[]										= $c_val['Communication']['report_email'];
								$this->send_chase_email($to_email,$c_val['CaseUser']['user_id'],$subject,$print_Content);
								
								if(count($report_send_count)> 0){
									$count_chase								= $report_send_count[0]['ChaseEmailDetail']['email_count'] + 1;
									$this->ChaseEmailDetail->updateAll(array('email_count' =>"'$count_chase'",'modified'=>'NOW()'),array('case_id' => $c_val['Appointment']['case_id'],'case_master_id' =>$c_val['Appointment']['case_master_id'],'part35_id IS NULL'));
								}else{
									$save_arr									= array();
									$save_arr['case_id']						= $c_val['Appointment']['case_id'];
									$save_arr['case_master_id']					= $c_val['Appointment']['case_master_id'];	
									$save_arr['email_count']					= 1;
									$save_arr['created']						= date("Y-m-d : H:i:s");
									$save_arr['modified']						= date("Y-m-d : H:i:s");	
									$this->ChaseEmailDetail->saveAll($save_arr);
								}
								
								$case_log_arr									= array();
								$case_log_arr['case_master_id'] 				= $c_val['CaseMaster']['id'];
								$case_log_arr['action'] 						= 84;
								$case_log_arr['done_by'] 						= ''; //$this->Session->read('Auth.User.id');
								$case_log_arr['comments'] 						= 'Report Chase email sent to ('.$c_val['Communication']['report_email'].')';
								$this->CommonFunctions->updateCaseHistory($case_log_arr);
								
								$subject 			= '';
								$print_Content 		= '';
								//echo $print_Content."<br><br><br><br>";
							}
						}
						$i++;
					}					
				}
				//	echo $i;
			}
		}
		exit;
    }
	
	function addendum_chase_email(){
		#$this->layout 											= 'csv';
		$this->autoRender 										= false;
		$qrry													= array();
		$report_a												= array();
		$qry													= $this->CaseMaster->find('list',array('fields'=>array('CaseMaster.id'),'conditions'=>array('CaseMaster.case_seq_no >'=>0)));
		if(count($qry)>0){
			$case_master_id										= implode(',',$qry);
			$case_master_id										= trim($case_master_id,',');
			$condition             	 							= "case_master_id in ($case_master_id)";
			/*$report_qry             							= "SELECT `Report`.`case_master_id` FROM `reportmaster` AS `Report` WHERE $condition";
			$db                     							= ConnectionManager::getDataSource("default"); // name of your database connection
			$qrry                   							= $db->fetchAll($report_qry);
			foreach($qrry as $key => $value){
				$report_a[]										= $value['Report']['case_master_id'];
			}
			$result 											= array_diff($qry, $report_a);*/
			$result 											= $qry;
			$joins												= array();
			$joins[]											= array(
																'table'=>'appointments',
																'alias'=>'Appointment',
																'type'=>'LEFT',
																'conditions'=>array('Appointment.case_id = CaseMaster.case_id'),
																);
			$joins[]											= array(
																'table'=>'users',
																'alias'=>'User',
																'type'=>'LEFT',
																'conditions'=>array('Appointment.expert_id = User.id'),
																);
			$joins[]											= array(
																'table'=>'communications',
																'alias'=>'Communication',
																'type'=>'LEFT',
																'conditions'=>array('Appointment.expert_id = Communication.user_id'),
																);
			$joins[]											= array(
																'table'=>'case_claimant_details',
																'alias'=>'CaseClaimantDetail',
																'type'=>'LEFT',
																'conditions'=>array('Appointment.case_master_id = CaseClaimantDetail.case_master_id'),
																);
			/*$joins[]											= array(
																'table'=>'addresses',
																'alias'=>'Address',
																'type'=>'LEFT',
																'conditions'=>array('Address.user_id = Appointment.expert_id'),
																);*/
			$joins[]											= array(
																'table'=>'case_accident_details',
																'alias'=>'CaseAccidentDetail',
																'type'=>'LEFT',
																'conditions'=>array('CaseAccidentDetail.case_master_id = Appointment.case_master_id'),
																);
			$joins[]											= array(
																'table'=>'addresses',
																'alias'=>'AddressC',
																'type'=>'LEFT',
																'conditions'=>array('CaseClaimantDetail.id = AddressC.case_claimant_detail_id'),
																);
			$joins[]											= array(
																'table'=>'report_masters',
																'alias'=>'ReportMaster',
																'type'=>'LEFT',
																'conditions'=>array('CaseMaster.report_master_id = ReportMaster.id'),
																);
			$joins[]											= array(
																'table'=>'slot_parents',
																'alias'=>'SlotParent',
																'type'=>'LEFT',
																'conditions'=>array('Appointment.slot_parent_id = SlotParent.id')
																);
			$joins[]											= array(
																'table'=>'consulting_venues',
																'alias'=>'ConsultingVenue',
																'type'=>'LEFT',
																'conditions'=>array('ConsultingVenue.id = SlotParent.consulting_venue_id')
																);
			$joins[]											= array(
																'table'=>'addresses',
																'alias'=>'AddressE',
																'type'=>'LEFT',
																'conditions'=>array('ConsultingVenue.id = AddressE.consulting_venue_id')
																);
																
			$joins[]											= array(
																'table'=>'case_users',
																'alias'=>'CaseUser',
																'type'=>'LEFT',
																'conditions'=>array('CaseUser.case_master_id = CaseMaster.id')
																);
			$joins[]											= array(
																'table'=>'companies',
																'alias'=>'CompanyName',
																'type'=>'LEFT',
																'conditions'=>array('CompanyName.user_id = CaseUser.user_id')
																);
			$joins[]											= array(
																'table'=>'users',
																'alias'=>'UserP',
																'type'=>'LEFT',
																'conditions'=>array('UserP.id = CaseUser.user_id')
																);
			$send_arr											= array();													
			$send_arr											= $this->User->find('list',array('fields'=>array('User.id'),'conditions'=>array('User.package_id'=>1,'User.parent_id'=>0,'User.group_id'=>Configure::read('AgentSuperUser'))));
			$sender_user_id										= $send_arr;
		 	//$sender_user_id										= array(803);
			if(count($result)> 0){
				$status_Arr										= array();
				$status_Arr[]									= Configure::read('status_hold');
				$status_Arr[]									= Configure::read('status_Cancelled');
				$case_details									= $this->CaseMaster->find('all',array('fields'=>array('User.*,CaseMaster.*,CaseClaimantDetail.*,AddressC.*,CaseAccidentDetail.*,Appointment.*,ReportMaster.id,ReportMaster.value,AddressE.*,CompanyName.name,CaseUser.user_id,CaseUser.fees_master_id,Communication.report_email'),'conditions'=>array('CaseUser.user_type IN ("Primary Agent", "Sub Agent")','CaseUser.status_id !='=>Configure::read('status_hold'),'CaseUser.user_id'=>$sender_user_id,array('NOT'=>array('CaseUser.status_id'=>$status_Arr)),array('OR'=>array('CaseUser.report_file_path is NULL','CaseUser.report_file_path'=>'')),'CaseUser.report_date is NULL','CaseMaster.id'=>$result,'Appointment.status_id'=>Configure::read('status_Booked'),'UserP.status'=>'active', '(CaseUser.additional_info IS NULL OR CaseUser.additional_info="")'),'joins'=>$joins, 'group'=>array('CaseMaster.id'),'recursive'=> -1)); // ,Address.* ,'Address.address_type'=>''
				$test_cases										= array(57935437,20801504,96131313,12584456,29451601,37829814,66503742,62305520,14667484,22516807,26830411,23014699,89722124, 30075780, 58117002, 84153141, 52422190, 15645767, 82217360, 65787585, 40183599, 8114619, 24315101, 6104397, 30592059, 66611913, 99569301, 46762144, 28261918, 25703060, 78491528, 43373490, 77691702, 97137243, 11599617, 24696367);
				
				$i = 1;
				foreach($case_details as $c_key =>$c_val){			
					if(!in_array($c_val['CaseMaster']['case_id'],$test_cases)){
						if($c_val['CaseUser']['fees_master_id'] == 1){
							$result 	= $this->CommonFunctions->getAccidentRecordsDetails($c_val['CaseMaster']['id'], $c_val['CaseUser']['user_id']);
						} else {
							$result 	= 'success';
						}
						$date_addition	= date('Y-m-d', strtotime($c_val['CaseMaster']['created']. ' + 3 days'));
						//debug($i.'---'.$c_val['CaseMaster']['case_id'].'---'.$result);
						if($result == 'success'){
							if (date('Y-m-d') > $date_addition) {
								$address								= '';
								/*$address	.= ucwords($c_val['User']['title']).' '.$c_val['User']['forename'].' '.$c_val['User']['surname'].'<br>';
								if($c_val['Address']['address1'] !=''){
									$address	.= $c_val['Address']['address1'].'<br>';
								}
								if($c_val['Address']['address2'] !=''){
									$address	.= $c_val['Address']['address2'].'<br>';
								}
								if($c_val['Address']['town'] !=''){
									$address	.= $c_val['Address']['town'].'<br>';
								}
								if($c_val['Address']['address1'] !=''){
									$address	.= $c_val['Address']['postcode'].'<br>';
								}*/
								
								$address_c								= '';
								if($c_val['AddressC']['address1']!='' || $c_val['AddressC']['address1']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['address1']).'<br>';
								}
								if($c_val['AddressC']['address2']!='' || $c_val['AddressC']['address2']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['address2']).'<br>';
								}
								if($c_val['AddressC']['address3']!='' || $c_val['AddressC']['address3']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['address3']).'<br>';
								}
								if($c_val['AddressC']['address4']!='' || $c_val['AddressC']['address4']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['address4']).'<br>';
								}
								if($c_val['AddressC']['address5']!='' || $c_val['AddressC']['address5']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['address5']).'<br>';
								}
								if($c_val['AddressC']['town']!='' || $c_val['AddressC']['town']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['town']).'<br>';
								}
								if($c_val['AddressC']['county']!='' || $c_val['AddressC']['county']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['county']).'<br>';
								}
								if($c_val['AddressC']['postcode']!='' || $c_val['AddressC']['postcode']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['postcode']).'<br>';
								}
								
								$venue_address	='';
								if(isset($c_val['ConsultingVenue']['name']) && $c_val['ConsultingVenue']['name'] !=""){
									$venue_address =$c_val['ConsultingVenue']['name'];
								}
								if(isset($c_val['AddressE']['address1']) && $c_val['AddressE']['address1'] !=""){
									$venue_address =$c_val['AddressE']['address1'];
								}
								if(isset($c_val['AddressE']['address2']) && $c_val['AddressE']['address2'] !=""){
									$venue_address .="<br>".$c_val['AddressE']['address2'];
								}
								if(isset($c_val['AddressE']['address3']) && $c_val['AddressE']['address3'] !=""){
									$venue_address .="<br>".$c_val['AddressE']['address3'];
								}
								if(isset($c_val['AddressE']['town']) && $c_val['AddressE']['town'] !=""){
									$venue_address .="<br>".$c_val['AddressE']['town'];
								}
								if(isset($c_val['AddressE']['county']) && $c_val['AddressE']['county'] !=""){
									$venue_address .="<br>".$c_val['AddressE']['county'];
								}
								if(isset($c_val['AddressE']['postcode']) && $c_val['AddressE']['postcode'] !=""){
									$venue_address .="<br>".$c_val['AddressE']['postcode'];
								}
							
								if($c_val['CaseMaster']['amendment_subject'] == 'Amended report'){
									$type_report										= 'Amendment Report';
									$created_cat										= 'Amendment Request Date';
								}else{
									$type_report										= 'Addendum report';
									$created_cat										= 'Addendum Request Date';
								}
								$report_send_count									= $this->ChaseEmailDetail->find('all',array('conditions'=>array('ChaseEmailDetail.case_id'=>$c_val['CaseMaster']['case_id'],'ChaseEmailDetail.case_master_id'=>$c_val['CaseMaster']['id'],'ChaseEmailDetail.part35_id IS NULL')));
								if(count($report_send_count)> 0){
									$email_count	= $report_send_count[0]['ChaseEmailDetail']['email_count'] + 1;
								}else{
									$email_count	= 1;
								}
								
								$app_date_time 										= '';
								$app_date_time										= date("d/m/Y",strtotime($c_val['Appointment']['slot_date'])).' @ '.date('H:i ',strtotime($c_val['Appointment']['slot_start_time']));
								$print_Content										= 	'<div>
																					<table cellspacing="0" cellpadding="15" border="0" width="70%"  style="border:1px solid #000;font-family:Cambria,serif;font-size: 11.5pt;;">
																					<tbody>
																						<tr>
																							<td align="left" valign="top" width="100%" colspan="2" style="line-height:2">
																							<strong>Dear '.ucwords($c_val['User']['title']).' '.$c_val['User']['forename'].' '.$c_val['User']['surname'].'</strong><br>
																							</td>
																						</tr>
																						<tr style="font-size: 11.5pt;;">
																						<td colspan="2">
																							<div style="width: 100%;text-align: center;padding: 10px 0px;font: bold 20px Arial;">
																								Report Chase - '.$email_count.'
																							</div>
																							<div>
																								<table cellspacing="0" cellpadding="5" border="0" width="100%" style="border:1px solid #000;font-size:11.5pt;">
																								<tbody>
																								<tr>
																								<td align="left" valign="top" style="font-weight:bold;" width="25%">
																								Claimant Name
																								</td>
																								<td align="left" valign="top" width="25%">
																								'.ucwords($this->EncryptionFunctions->aes_decrypt($c_val['CaseClaimantDetail']['title'])).' '.$this->EncryptionFunctions->aes_decrypt($c_val['CaseClaimantDetail']['forename']).' '.$this->EncryptionFunctions->aes_decrypt($c_val['CaseClaimantDetail']['surname']).'
																								</td>
																								<td align="left" valign="top" style="font-weight:bold;" width="25%" >
																								Address
																								</td>
																								<td align="left" valign="top" width="25%" >
																								'.$address_c.'
																								</td>
																								</tr>
																								<tr>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Date of Birth	
																								</td>
																								<td align="left" valign="top">
																								'.date('d/m/Y',strtotime($c_val['CaseClaimantDetail']['dateofbirth'])).'
																								</td>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Accident Date
																								</td>
																								<td align="left" valign="top" >
																								'.date('d/m/Y',strtotime($c_val['CaseAccidentDetail']['accident_date'])).'
																								</td>
																								</tr>
																								<tr>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Appointment Date
																								</td>
																								<td align="left" valign="top" >
																								<span>'.$app_date_time.'</span>
																								</td>
																								<td align="left" valign="top" style="font-weight:bold;">
																								'.$created_cat.'
																								</td>
																								<td align="left" valign="top" >
																								<span style="color:red">'.date('d/m/Y',strtotime($c_val['CaseMaster']['created'])).'</span>
																								</td>
																								</tr>
																								<tr>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Clinic Address
																								</td>
																								<td align="left" valign="top" >
																								'.$venue_address.'
																								</td>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Our reference
																								</td>
																								<td align="left" valign="top" >
																								'.$c_val['Appointment']['case_id'].'
																								</td>
																								</tr>
																								<tr>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Report Type
																								</td>
																								<td align="left" valign="top" >
																								'.$c_val['ReportMaster']['value'].'
																								</td>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Accident Type
																								</td>
																								<td align="left" valign="top" >
																								'.$c_val['CaseAccidentDetail']['accident_type'].'
																								</td>
																								</tr>
																								</tbody>
																								</table>
																							</div>	 
																							</td>
																						</tr>
																						<tr style="font-size:11.5pt;">
																							<td colspan="2">
																								<p>
																									We are waiting to receive the '.$type_report.' for our client , whom you examined on '.date('d/m/Y',strtotime($c_val['Appointment']['slot_date'])).'
																								</p>
																								<p>
																									If you are awaiting for further notes, records or documentation from ourselves, please contact us immediately in order that we can progress matters.
																								</p>
																								<p>
																									If you have forwarded the report within the last few days, then please ignore this email.
																								</p>
																								<p>
																								If the report is still being processed, we will anticipate receipt of your report as soon as possible from the date of this email, unless we hear from you to the contrary.
																								</p>
																								<p>
																								Thank you for your co-operation with this request.
																								</p>
																								<p>
																								<p>Yours sincerely,</p>
																								<p><strong>'.$c_val['CompanyName']['name'].'</strong></p>
																								<p style= "border-top: solid 1px #000;font-size:11px;">
																								<strong>Disclaimer - </strong>This email and any files transmitted with it are confidential and
																								contain privileged or copyright information. You must not present
																								this message to another party without gaining permission from the
																								sender. If you are not the intended recipient you must not copy,
																								distribute or use this email or the information contained in it for
																								any purpose other than to notify us <br />
																								<br />
																								If you have received this message in error, please notify the sender
																								immediately, and delete this email from your system. We do not
																								guarantee that this material is free from viruses or any other
																								defects although due care has been taken to minimise the risk. Any
																								views expressed in this message are those of the individual sender,
																								except where the sender specifically states them to be the views of
																								Coral Technologies Ltd. <br />
																								<br />
																								Coral Technologies Limited, Registered in England and Wales, number
																								01614133470, Office: Readon House,2A Gatley Road,Cheadle SK8 1PY.
																								</p>
																							</td>
																						</tr>
																						</tbody>
																					</table>
																				</div>';	

								$subject										= 'Report Chase '.$email_count;
								/*$to_email										= $c_val['Communication']['report_email'];
								//$to_email										= 'admin@hamedical.co.uk';
								$this->send($to_email,'',$subject,$print_Content);		
								*/
								$to_email										= array();
								$to_email[]										= $c_val['Communication']['report_email'];
								$this->send_chase_email($to_email,$c_val['CaseUser']['user_id'],$subject,$print_Content);
								
								if(count($report_send_count)> 0){
									$count_chase								= $report_send_count[0]['ChaseEmailDetail']['email_count'] + 1;
									$this->ChaseEmailDetail->updateAll(array('email_count' =>"'$count_chase'",'modified'=>'NOW()'),array('case_id' => $c_val['CaseMaster']['case_id'],'case_master_id' =>$c_val['CaseMaster']['id'],'part35_id IS NULL'));
								}else{
									$save_arr									= array();
									$save_arr['case_id']						= $c_val['CaseMaster']['case_id'];
									$save_arr['case_master_id']					= $c_val['CaseMaster']['id'];	
									$save_arr['email_count']					= 1;
									$save_arr['created']						= date("Y-m-d : H:i:s");
									$save_arr['modified']						= date("Y-m-d : H:i:s");	
									$this->ChaseEmailDetail->saveAll($save_arr);
								}
								
								$case_log_arr									= array();
								$case_log_arr['case_master_id'] 				= $c_val['CaseMaster']['id'];
								$case_log_arr['action'] 						= 84;
								$case_log_arr['done_by'] 						= ''; //$this->Session->read('Auth.User.id');
								$case_log_arr['comments'] 						= 'Addendum/Amendment Report Chase email sent to ('.$c_val['Communication']['report_email'].')';
								$this->CommonFunctions->updateCaseHistory($case_log_arr);
								
								$subject 			= '';
								$print_Content 		= '';
								//echo $print_Content."<br><br><br><br>";
							}						
						}
						$i++;
					}
				}
			}
		}
		exit;
	}
	
	function part35_chase_email(){
		#$this->layout 											= 'csv';
		$this->autoRender 										= false;
		$qrry													= array();
		$report_a												= array();
		$qry													= $this->CaseUser->find('all',array('fields'=>array('CaseUser.id,CaseUser.case_master_id,CaseUser.part35_or_addendum_letter_id'),'conditions'=>array('CaseUser.part35_or_addendum_letter_id IS NOT NULL','CaseUser.part35_or_addendum_letter_id !='=> 0,'OR'=>array(array('CaseUser.user_type'=>'Panel Expert'),array('CaseUser.user_type'=>'Expert')))));
		
		if(count($qry) > 0){
			$case_master_ids									= array();
			$part35												= array();
			foreach($qry as $q_key =>$q_val){
				$case_master_ids[]								= $q_val['CaseUser']['case_master_id']; 					
				$part35[]										= $q_val['CaseUser']['part35_or_addendum_letter_id']; 					
			}
			$case_master_id										= implode(',',$case_master_ids);
			$case_master_id										= trim($case_master_id,',');
			$part35_id											= implode(',',$part35);
			$part35_id											= trim($part35_id,',');
			
			$condition             	 							= "case_master_id IN ($case_master_id) AND part35_or_addendum_letter_id IN ($part35_id)";
			/*$report_qry             							= "SELECT `Report`.`case_master_id`,`Report`.`part35_or_addendum_letter_id` FROM `reportmaster` AS `Report` WHERE $condition";
			$db                     							= ConnectionManager::getDataSource("default"); // name of your database connection
			$qrry                   							= $db->fetchAll($report_qry);
			
			foreach($qrry as $key => $value){
				$report_a[]										= $value['Report']['part35_or_addendum_letter_id'];
			}
			$result 											= array_diff($part35, $report_a);*/
			$result 											= $part35;
			$result_str											= trim(implode(',',$result),',');
			$joins												= array();
			$joins[]											= array(
																'table'=>'appointments',
																'alias'=>'Appointment',
																'type'=>'LEFT',
																'conditions'=>array('Appointment.case_id = Part35OrAddendumLetter.case_id'),
																);
			$joins[]											= array(
																'table'=>'users',
																'alias'=>'User',
																'type'=>'LEFT',
																'conditions'=>array('Appointment.expert_id = User.id'),
																);
			$joins[]											= array(
																'table'=>'communications',
																'alias'=>'Communication',
																'type'=>'LEFT',
																'conditions'=>array('Appointment.expert_id = Communication.user_id'),
																);
			$joins[]											= array(
																'table'=>'case_claimant_details',
																'alias'=>'CaseClaimantDetail',
																'type'=>'LEFT',
																'conditions'=>array('Appointment.case_master_id = CaseClaimantDetail.case_master_id'),
																);
			/*$joins[]											= array(
																'table'=>'addresses',
																'alias'=>'Address',
																'type'=>'LEFT',
																'conditions'=>array('Address.user_id = Appointment.expert_id'),
																);*/
			$joins[]											= array(
																'table'=>'case_accident_details',
																'alias'=>'CaseAccidentDetail',
																'type'=>'LEFT',
																'conditions'=>array('CaseAccidentDetail.case_master_id = Appointment.case_master_id'),
																);
			$joins[]											= array(
																'table'=>'addresses',
																'alias'=>'AddressC',
																'type'=>'LEFT',
																'conditions'=>array('CaseClaimantDetail.id = AddressC.case_claimant_detail_id'),
																);
			$joins[]											= array(
																'table'=>'case_masters',
																'alias'=>'CaseMaster',
																'type'=>'LEFT',
																'conditions'=>array('CaseMaster.id = Part35OrAddendumLetter.case_master_id'),
																);
																
			$joins[]											= array(
																'table'=>'report_masters',
																'alias'=>'ReportMaster',
																'type'=>'LEFT',
																'conditions'=>array('CaseMaster.report_master_id = ReportMaster.id'),
																);
			$joins[]											= array(
																'table'=>'slot_parents',
																'alias'=>'SlotParent',
																'type'=>'LEFT',
																'conditions'=>array('Appointment.slot_parent_id = SlotParent.id')
																);
			$joins[]											= array(
																'table'=>'consulting_venues',
																'alias'=>'ConsultingVenue',
																'type'=>'LEFT',
																'conditions'=>array('ConsultingVenue.id = SlotParent.consulting_venue_id')
																);
			$joins[]											= array(
																'table'=>'addresses',
																'alias'=>'AddressE',
																'type'=>'LEFT',
																'conditions'=>array('ConsultingVenue.id = AddressE.consulting_venue_id')
																);
			$joins[]											= array(
																'table'=>'case_users',
																'alias'=>'CaseUser',
																'type'=>'LEFT',
																'conditions'=>array('CaseUser.case_master_id = CaseMaster.id AND CaseUser.part35_or_addendum_letter_id IN('.$result_str.')')
																);
			$joins[]											= array(
																'table'=>'companies',
																'alias'=>'CompanyName',
																'type'=>'LEFT',
																'conditions'=>array('CompanyName.user_id = CaseUser.user_id')
																);
			$joins[]											= array(
																'table'=>'users',
																'alias'=>'UserP',
																'type'=>'LEFT',
																'conditions'=>array('UserP.id = CaseUser.user_id')
																);
																
			$send_arr											= array();													
			$send_arr											= $this->User->find('list',array('fields'=>array('User.id'),'conditions'=>array('User.package_id'=>1,'User.parent_id'=>0,'User.group_id'=>Configure::read('AgentSuperUser'))));
			//$sender_user_id									= array(803,1665,1870);
			$sender_user_id										= $send_arr;
			//$sender_user_id										= array(803);
		 	if(count($result)> 0){
				$status_Arr										= array();
				$status_Arr[]									= Configure::read('status_hold');
				$status_Arr[]									= Configure::read('status_Cancelled');
				$case_details									= $this->Part35OrAddendumLetter->find('all',array('fields'=>array('Part35OrAddendumLetter.*,User.*,CaseMaster.*,CaseClaimantDetail.*,AddressC.*,CaseAccidentDetail.*,Appointment.*,ReportMaster.id,ReportMaster.value,AddressE.*,CompanyName.name,CaseUser.user_id, CaseUser.fees_master_id, Communication.report_email'),'joins'=>$joins,'conditions'=>array('CaseUser.user_type IN ("Primary Agent", "Sub Agent")','CaseUser.user_id'=>$sender_user_id,'Part35OrAddendumLetter.id'=>$result,'UserP.status'=>'active',array('NOT'=>array('CaseUser.status_id'=>$status_Arr)),array('OR'=>array('CaseUser.report_file_path is NULL','CaseUser.report_file_path'=>'')),'CaseUser.report_date is NULL', '(CaseUser.additional_info IS NULL OR CaseUser.additional_info="")'),'group' => 'CaseUser.case_master_id')); //,Address.*
				$test_cases										= array(57935437,20801504,96131313,12584456,29451601,37829814,66503742,62305520,14667484,22516807,26830411,23014699, 89722124, 30075780, 58117002, 84153141, 52422190, 15645767, 82217360, 65787585, 40183599, 8114619, 24315101, 6104397, 30592059, 66611913, 99569301, 46762144, 28261918, 25703060, 78491528, 43373490, 77691702, 97137243, 11599617, 24696367);
				
				$i = 1;
				foreach($case_details as $c_key =>$c_val){					
					if(!in_array($c_val['CaseMaster']['case_id'],$test_cases)){						
						if($c_val['CaseUser']['fees_master_id'] == 1){
							$result 	= $this->CommonFunctions->getAccidentRecordsDetails($c_val['CaseMaster']['id'], $c_val['CaseUser']['user_id']);
						} else {
							$result 	= 'success';
						}
						$date_addition	= date('Y-m-d', strtotime($c_val['Part35OrAddendumLetter']['created']. ' + 3 days'));
						
						//debug($i.'---'.$c_val['CaseMaster']['case_id'].'---'.$result);
					
						if($result == 'success'){
							if (date('Y-m-d') > $date_addition){
								$address								= '';
								/*$address	.= ucwords($c_val['User']['title']).' '.$c_val['User']['forename'].' '.$c_val['User']['surname'].'<br>';
								if($c_val['Address']['address1'] !=''){
									$address	.= $c_val['Address']['address1'].'<br>';
								}
								if($c_val['Address']['address2'] !=''){
									$address	.= $c_val['Address']['address2'].'<br>';
								}
								if($c_val['Address']['town'] !=''){
									$address	.= $c_val['Address']['town'].'<br>';
								}
								if($c_val['Address']['address1'] !=''){
									$address	.= $c_val['Address']['postcode'].'<br>';
								}*/
								
								$address_c								= '';
								if($c_val['AddressC']['address1']!='' || $c_val['AddressC']['address1']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['address1']).'<br>';
								}
								if($c_val['AddressC']['address2']!='' || $c_val['AddressC']['address2']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['address2']).'<br>';
								}
								if($c_val['AddressC']['address3']!='' || $c_val['AddressC']['address3']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['address3']).'<br>';
								}
								if($c_val['AddressC']['address4']!='' || $c_val['AddressC']['address4']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['address4']).'<br>';
								}
								if($c_val['AddressC']['address5']!='' || $c_val['AddressC']['address5']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['address5']).'<br>';
								}
								if($c_val['AddressC']['town']!='' || $c_val['AddressC']['town']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['town']).'<br>';
								}
								if($c_val['AddressC']['county']!='' || $c_val['AddressC']['county']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['county']).'<br>';
								}
								if($c_val['AddressC']['postcode']!='' || $c_val['AddressC']['postcode']!=null){
									$address_c  .= $this->EncryptionFunctions->aes_decrypt($c_val['AddressC']['postcode']).'<br>';
								}
								
								
								$venue_address	='';
								if(isset($c_val['ConsultingVenue']['name']) && $c_val['ConsultingVenue']['name'] !=""){
									$venue_address =$c_val['ConsultingVenue']['name'];
								}
								if(isset($c_val['AddressE']['address1']) && $c_val['AddressE']['address1'] !=""){
									$venue_address =$c_val['AddressE']['address1'];
								}
								if(isset($c_val['AddressE']['address2']) && $c_val['AddressE']['address2'] !=""){
									$venue_address .="<br>".$c_val['AddressE']['address2'];
								}
								if(isset($c_val['AddressE']['address3']) && $c_val['AddressE']['address3'] !=""){
									$venue_address .="<br>".$c_val['AddressE']['address3'];
								}
								if(isset($c_val['AddressE']['town']) && $c_val['AddressE']['town'] !=""){
									$venue_address .="<br>".$c_val['AddressE']['town'];
								}
								if(isset($c_val['AddressE']['county']) && $c_val['AddressE']['county'] !=""){
									$venue_address .="<br>".$c_val['AddressE']['county'];
								}
								if(isset($c_val['AddressE']['postcode']) && $c_val['AddressE']['postcode'] !=""){
									$venue_address .="<br>".$c_val['AddressE']['postcode'];
								}
							
								$report_send_count									= $this->ChaseEmailDetail->find('all',array('conditions'=>array('ChaseEmailDetail.case_id'=>$c_val['Part35OrAddendumLetter']['case_id'],'ChaseEmailDetail.case_master_id'=>$c_val['Part35OrAddendumLetter']['case_master_id'],'ChaseEmailDetail.part35_id'=>$c_val['Part35OrAddendumLetter']['id'])));
								
								if(count($report_send_count)> 0){
									$email_count	= $report_send_count[0]['ChaseEmailDetail']['email_count'] + 1;
								}else{
									$email_count	= 1;
								}
								
								$app_date_time 										= '';
								$app_date_time										= date("d/m/Y",strtotime($c_val['Appointment']['slot_date'])).' @ '.date('H:i ',strtotime($c_val['Appointment']['slot_start_time']));
								$print_Content										= 	'<div>
																					<table cellspacing="0" cellpadding="15" border="0" width="70%"  style="border:1px solid #000;font-family:Cambria,serif;font-size: 11.5pt;;">
																					<tbody>
																						<tr>
																							<td align="left" valign="top" width="100%" colspan="2" style="line-height:2">
																							<strong>Dear '.ucwords($c_val['User']['title']).' '.$c_val['User']['forename'].' '.$c_val['User']['surname'].'</strong><br>
																							</td>
																						</tr>
																						<tr style="font-size: 11.5pt;;">
																							<td colspan="2">
																							<div style="width: 100%;text-align: center;padding: 10px 0px;font: bold 20px Arial;">
																								Report Chase - '.$email_count.'
																							</div>
																							<div>
																								<table cellspacing="0" cellpadding="5" border="0" width="100%" style="border:1px solid #000;font-size:11.5pt;">
																								<tbody>
																								<tr>
																								<td align="left" valign="top" style="font-weight:bold;" width="25%" >
																								Claimant Name
																								</td>
																								<td align="left" valign="top" width="25%" >
																								'.ucwords($this->EncryptionFunctions->aes_decrypt($c_val['CaseClaimantDetail']['title'])).' '.$this->EncryptionFunctions->aes_decrypt($c_val['CaseClaimantDetail']['forename']).' '.$this->EncryptionFunctions->aes_decrypt($c_val['CaseClaimantDetail']['surname']).'
																								</td>
																								<td align="left" valign="top" style="font-weight:bold;" width="25%" >
																								Address
																								</td>
																								<td align="left" valign="top" width="25%" >
																								'.$address_c.'
																								</td>
																								</tr>
																								<tr>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Date of Birth	
																								</td>
																								<td align="left" valign="top">
																								'.date('d/m/Y',strtotime($c_val['CaseClaimantDetail']['dateofbirth'])).'
																								</td>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Accident Date
																								</td>
																								<td align="left" valign="top" >
																								'.date('d/m/Y',strtotime($c_val['CaseAccidentDetail']['accident_date'])).'
																								</td>
																								</tr>
																								<tr>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Appointment Date
																								</td>
																								<td align="left" valign="top" >
																								<span>'.$app_date_time.'</span>
																								</td>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Part35 Request Date
																								</td>
																								<td align="left" valign="top" >
																								<span style="color:red">'.date('d/m/Y',strtotime($c_val['Part35OrAddendumLetter']['created'])).'</span>
																								</td>
																								</tr>
																								<tr>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Clinic Address
																								</td>
																								<td align="left" valign="top" >
																								'.$venue_address.'
																								</td>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Our reference
																								</td>
																								<td align="left" valign="top" >
																								'.$c_val['Appointment']['case_id'].'
																								</td>
																								</tr>
																								<tr>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Report Type
																								</td>
																								<td align="left" valign="top" >
																								'.$c_val['ReportMaster']['value'].'
																								</td>
																								<td align="left" valign="top" style="font-weight:bold;">
																								Accident Type
																								</td>
																								<td align="left" valign="top" >
																								'.$c_val['CaseAccidentDetail']['accident_type'].'
																								</td>
																								</tr>
																								</tbody>
																								</table>
																							</div>	 
																							</td>
																						</tr>
																						<tr style="font-size:11.5pt;">
																							<td colspan="2">
																								<p>
																									We have not received a reply to our recent request for comments on questions raised by the third party/Solicitors.
																								</p>
																								<p>
																									If you are awaiting for further notes, records or documentation from ourselves, please contact us immediately in order that we can progress matters.
																								</p>
																								<p>
																									If you have forwarded the report within the last few days, then please ignore this email.
																								</p>
																								<p>
																								If the report is still being processed, we will anticipate receipt of your report as soon as possible from the date of this email, unless we hear from you to the contrary.
																								</p>
																								<p>
																								Thank you for your co-operation with this request.
																								</p>
																								<p>
																								<p>Yours sincerely,</p>
																								<p><strong>'.$c_val['CompanyName']['name'].'</strong></p>
																								<p style= "border-top: solid 1px #000;font-size:11px;">
																								<strong>Disclaimer - </strong>This email and any files transmitted with it are confidential and
																								contain privileged or copyright information. You must not present
																								this message to another party without gaining permission from the
																								sender. If you are not the intended recipient you must not copy,
																								distribute or use this email or the information contained in it for
																								any purpose other than to notify us <br />
																								<br />
																								If you have received this message in error, please notify the sender
																								immediately, and delete this email from your system. We do not
																								guarantee that this material is free from viruses or any other
																								defects although due care has been taken to minimise the risk. Any
																								views expressed in this message are those of the individual sender,
																								except where the sender specifically states them to be the views of
																								Coral Technologies Ltd. <br />
																								<br />
																								Coral Technologies Limited, Registered in England and Wales, number
																								01614133470, Office: Readon House,2A Gatley Road,Cheadle SK8 1PY.
																								</p>
																							</td>
																						</tr>
																						</tbody>
																					</table>
																				</div>';	
								$subject										= 'Part35 Report Chase '.$email_count;
								$to_email										= array();
								$to_email[]										= $c_val['Communication']['report_email'];
								$this->send_chase_email($to_email,$c_val['CaseUser']['user_id'],$subject,$print_Content);
								
								//$this->send($to_email,'',$subject,$print_Content);	
								if(count($report_send_count)> 0){
									$count_chase								= $report_send_count[0]['ChaseEmailDetail']['email_count'] + 1;
									$this->ChaseEmailDetail->updateAll(array('ChaseEmailDetail.email_count' =>"'$count_chase'",'ChaseEmailDetail.modified'=>'NOW()'),array('ChaseEmailDetail.case_id'=>$c_val['Part35OrAddendumLetter']['case_id'],'ChaseEmailDetail.case_master_id'=>$c_val['Part35OrAddendumLetter']['case_master_id'],'ChaseEmailDetail.part35_id'=>$c_val['Part35OrAddendumLetter']['id']));
								}else{
									$save_arr									= array();
									$save_arr['case_id']						= $c_val['Part35OrAddendumLetter']['case_id'];
									$save_arr['case_master_id']					= $c_val['Part35OrAddendumLetter']['case_master_id'];	
									$save_arr['part35_id']						= $c_val['Part35OrAddendumLetter']['id'];	
									$save_arr['email_count']					= 1;
									$save_arr['created']						= date("Y-m-d : H:i:s");
									$save_arr['modified']						= date("Y-m-d : H:i:s");	
									$this->ChaseEmailDetail->saveAll($save_arr);
								}
								$case_log_arr									= array();
								$case_log_arr['case_master_id'] 				= $c_val['CaseMaster']['id'];
								$case_log_arr['action'] 						= 84;
								$case_log_arr['done_by'] 						= ''; //$this->Session->read('Auth.User.id');
								$case_log_arr['comments'] 						= 'Part35 Report Chase email sent to ('.$c_val['Communication']['report_email'].')';
								$this->CommonFunctions->updateCaseHistory($case_log_arr);
								
								$subject 			= '';
								$print_Content 		= '';
								//echo $print_Content."<br><br><br><br>";
							}
						}
						
						$i++;
					}
				}
			}
		}
		exit;
	}
	
	function chase_mail($master_id = null,$user_id =null,$part35= null){
		$this->layout 											= 'csv';
		$this->set('master_id',$master_id);
		$this->set('user_id',$user_id);
		$this->set('part35',$part35);
		$master_id												= $this->EncryptionFunctions->deCrypt($master_id);
		$user_id												= $this->EncryptionFunctions->deCrypt($user_id);
		$part35													= $this->EncryptionFunctions->deCrypt($part35);
	 	$status_Arr												= array();
		$status_Arr[]											= Configure::read('status_hold');
		$status_Arr[]											= Configure::read('status_Cancelled');
		$part35_id												= $part35;
		if($part35 == 0){
			$part35_id 											= null;
		}					
		
		$report_send_count										= $this->ChaseEmailDetail->find('all',array('conditions'=>array('ChaseEmailDetail.case_master_id'=>$master_id,'ChaseEmailDetail.part35_id'=>$part35_id)));
		if(count($report_send_count)> 0){
			$email_count										= $report_send_count[0]['ChaseEmailDetail']['email_count'] + 1;
		}else{
			$email_count										= 1;
		}
		//debug($part35);
	//	exit;
		$shadow_false										= 0;
		if(isset($this->data) && !empty($this->data)){
			$case_dl										= $this->CaseMaster->find('first',array('fields'=>array('CaseMaster.case_id,CaseMaster.case_seq_no'),'conditions'=>array('CaseMaster.id'=>$master_id)));
			$to					= explode(',',$this->data['ChaseMail']['PrimaryEmail']);
			$cc					= explode(',',$this->data['ChaseMail']['SecondaryEmail']);
			$bcc				= explode(',',$this->data['ChaseMail']['OptionalEmail']);
			$subject			= $this->data['ChaseMail']['Subject'];
			$print_Content		= $this->data['ChaseMail']['Content'];
			
//			$this->send_email($to,'',$subject,$content,$attachment=null,$cc=null,$bcc=null, $embedded=array()) {
//			$this->send_email($to,'',$subject,$print_Content,'',$cc,$bcc);	
			$this->send_chase_email($to,$user_id,$subject,$print_Content,'',$cc,$bcc);
 
			//echo "testing";
			if(count($report_send_count)> 0){
				$count_chase								= $report_send_count[0]['ChaseEmailDetail']['email_count'] + 1;
				$this->ChaseEmailDetail->updateAll(array('ChaseEmailDetail.email_count' =>"'$count_chase'",'ChaseEmailDetail.modified'=>'NOW()'),array('ChaseEmailDetail.case_master_id'=>$master_id,'ChaseEmailDetail.part35_id'=>$part35_id));
			}else{	
				$save_arr									= array();
				$save_arr['case_id']						= $case_dl['CaseMaster']['case_id'];
				$save_arr['case_master_id']					= $master_id;	
				$save_arr['part35_id']						= $part35_id;	
				$save_arr['email_count']					= 1;
				$save_arr['created']						= date("Y-m-d : H:i:s");
				$save_arr['modified']						= date("Y-m-d : H:i:s");	
				$this->ChaseEmailDetail->saveAll($save_arr);
			} 
			
			$case_log_arr									= array();
			$case_log_arr['case_master_id'] 				= $master_id;
			$case_log_arr['action'] 						= 84;
			$case_log_arr['done_by'] 						= $this->Session->read('Auth.User.id');
			if($part35 != 0 &&  $part35 != null){
				$case_log_arr['comments'] 						= 'Part35 Report Chase email sent to ('.$this->data['ChaseMail']['PrimaryEmail'].')';
			}else if($case_dl['CaseMaster']['case_seq_no'] > 0){
				$case_log_arr['comments'] 						= 'Addendum/Amendment Report Chase email sent to ('.$this->data['ChaseMail']['PrimaryEmail'].')';
			}else{
				$case_log_arr['comments'] 						= 'Report Chase email sent to ('.$this->data['ChaseMail']['PrimaryEmail'].')';
			}
			$this->CommonFunctions->updateCaseHistory($case_log_arr);	
			$shadow_false											= 1;	
			$this->Session->setFlash("Report Chase Email Sent.",'default', array('class' => 'message success'));				
		}else{
			$joins													= array();
			if($part35 != 0 &&  $part35 != null){
				$joins[]											= array(
																	'table'=>'appointments',
																	'alias'=>'Appointment',
																	'type'=>'LEFT',
																	'conditions'=>array('Part35OrAddendumLetter.case_id = Appointment.case_id'),
																	);
				$joins[]												= array(
																	'table'=>'case_users',
																	'alias'=>'CaseUser',
																	'type'=>'LEFT',
																	'conditions'=>array('CaseUser.case_master_id = Part35OrAddendumLetter.case_master_id')
																	);
			}else{
				$joins[]												= array(
																	'table'=>'appointments',
																	'alias'=>'Appointment',
																	'type'=>'LEFT',
																	'conditions'=>array('CaseMaster.case_id = Appointment.case_id'),
																	);
				$joins[]												= array(
																	'table'=>'case_users',
																	'alias'=>'CaseUser',
																	'type'=>'LEFT',
																	'conditions'=>array('CaseUser.case_master_id = CaseMaster.id')
																	);
			}
			
			$joins[]												= array(
																	'table'=>'users',
																	'alias'=>'User',
																	'type'=>'LEFT',
																	'conditions'=>array('Appointment.expert_id = User.id'),
																	);
			$joins[]												= array(
																	'table'=>'communications',
																	'alias'=>'Communication',
																	'type'=>'LEFT',
																	'conditions'=>array('Appointment.expert_id = Communication.user_id'),
																	);
			$joins[]												= array(
																	'table'=>'case_claimant_details',
																	'alias'=>'CaseClaimantDetail',
																	'type'=>'LEFT',
																	'conditions'=>array('Appointment.case_master_id = CaseClaimantDetail.case_master_id'),
																	);
			$joins[]												= array(
																	'table'=>'addresses',
																	'alias'=>'Address',
																	'type'=>'LEFT',
																	'conditions'=>array('Address.user_id = Appointment.expert_id'),
																	);
			$joins[]												= array(
																	'table'=>'case_accident_details',
																	'alias'=>'CaseAccidentDetail',
																	'type'=>'LEFT',
																	'conditions'=>array('CaseAccidentDetail.case_master_id = Appointment.case_master_id'),
																	);
			$joins[]												= array(
																	'table'=>'addresses',
																	'alias'=>'AddressC',
																	'type'=>'LEFT',
																	'conditions'=>array('CaseClaimantDetail.id = AddressC.case_claimant_detail_id'),
																	);
			
			$joins[]												= array(
																	'table'=>'slot_parents',
																	'alias'=>'SlotParent',
																	'type'=>'LEFT',
																	'conditions'=>array('Appointment.slot_parent_id = SlotParent.id')
																	);
			$joins[]												= array(
																	'table'=>'consulting_venues',
																	'alias'=>'ConsultingVenue',
																	'type'=>'LEFT',
																	'conditions'=>array('ConsultingVenue.id = SlotParent.consulting_venue_id')
																	);
			$joins[]												= array(
																	'table'=>'addresses',
																	'alias'=>'AddressE',
																	'type'=>'LEFT',
																	'conditions'=>array('ConsultingVenue.id = AddressE.consulting_venue_id')
																	);
		
			$joins[]												= array(
																	'table'=>'companies',
																	'alias'=>'CompanyName',
																	'type'=>'LEFT',
																	'conditions'=>array('CompanyName.user_id = CaseUser.user_id')
																	);
			$joins[]												= array(
																	'table'=>'users',
																	'alias'=>'UserP',
																	'type'=>'LEFT',
																	'conditions'=>array('UserP.id = CaseUser.user_id')
																	);
			if($part35 != 0 &&  $part35 != null){
				
				$joins[]											= array(
																	'table'=>'case_masters',
																	'alias'=>'CaseMaster',
																	'type'=>'LEFT',
																	'conditions'=>array('CaseMaster.id = Part35OrAddendumLetter.case_master_id'),
																	);
				$joins[]											= array(
																	'table'=>'report_masters',
																	'alias'=>'ReportMaster',
																	'type'=>'LEFT',
																	'conditions'=>array('CaseMaster.report_master_id = ReportMaster.id'),
																	);
																	
				$case_details										= $this->Part35OrAddendumLetter->find('first',array('fields'=>array('Part35OrAddendumLetter.*,User.*,CaseMaster.*,CaseClaimantDetail.*,Address.*,AddressC.*,CaseAccidentDetail.*,Appointment.*,ReportMaster.id,ReportMaster.value,AddressE.*,CompanyName.name,CaseUser.user_id,Communication.report_email'),'joins'=>$joins,'conditions'=>array('CaseUser.user_id'=>$user_id,'Part35OrAddendumLetter.id'=>$part35,'UserP.status'=>'active','NOT'=>array('CaseUser.status_id'=>$status_Arr),'OR'=>array('CaseUser.report_file_path is NULL','CaseUser.report_file_path'=>'')),'group' => 'CaseUser.case_master_id' ));
				
				
			}else{
				$joins[]											= array(
																	'table'=>'report_masters',
																	'alias'=>'ReportMaster',
																	'type'=>'LEFT',
																	'conditions'=>array('CaseMaster.report_master_id = ReportMaster.id'),
																	);
				
				$case_details										= $this->CaseMaster->find('first',array('fields'=>array('User.*,CaseMaster.*,CaseClaimantDetail.*,Address.*,AddressC.*,CaseAccidentDetail.*,Appointment.*,ReportMaster.id,ReportMaster.value,AddressE.*,CompanyName.name,CaseUser.user_id,Communication.report_email'),'conditions'=>array('CaseUser.status_id !='=>Configure::read('status_hold'),'CaseUser.user_id'=>$user_id,'NOT'=>array('CaseUser.status_id'=>$status_Arr),'OR'=>array('CaseUser.report_file_path is NULL','CaseUser.report_file_path'=>''),'CaseMaster.id'=>$master_id,'Address.address_type'=>'','Appointment.status_id'=>Configure::read('status_Booked'),'UserP.status'=>'active'),'joins'=>$joins,'recursive'=> -1));
			}
			
			$app_date_time											= date("d/m/Y",strtotime($case_details['Appointment']['slot_date'])).' @ '.date('H:i ',strtotime($case_details['Appointment']['slot_start_time']));
			$address								= '';
			$address	.= ucwords($case_details['User']['title']).' '.$case_details['User']['forename'].' '.$case_details['User']['surname'].'<br>';
			if($case_details['Address']['address1'] !=''){
				$address	.= $case_details['Address']['address1'].'<br>';
			}
			if($case_details['Address']['address2'] !=''){
				$address	.= $case_details['Address']['address2'].'<br>';
			}
			if($case_details['Address']['town'] !=''){
				$address	.= $case_details['Address']['town'].'<br>';
			}
			if($case_details['Address']['address1'] !=''){
				$address	.= $case_details['Address']['postcode'].'<br>';
			}
			
			$address_c								= '';
			if($case_details['AddressC']['address1']!='' || $case_details['AddressC']['address1']!=null){
				$address_c  .= $this->EncryptionFunctions->aes_decrypt($case_details['AddressC']['address1']).'<br>';
			}
			if($case_details['AddressC']['address2']!='' || $case_details['AddressC']['address2']!=null){
				$address_c  .= $this->EncryptionFunctions->aes_decrypt($case_details['AddressC']['address2']).'<br>';
			}
			if($case_details['AddressC']['address3']!='' || $case_details['Address']['address3']!=null){
				$address_c  .= $this->EncryptionFunctions->aes_decrypt($case_details['AddressC']['address3']).'<br>';
			}
			if($case_details['AddressC']['address4']!='' || $case_details['AddressC']['address4']!=null){
				$address_c  .= $this->EncryptionFunctions->aes_decrypt($case_details['AddressC']['address4']).'<br>';
			}
			if($case_details['AddressC']['address5']!='' || $case_details['AddressC']['address5']!=null){
				$address_c  .= $this->EncryptionFunctions->aes_decrypt($case_details['AddressC']['address5']).'<br>';
			}
			if($case_details['AddressC']['town']!='' || $case_details['AddressC']['town']!=null){
				$address_c  .= $this->EncryptionFunctions->aes_decrypt($case_details['AddressC']['town']).'<br>';
			}
			if($case_details['AddressC']['county']!='' || $case_details['AddressC']['county']!=null){
				$address_c  .= $this->EncryptionFunctions->aes_decrypt($case_details['AddressC']['county']).'<br>';
			}
			if($case_details['Address']['postcode']!='' || $case_details['Address']['postcode']!=null){
				$address_c  .= $this->EncryptionFunctions->aes_decrypt($case_details['AddressC']['postcode']).'<br>';
			}
			
			
			$venue_address	='';
			if(isset($case_details['ConsultingVenue']['name']) && $case_details['ConsultingVenue']['name'] !=""){
				$venue_address =$case_details['ConsultingVenue']['name'];
			}
			if(isset($case_details['AddressE']['address1']) && $case_details['AddressE']['address1'] !=""){
				$venue_address =$case_details['AddressE']['address1'];
			}
			if(isset($case_details['AddressE']['address2']) && $case_details['AddressE']['address2'] !=""){
				$venue_address .="<br>".$case_details['AddressE']['address2'];
			}
			if(isset($case_details['AddressE']['address3']) && $case_details['AddressE']['address3'] !=""){
				$venue_address .="<br>".$case_details['AddressE']['address3'];
			}
			if(isset($case_details['AddressE']['town']) && $case_details['AddressE']['town'] !=""){
				$venue_address .="<br>".$case_details['AddressE']['town'];
			}
			if(isset($case_details['AddressE']['county']) && $case_details['AddressE']['county'] !=""){
				$venue_address .="<br>".$case_details['AddressE']['county'];
			}
			if(isset($case_details['AddressE']['postcode']) && $case_details['AddressE']['postcode'] !=""){
				$venue_address .="<br>".$case_details['AddressE']['postcode'];
			}
			
			if($part35 != 0 &&  $part35 != null){
				$addtional_details								= 	'<td align="left" valign="top" style="font-weight:bold;">
																	Part35 Request Date
																	</td>
																	<td align="left" valign="top" >
																	<span style="color:red">'.date('d/m/Y',strtotime($case_details['Part35OrAddendumLetter']['created'])).'</span>
																	</td>';
				$subject										= 'Part35 Report Chase '.$email_count;
				$app_date_time 									=	'<span>'.$app_date_time.'</span>';
				$content_dtl									= 	'<p>
																			We have not received a reply to our recent request for comments on questions raised by the third party/Solicitors.
																		</p>
																		<p>
																			If you are awaiting for further notes, records or documentation from ourselves, please contact us immediately in order that we can progress matters.
																		</p>
																		<p>
																			If you have forwarded the report within the last few days, then please ignore this email.
																		</p>
																		<p>
																		If the report is still being processed, we will anticipate receipt of your report as soon as possible from the date of this email, unless we hear from you to the contrary.
																		</p>
																		<p>
																		Thank you for your co-operation with this request.
																		</p>
																		<p>
																		<p>Yours sincerely,</p>
																		<p><strong>'.$case_details['CompanyName']['name'].'</strong></p>
																		<p style= "border-top: solid 1px #000;font-size:11px;">
																		<strong>Disclaimer - </strong>This email and any files transmitted with it are confidential and
																		contain privileged or copyright information. You must not present
																		this message to another party without gaining permission from the
																		sender. If you are not the intended recipient you must not copy,
																		distribute or use this email or the information contained in it for
																		any purpose other than to notify us <br />
																		<br />
																		If you have received this message in error, please notify the sender
																		immediately, and delete this email from your system. We do not
																		guarantee that this material is free from viruses or any other
																		defects although due care has been taken to minimise the risk. Any
																		views expressed in this message are those of the individual sender,
																		except where the sender specifically states them to be the views of
																		Coral Technologies Ltd. <br />
																		<br />
																		Coral Technologies Limited, Registered in England and Wales, number
																		01614133470, Office: Readon House,2A Gatley Road,Cheadle SK8 1PY.
																	</p>';
			}else if ($case_details['CaseMaster']['case_seq_no'] > 0){
				
				if($case_details['CaseMaster']['amendment_subject'] == 'Amended report'){
					$type_report								= 'Amendment Report';
					$created_cat								= 'Amendment Request Date';
				}else{
					$type_report								= 'Addendum report';
					$created_cat								= 'Addendum Request Date';
				}
				$subject										= 	'Report Chase '.$email_count;
				$addtional_details								= 	'<td align="left" valign="top" style="font-weight:bold;">
																	 '.$created_cat.'
																	</td>
																	<td align="left" valign="top" >
																	<span style="color:red">'.date('d/m/Y',strtotime($case_details['CaseMaster']['created'])).'</span>
																	</td>';
				$app_date_time 									=	'<span>'.$app_date_time.'</span>';
				$content_dtl									= 	'<p>
																		We are waiting to receive the '.$type_report.' for our client , whom you examined on ('.date('d/m/Y',strtotime($case_details['Appointment']['slot_date'])).')
																	</p>
																	<p>
																		If you are awaiting for further notes, records or documentation from ourselves, please contact us immediately in order that we can progress matters.
																	</p>
																	<p>
																		If you have forwarded the report within the last few days, then please ignore this email.
																	</p>
																	<p>
																	If the report is still being processed, we will anticipate receipt of your report as soon as possible from the date of this email, unless we hear from you to the contrary.
																	</p>
																	<p>
																	Thank you for your co-operation with this request.
																	</p>
																	<p>
																	<p>Yours sincerely,</p>
																	<p><strong>'.$case_details['CompanyName']['name'].'</strong></p>
																	<p style= "border-top: solid 1px #000;font-size:11px;">
																	<strong>Disclaimer - </strong>This email and any files transmitted with it are confidential and
																	contain privileged or copyright information. You must not present
																	this message to another party without gaining permission from the
																	sender. If you are not the intended recipient you must not copy,
																	distribute or use this email or the information contained in it for
																	any purpose other than to notify us <br />
																	<br />
																	If you have received this message in error, please notify the sender
																	immediately, and delete this email from your system. We do not
																	guarantee that this material is free from viruses or any other
																	defects although due care has been taken to minimise the risk. Any
																	views expressed in this message are those of the individual sender,
																	except where the sender specifically states them to be the views of
																	Coral Technologies Ltd. <br />
																	<br />
																	Coral Technologies Limited, Registered in England and Wales, number
																	01614133470, Office: Readon House,2A Gatley Road,Cheadle SK8 1PY.
																	</p>';
			}else{
				$addtional_details								= 	'';
				$app_date_time 									=	'<span style="color:red">'.$app_date_time.'</span>';
				$subject										= 	'Report Chase '.$email_count;
				$content_dtl									= 	'<p>
																	We are waiting to receive the report for our client , whom you examined  on ('.date('d/m/Y',strtotime($case_details['Appointment']['slot_date'])).')
																	</p>
																	<p>
																	If you are awaiting for further notes, records or documentation from ourselves, please contact us immediately in order that we can progress matters.
																	</p>
																	<p>
																	If you have forwarded the report within the last few days, then please ignore this email.
																	</p>
																	<p>
																	If the report is still being processed, we will anticipate receipt of your report as soon as possible from the date of this email, unless we hear from you to the contrary.
																	</p>
																	<p>
																	Thank you for your co-operation with this request.
																	</p>
																	
																	<p>
																	<p>Yours sincerely,</p>
																	<p><strong>'.$case_details['CompanyName']['name'].'</strong></p>
																	<p style= "border-top: solid 1px #000;font-size:11px;">
																	<strong>Disclaimer - </strong>This email and any files transmitted with it are confidential and
																	contain privileged or copyright information. You must not present
																	this message to another party without gaining permission from the
																	sender. If you are not the intended recipient you must not copy,
																	distribute or use this email or the information contained in it for
																	any purpose other than to notify us <br />
																	<br />
																	If you have received this message in error, please notify the sender
																	immediately, and delete this email from your system. We do not
																	guarantee that this material is free from viruses or any other
																	defects although due care has been taken to minimise the risk. Any
																	views expressed in this message are those of the individual sender,
																	except where the sender specifically states them to be the views of
																	Coral Technologies Ltd. <br />
																	<br />
																	Coral Technologies Limited, Registered in England and Wales, number
																	01614133470, Office: Readon House,2A Gatley Road,Cheadle SK8 1PY.
																	</p>';
			}
								
			$print_Content										= 	'<div style="padding:20px;">
																		<table cellspacing="0" cellpadding="15" border="0" width="100%"  style="border:1px solid #000;font-family:Cambria,serif;font-size: 11.5pt;;">
																		<tbody>
																			<tr>
																				<td align="left" valign="top" width="100%" colspan="2" style="line-height:2;">
																				<strong>Dear '.ucwords($case_details['User']['title']).' '.$case_details['User']['forename'].' '.$case_details['User']['surname'].'</strong><br>
																				</td>
																			</tr>
																			<tr style="font-size: 11.5pt;;">
																				<td colspan="2">
																				<div style="width: 100%;text-align: center;padding: 10px 0px;font: bold 20px Arial;">
																					Report Chase - '.$email_count.'
																				</div>
																				<div>
																					<table cellspacing="0" cellpadding="5" border="0" width="100%" style="border:1px solid #000;font-size:11.5pt;">
																					<tbody>
																					<tr>
																					<td align="left" valign="top" style="font-weight:bold;" width="25%" >
																					Claimant Name
																					</td>
																					<td align="left" valign="top" width="25%" >
																					'.ucwords($this->EncryptionFunctions->aes_decrypt($case_details['CaseClaimantDetail']['title'])).' '.$this->EncryptionFunctions->aes_decrypt($case_details['CaseClaimantDetail']['forename']).' '.$this->EncryptionFunctions->aes_decrypt($case_details['CaseClaimantDetail']['surname']).'
																					</td>
																					<td align="left" valign="top" style="font-weight:bold;" width="25%" >
																					Address
																					</td>
																					<td align="left" valign="top" width="25%" >
																					'.$address_c.'
																					</td>
																					</tr>
																					<tr>
																					<td align="left" valign="top" style="font-weight:bold;">
																					Date of Birth	
																					</td>
																					<td align="left" valign="top">
																					'.date('d/m/Y',strtotime($case_details['CaseClaimantDetail']['dateofbirth'])).'
																					</td>
																					<td align="left" valign="top" style="font-weight:bold;">
																					Accident Date
																					</td>
																					<td align="left" valign="top" >
																					'.date('d/m/Y',strtotime($case_details['CaseAccidentDetail']['accident_date'])).'
																					</td>
																					</tr>
																					<tr>
																					<td align="left" valign="top" style="font-weight:bold;">
																					Appointment Date
																					</td>
																					<td align="left" valign="top" >
																					'.$app_date_time.'
																					</td>
																					'.$addtional_details.'
																					</tr>
																					<tr>
																					<td align="left" valign="top" style="font-weight:bold;">
																					Clinic Address
																					</td>
																					<td align="left" valign="top" >
																					'.$venue_address.'
																					</td>
																					<td align="left" valign="top" style="font-weight:bold;">
																					Our reference
																					</td>
																					<td align="left" valign="top" >
																					'.$case_details['Appointment']['case_id'].'
																					</td>
																					</tr>
																					<tr>
																					<td align="left" valign="top" style="font-weight:bold;">
																					Report Type
																					</td>
																					<td align="left" valign="top" >
																					'.$case_details['ReportMaster']['value'].'
																					</td>
																					<td align="left" valign="top" style="font-weight:bold;">
																					Accident Type
																					</td>
																					<td align="left" valign="top" >
																					'.$case_details['CaseAccidentDetail']['accident_type'].'
																					</td>
																					</tr>
																					</tbody>
																					</table>
																				</div>	 
																				</td>
																			</tr>
																			<tr style="font-size:11.5pt;">
																				<td colspan="2">
																				'.$content_dtl.'	
																				</td>
																			</tr>
																			</tbody>
																		</table>
																	</div>';	
			$this->set('report_com',$case_details['Communication']['report_email']);
			$this->set('print_Content',$print_Content);
			$this->set('subject',$subject);
		}
		$this->set('shadow_close',$shadow_false);
	}
	
	function send_chase_email($to,$from_id=null,$subject,$content,$attachment=null,$cc=null,$bcc=null, $embedded=array()) {
		$this->Email->IsHTML(true);
		// the email content is just a (html) view in app/views/{controller}/emails/testmail.ctp
		//$this->Email->renderBody('test');
		$this->Email->Body = $content;
		// subject
		$this->Email->Subject = $subject;

		// sender
		$getFromEmailDetails 	= $this->User->find('first', array('conditions' => array('User.id' =>$from_id), 'recursive'=>2 ));
		
		$communicatio_arr	 	= $this->Communication->find('first', array('recursive' => -1, 'conditions' => array('Communication.user_id' => $from_id)));

		if (!empty($communicatio_arr['Communication']['report_email'])) {
			$from_email = $communicatio_arr['Communication']['report_email'];
		} else {
			$from_email = $getFromEmailDetails['User']['email'];
		}
		 

		if (!empty($getFromEmailDetails['Company']['name'])) {
			$from_name = $getFromEmailDetails['Company']['name'];
		} else {
			$from_name = ucfirst(trim($getFromEmailDetails['User']['title']." ". $getFromEmailDetails['User']['forename']." ".				$getFromEmailDetails['User']['middlename']." ".$getFromEmailDetails['User']['surname']));
		}
		$this->Email->SetFrom($from_email, $from_name);
		
		$this->Email->replyTo = $from_email;

		//$from_email = Configure::read('to_email');
		//$this->Email->SetFrom($from_email, 'Coral Technologies Admin');
		  
		// Attachment
		if($attachment){
			foreach($attachment as $file){
				//echo "---attchmnt--".	$file;
				$this->Email->Addattachment($file);
			}
		}

		// recipients
		if($to){
			foreach($to as $key=>$val){
				$to=$val;
				$to_name='';

				if (!empty($to)) {
					$this->Email->AddAddress($to, $to_name);
				}
			}
		}

		//cc
		if($cc){
			foreach($cc as $key=>$val){
				$cc_email=$val;
				$cc_name='';

				if (!empty($cc_email)) {
					$this->Email->AddCC($cc_email, $cc_name);
				}
			}

		}
		//cc
		if($bcc){
			foreach($bcc as $key=>$val){
				$bcc_email=$val;
				$bcc_name='';

				if (!empty($bcc_email)) {
					$this->Email->AddBCC($bcc_email, $bcc_name);
				}
			}

		}
		//die;
		// send!

		if (!empty($embedded)) {
			//debug($embedded);
			foreach ($embedded AS $image) {
				//debug($image->filename." ".$image->cid." ".$image->name);
				$this->Email->AddEmbeddedImage($image->filename,$image->cid,$image->name);
			}
		}

		if(@$this->Email->Send()){
			//echo "Email send";			
			$this->Email->ClearAddresses();
			$this->Email->ClearCCs();
			$this->Email->ClearBCCs();
			$this->Email->ClearAttachments();	
			$this->Email->ClearReplyTos();
			$this->Email->ClearAllRecipients();
			
			return true;
		} else {
			//echo "Email not send ".$this->Email->ErrorInfo;
			return false;
		}
	}
}

?>