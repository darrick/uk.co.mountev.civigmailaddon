<?php
require_once 'CRM/Core/Page.php';
class CRM_Civigmailaddon_Page_Logging extends CRM_Core_Page {
  function run() {
    CRM_Utils_System::setTitle(ts('Gmail Addon Logs'));
    $this->assign('currentTime', date('Y-m-d H:i:s'));

    // get log data
    $selectQuery = "SELECT * FROM `gmailaddon_log`
    ORDER BY `datetime` DESC
    LIMIT 500";

    $log = CRM_Core_DAO::executeQuery($selectQuery);
    $result = array();
    while ($log->fetch()) {
      $result[$log->datetime] = $log->toArray();
    }
    $this->assign('log', $result);
    parent::run();
  }
}