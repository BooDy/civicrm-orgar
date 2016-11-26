<?php

require_once 'CRM/Admin/Form/Setting.php';


/**
 * Form controller class
 *
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC43/QuickForm+Reference
 */
class CRM_Orgar_Form_OrgarSettings extends CRM_Core_Form {
  private $_settingFilter = array('group' => 'orgar');

  public function buildQuickForm() {
$default_relationships = civicrm_api3('setting', 'getValue', array('group' => 'orgar', 'name' => 'relationship_types'));
$default_activities = civicrm_api3('setting', 'getValue', array('group' => 'orgar', 'name' => 'activity_types'));
      $this->add(
          'advmultiselect', 
          'relationship_types', 
          ts('Relationship Type'), 
          array('' => ts('- select Relationship -')) + CRM_Contact_BAO_Relationship::getRelationType("Organization"))->setValue($default_relationships);

   $activityType = array('' => ' - select activity - ') + CRM_Core_PseudoConstant::activityType();
                                                                               
   $this->add('advmultiselect', 'activity_types', ts('Activity Type'),               
     $activityType,                                                            
     FALSE                                                                     
   )->setValue($default_activities);
    $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => ts('Submit'),
        'isDefault' => TRUE,
      ),
    ));

    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());
    parent::buildQuickForm();
  }

  public function postProcess() {
    $this->_submittedValues = $this->exportValues();
    $this->saveSettings();
    CRM_Core_Session::setStatus(ts('Organization activity records settings saved"'));
    parent::postProcess();
  }

  /**
   * Get the fields/elements defined in this form.
   *
   * @return array (string)
   */
  function getRenderableElementNames() {
    // The _elements list includes some items which should not be
    // auto-rendered in the loop -- such as "qfKey" and "buttons". These
    // items don't have labels. We'll identify renderable by filtering on
    // the 'label'.
    $elementNames = array();
    foreach ($this->_elements as $element) {
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }
    return $elementNames;
  }

  /**
   * Get the settings we are going to allow to be set on this form.
   *
   * @return array
   */
  function getFormSettings() {
    if (empty($this->_settings)) {
      $settings = civicrm_api3('setting', 'getfields', array('filters' => $this->_settingFilter));
    }
    $extraSettings = civicrm_api3('setting', 'getfields', array('filters' => array('group' => 'orgar')));
    $settings = $settings['values'] + $extraSettings['values'];
    return $settings;
  }
  /**
   * Get the settings we are going to allow to be set on this form.
   *
   * @return array
   */
  function saveSettings() {
    $settings = $this->getFormSettings();
    $values = array_intersect_key($this->_submittedValues, $settings);
    civicrm_api3('setting', 'create', $values);
  }
}
