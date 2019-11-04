<?php
use CRM_Civigmailaddon_ExtensionUtil as E;

/**
 * Civigmailaddon.Getcontactresources API
 *
 * API to get contact resources
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_civigmailaddon_Getcontactresources($params) {
  $result = [];
  // set default titles and helper text
  // Hard coding this for now. We plan to move it as settings configurable from the extension later on
  // create card resources
  $result['txt']['create']['heading']                       = ts('Create Contact');
  $result['txt']['create']['sub_heading']                   = ts('');
  $result['txt']['create']['first_name']['title']           = ts('First Name');
  $result['txt']['create']['first_name']['helper_text']     = ts('');
  $result['txt']['create']['last_name']['title']            = ts('Last Name');
  $result['txt']['create']['last_name']['helper_text']      = ts('');
  $result['txt']['create']['email']['title']                = ts('Email');
  $result['txt']['create']['job_title']['title']            = ts('Job Title');
  $result['txt']['create']['job_title']['helper_text']      = ts('');
  $result['txt']['create']['external_id']['title']          = ts('External ID');
  $result['txt']['create']['external_id']['helper_text']    = ts('');
  $result['txt']['create']['gender']['title']               = ts('Gender');
  $result['txt']['create']['date_of_birth']['title']        = ts('Date of Birth');
  $result['txt']['create']['date_of_birth']['helper_text']  = ts('YYYY-MM-DD');
  $result['txt']['create']['btn']                           = ts('Create Contact');

  // update card resources
  $result['txt']['update']['heading']                       = ts('Update Contact');
  $result['txt']['update']['sub_heading']                   = ts('');
  $result['txt']['update']['first_name']['title']           = ts('First Name');
  $result['txt']['update']['first_name']['helper_text']     = ts('');
  $result['txt']['update']['last_name']['title']            = ts('Last Name');
  $result['txt']['update']['last_name']['helper_text']      = ts('');
  $result['txt']['update']['email']['title']                = ts('Email');
  $result['txt']['update']['job_title']['title']            = ts('Job Title');
  $result['txt']['update']['job_title']['helper_text']      = ts('');
  $result['txt']['update']['contact_id']['title']           = ts('Contact ID');
  $result['txt']['update']['external_id']['title']          = ts('External ID');
  $result['txt']['update']['external_id']['helper_text']    = ts('');
  $result['txt']['update']['gender']['title']               = ts('Gender');
  $result['txt']['update']['date_of_birth']['title']        = ts('Date of Birth');
  $result['txt']['update']['date_of_birth']['helper_text']  = ts('YYYY-MM-DD');
  $result['txt']['update']['btn']                           = ts('Update Contact');

  // gender
  $gender = CRM_Core_PseudoConstant::get('CRM_Contact_DAO_Contact', 'gender_id');
  $result['gender'] = $gender;

  return civicrm_api3_create_success($result, $params, 'Civigmailaddon', 'Getcontactresources');
}

