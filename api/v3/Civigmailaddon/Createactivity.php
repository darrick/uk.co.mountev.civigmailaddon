<?php
use CRM_Civigmailaddon_ExtensionUtil as E;

/**
 * Civigmailaddon.Createactivity API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see https://docs.civicrm.org/dev/en/latest/framework/api-architecture/
 */
function _civicrm_api3_civigmailaddon_Createactivity_spec(&$spec) {
  $spec['source_api_key']['api.required'] = 1;
}

/**
 * Civigmailaddon.Createactivity API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_civigmailaddon_Createactivity($params) {
  // get source_contact_id by api_key
  // field mapping -
  // contact with API Key => activity source sontact
  $source_contact_id = CRM_Core_DAO::getFieldValue('CRM_Contact_DAO_Contact', $params['source_api_key'], 'id', 'api_key');

  // field mapping -
  // gmail 'FROM' email address => activity target contact
  $targetContactID = _civigmailaddon_contact_create($params['target_contact_email']);
  reset($targetContactID);
  $firstKeyTargetContactID = key($targetContactID);

  // field mapping -
  // gmail 'TO' and 'CC' email address(es) => activity assignee contact(s)
  $assigneeContactIDs = _civigmailaddon_contact_create($params['assignee_contact_email']);

  // build activity params
  $activityParams['source_contact_id']    = $source_contact_id;
  $activityParams['target_contact_id']    = $firstKeyTargetContactID;
  $activityParams['assignee_contact_id']  = array_keys($assigneeContactIDs);
  $activityParams['activity_date_time']   = $params['activity_date_time'];
  $activityParams['activity_type_id']     = $params['activity_type_id'];
  $activityParams['status_id']            = $params['status_id'];
  $activityParams['subject']              = $params['subject'];
  $activityParams['details']              = $params['details'];

  // create activity
  try {
    $resultActivity = civicrm_api3('Activity', 'create', $activityParams, 'Civigmailaddon', 'Createactivity', $params);
  }
  catch (CiviCRM_API3_Exception $e) {
    $error = $e->getMessage();
    CRM_Core_Error::debug_log_message($error);
  }

  // Spec: civicrm_api3_create_success($values = 1, $params = array(), $entity = NULL, $action = NULL)
  return civicrm_api3_create_success($resultActivity, $params, 'Civigmailaddon', 'Createactivity');
}

/**
 * Function to create contact(s) in Civi
 *
 * @param string $gmailContacts list of comma separated Gmail contact(s)
 * @return array $contactID(s) list of contactIDs
 */

function _civigmailaddon_contact_create($gmailContacts) {
  $contactIDs = [];

  if (empty($gmailContacts)) {
    CRM_Core_Error::debug_log_message("Create contact - empty email passed");
    return [];
  }

  // let's extract email from gmail contact
  // example -> John Doe <john.doe@example.com>
  $pattern = '/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i';
  $resultGmailContacts = explode(", ", $gmailContacts);

  foreach($resultGmailContacts as $email) {
    preg_match_all($pattern, $email, $matches);
    $email = $matches[0][0];
    try {
      $result = civicrm_api3('Contact', 'get', ['email' => $email]);
      if ($result['count'] > 0 && $result['count'] == 1) {
        // contact exists
        $contactIDs[$result['id']] = $email;
      }
      else {
        // create contact
        $result = civicrm_api3('Contact', 'create', ['contact_type' => 'individual', 'email' => $email]);
        CRM_Core_Error::debug_var("result", $result);
        $contactIDs[$result['id']] = $email;
      }
    }
    catch (CiviCRM_API3_Exception $e) {
      $error = $e->getMessage();
      CRM_Core_Error::debug_log_message($error);
    }
  }

  return $contactIDs;
}
