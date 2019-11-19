<?php

require_once 'civigmailaddon.civix.php';
use CRM_Civigmailaddon_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/ 
 */
function civigmailaddon_civicrm_config(&$config) {
  _civigmailaddon_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function civigmailaddon_civicrm_xmlMenu(&$files) {
  _civigmailaddon_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function civigmailaddon_civicrm_install() {
  _civigmailaddon_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function civigmailaddon_civicrm_postInstall() {
  _civigmailaddon_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function civigmailaddon_civicrm_uninstall() {
  _civigmailaddon_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function civigmailaddon_civicrm_enable() {
  _civigmailaddon_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function civigmailaddon_civicrm_disable() {
  _civigmailaddon_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function civigmailaddon_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _civigmailaddon_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function civigmailaddon_civicrm_managed(&$entities) {
  _civigmailaddon_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function civigmailaddon_civicrm_caseTypes(&$caseTypes) {
  _civigmailaddon_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function civigmailaddon_civicrm_angularModules(&$angularModules) {
  _civigmailaddon_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function civigmailaddon_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _civigmailaddon_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function civigmailaddon_civicrm_entityTypes(&$entityTypes) {
  _civigmailaddon_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function civigmailaddon_civicrm_themes(&$themes) {
  _civigmailaddon_civix_civicrm_themes($themes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 *
function civigmailaddon_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 *
 */
function civigmailaddon_civicrm_navigationMenu(&$menu) {
  _civigmailaddon_civix_insert_navigation_menu($menu, 'Administer/System Settings', array(
    'label' => E::ts('Gmail Addon Log'),
    'name' => 'gmail_addon_log',
    'url' => 'civicrm/settings/gmail-addon-log',
    'permission' => 'administer CiviCRM',
  ));
  _civigmailaddon_civix_navigationMenu($menu);
}


/**
 * Implements hook_civicrm_alterAPIPermissions().
 * This hook allows you to alter permission structure based on entity and action
 */
function civigmailaddon_civicrm_alterAPIPermissions($entity, $action, &$params, &$permissions) {
  $basic  = ['access AJAX API'];
  $view   = ['access AJAX API', 'view all contacts'];
  $create = ['access AJAX API', 'add contacts'];

  $permissions['civigmailaddon']['getcontact']            = $view;
  $permissions['civigmailaddon']['createcontact']         = $create;
  $permissions['civigmailaddon']['createactivity']        = $create;
  $permissions['civigmailaddon']['createattachment']      = $create;
  $permissions['civigmailaddon']['getactivityresources']  = $basic;
  $permissions['civigmailaddon']['createlog']             = $create;

  // test connection should pass only when all required permissions have been granted
  $permissions['civigmailaddon']['testconnection']        = $basic + $view + $create;
}
