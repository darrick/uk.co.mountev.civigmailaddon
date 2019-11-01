<?php
use CRM_Civigmailaddon_ExtensionUtil as E;

/**
 * Civigmailaddon.Getactivityresources API
 *
 * API to get activity resources
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_civigmailaddon_Getactivityresources($params) {
  $result = [];
  // set default titles and helper text
  // Hard coding this for now. We plan to move it as settings configurable from the extension
  $result['txt']['heading']                   = ts('Create Activity');
  $result['txt']['sub_heading']               = ts('');
  $result['txt']['with_contact']              = ts('With Contact');
  $result['txt']['assigned_to']               = ts('Assigned To');
  $result['txt']['date']['title']             = ts('Date');
  $result['txt']['date']['helper_text']       = ts('YYYY-MM-DD HH:MM (Example: 2019-12-25 22:40)');
  $result['txt']['activity_type']['title']    = ts('Activity Type');
  $result['txt']['activity_status']['title']  = ts('Activity Status');
  $result['txt']['subject']['title']          = ts('Subject');
  $result['txt']['subject']['helper_text']    = ts('');
  $result['txt']['details']['title']          = ts('Details');
  $result['txt']['details']['helper_text']    = ts('');
  $result['txt']['attachments']               = ts('Attachment(s)');
  $result['txt']['btn']['create_activity']    = ts('Create Activity');

  // activity types
  $activityTypes = CRM_Core_PseudoConstant::activityType(TRUE, TRUE, FALSE, 'name', TRUE);
  $result['activity_types'] = $activityTypes;

  // activity status
  $activityStatus = CRM_Core_PseudoConstant::activityStatus('name');
  $result['activity_status'] = $activityStatus;

  return civicrm_api3_create_success($result, $params, 'Civigmailaddon', 'Getactivityresources');
}

