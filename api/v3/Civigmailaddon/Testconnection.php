<?php
use CRM_Civigmailaddon_ExtensionUtil as E;

/**
 * Civigmailaddon.Testconnection API
 *
 * API to test the connection
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_civigmailaddon_Testconnection($params) {
  $isConnected = TRUE;

  $result['is_connected'] = $isConnected;
  return civicrm_api3_create_success($result, $params, 'Civigmailaddon', 'Testconnection');
}