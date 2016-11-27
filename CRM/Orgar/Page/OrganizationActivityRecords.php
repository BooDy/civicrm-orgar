<?php

require_once 'CRM/Core/Page.php';

class CRM_Orgar_Page_OrganizationActivityRecords extends CRM_Core_Page {
    public function run() {
        // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
        CRM_Utils_System::setTitle(ts('Organization Activity Records'));
        if (CRM_Core_Permission::check('administer civicrm')) {

            $contacts = array();
            $activities_tracked = civicrm_api3('setting', 'getvalue', array('name' => 'activity_types'));
            $relationships_tracked = civicrm_api3('setting', 'getvalue', array('name' => 'relationship_types'));
            foreach($relationships_tracked as $key) {
                $key = explode("_", $key);
                $params = Array();
                $params['sequential'] = 1;
                $params['relationship_type_id'] = $key[0];
                switch($key[1]) {
                case 'a':
                    $params['contact_id_b'] = $_GET['cid'];
                    break;
                case 'b':
                    $params['contact_id_a'] = $_GET['cid'];
                    break;
                }
                $relationships = civicrm_api3('Relationship', 'get', $params);
                foreach($relationships['values'] as $key => $relationship) {
                        $individual = ($relationship['contact_id_a'] == $key[0]) ? $relationship['contact_id_b'] : $relationship['contact_id_a']; 
                        $params = array(
                             'contact_id' => $individual,
                             'record_type_id' => 'Activity Assignees',
                             'api.Activity.get' => array('activity_type_id' => array('IN' => $activities_tracked)),
                             'api.Contact.get' => array('contact_type' => 'Individual'),
                             'api.OptionValue.get' => array(),
                        );
                        $activities[$individual] = civicrm_api3('ActivityContact', 'get', $params);
                }
            }

            foreach($activities as $key => $value) {
                $Contacts[$key] = array();
                foreach($activities[$key]['values'] as $id => $activityCard) {
                $Contacts[$key]['name'] = $activities[$key]['values'][$id]['api.Contact.get']['values'][0]['display_name'];
                $Contacts[$key]['id'] =   $activities[$key]['values'][$id]['api.Contact.get']['values'][0]['contact_id'];
                $Contacts[$key]['activities'] = $activities[$key]['values'][$id]['api.Activity.get']['values'];
                }
            }
$this->assign('contacts', $Contacts);
        }

 // Declare $config;
 $config = & CRM_Core_Config::singleton();

 $baseUrl = $config->userFrameworkBaseURL;
        $this->assign('baseUrl', $baseUrl);

        parent::run();
    }
}
