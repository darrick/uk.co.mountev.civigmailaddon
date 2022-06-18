<?php
use CRM_Civigmailaddon_ExtensionUtil as E;

/**
 * Civigmailaddon.Getcontact API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see https://docs.civicrm.org/dev/en/latest/framework/api-architecture/
 */
function _civicrm_api3_civigmailaddon_Getcontact_spec(&$spec) {
  $spec['email']['api.required'] = 1;
}

/**
 * Civigmailaddon.Getcontact API
 *
 * API to get contacts by primary email
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_civigmailaddon_Getcontact($params) {
  $result = [];

  // get contact info
  $contactParams['email'] = $params['email'];
  try {
    $result = civicrm_api3('Contact', 'get', $contactParams, 'Civigmailaddon', 'Getcontact', $params);

    // we not handling duplicate contacts for now.
    // always get the first contact
    reset($result['values']);
    $firstContactID = key($result['values']);

    // no contact found - it's a new contact
    if (!$firstContactID) {
      return $result;
    }
    // build contact view url
    $contactViewURL = CRM_Utils_System::url('civicrm/contact/view', "reset=1&cid={$firstContactID}", TRUE, NULL, FALSE);
    $result['values'][$firstContactID]['contact_view_url'] = $contactViewURL;
  }
  catch (CiviCRM_API3_Exception $e) {
    $error = $e->getMessage();
    CRM_Core_Error::debug_log_message($error);
  }

  return civicrm_api3_create_success($result['values'][$firstContactID], $params, 'Civigmailaddon', 'Getcontact');
}

