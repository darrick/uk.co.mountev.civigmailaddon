<?php
use CRM_Civigmailaddon_ExtensionUtil as E;

/**
 * Civigmailaddon.Gethelp API
 *
 * API to get contacts by primary email
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_civigmailaddon_Gethelp($params) {
  $result = [
    'help_text'  => 'For any bug reports please raise issue on our <a href="https://github.com/mountev/uk.co.mountev.civigmailaddon">github extension</a> with any screenshots and error logs. <br><br>For any improvements or feature requests please contact us at info@mountev.co.uk.',
    'help_title' => E::ts('Help & Support')
  ];

  return civicrm_api3_create_success($result, $params, 'Civigmailaddon', 'Gethelp');
}

