<?php
use CRM_Civigmailaddon_ExtensionUtil as E;

/**
 * Civigmailaddon.Createlog API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_civigmailaddon_Createlog($params) {
  $insertQuery = "INSERT INTO `gmailaddon_log` (`datetime`, `entity`, `action`, `request_type`, `request`, `response`, `params`) VALUES (now(), %1, %2, %3, %4, %5, %6)";
  $insertParams = array(
    1 => array($params['log_entity'], 'String'),
    2 => array($params['log_action'], 'String'),
    3 => array($params['log_request_type'], 'String'),
    4 => array(serialize($params['log_request']), 'String'),
    5 => array(serialize($params['log_response']), 'String'),
    6 => array(serialize($params['log_params']), 'String'),
  );
  try {
      CRM_Core_DAO::executeQuery($insertQuery, $insertParams);
  }
  catch (CRM_Core_Exception $e) {
    $error = $e->getMessage();
    CRM_Core_Error::debug_log_message($error);
  }
  return civicrm_api3_create_success([], $params, 'Civigmailaddon', 'Createlog');
}