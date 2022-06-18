<?php
use CRM_Civigmailaddon_ExtensionUtil as E;

/**
 * Civigmailaddon.Getactivity API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see https://docs.civicrm.org/dev/en/latest/framework/api-architecture/
 */
function _civicrm_api3_civigmailaddon_Getactivity_spec(&$spec) {
  $spec['id']['api.required'] = 1;
}

/**
 * Civigmailaddon.Getactivity API
 *
 * API to get activity by activityID
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_civigmailaddon_Getactivity($params) {
  $result = [];

  // get activity info
  $activityParams['id'] = $params['id'];
  try {
    $result = civicrm_api3('Activity', 'get', $activityParams, 'Civigmailaddon', 'Getactivity', $params);

    // activity types
    $activityTypes = CRM_Core_PseudoConstant::activityType(TRUE, TRUE, FALSE, 'name', TRUE);
    $result['activity_types'] = $activityTypes;

    // activity status
    $activityStatus = CRM_Core_PseudoConstant::activityStatus('name');
    $result['activity_status'] = $activityStatus;
  }
  catch (CiviCRM_API3_Exception $e) {
    $error = $e->getMessage();
    CRM_Core_Error::debug_log_message($error);
  }

  return civicrm_api3_create_success($result, $params, 'Civigmailaddon', 'Getactivity');
}

