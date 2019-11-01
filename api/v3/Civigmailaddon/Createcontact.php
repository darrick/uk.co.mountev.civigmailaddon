<?php
use CRM_Civigmailaddon_ExtensionUtil as E;

/**
 * Civigmailaddon.Createcontact API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see https://docs.civicrm.org/dev/en/latest/framework/api-architecture/
 */
function _civicrm_api3_civigmailaddon_Createcontact_spec(&$spec) {
  $spec['email']['api.required'] = 1;
}

/**
 * Civigmailaddon.Createcontact API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_civigmailaddon_Createcontact($params) {
  $result = $contactParams = [];
  // create contact
  try {
    $contactParams['contact_type']  = "Individual";
    $contactParams['first_name']    = $params['first_name'];
    $contactParams['last_name']     = $params['last_name'];
    $contactParams['email']         = $params['email'];

    // update contact if contactID is found
    if (CRM_Utils_Array::value("id", $params)) {
      $contactParams['id'] = $params['id'];
    }

    $result = civicrm_api3('Contact', 'create', $contactParams, 'Civigmailaddon', 'Createcontact', $params);
    // build contact view url
    $contactViewURL = CRM_Utils_System::url('civicrm/contact/view', "reset=1&cid={$result['id']}", TRUE, NULL, FALSE);
    $result['contact_view_url'] = $contactViewURL;
  }
  catch (CiviCRM_API3_Exception $e) {
    $error = $e->getMessage();
    CRM_Core_Error::debug_log_message($error);
  }

  return civicrm_api3_create_success($result, $params, 'Civigmailaddon', 'Createcontact');
}
