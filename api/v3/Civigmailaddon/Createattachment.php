<?php
use CRM_Civigmailaddon_ExtensionUtil as E;

/**
 * Civigmailaddon.Createattachment API
 *
 * API to create attachments
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_civigmailaddon_Createattachment($params) {
  $resultAttachment = [];
  $attachmentsStr = $params['attachments'];
  $attachments = explode(",", $attachmentsStr);

  // create civigmailaddon directory in CiviCRM custom directory [configurable in 'Custom Files Directory' settings]
  $config = CRM_Core_Config::singleton();
  $directoryName = $config->customFileUploadDir;
  CRM_Utils_File::createDir($directoryName);

  if (!empty($attachments)) {
    foreach ($attachments as $attachment) {
      if ($attachment) {
        // extract attachment data
        $attachmentData = explode("--", $attachment);
        $attachmentName     = $attachmentData[0];
        $attachmentMimeType = $attachmentData[1];
        $attachmentSize     = $attachmentData[2];
        $attachmentBlob     = $attachmentData[3];

        // make unique file(s) name(s)
        $fileName = CRM_Utils_File::makeFileName($attachmentName);
        // save the file(s) to 'civigmailaddon' directory
        file_put_contents("$directoryName$fileName", $attachmentBlob);

        // create activity attachment(s)
        try {
          $fileParams = [];
          $fileParams['created_id']   = $params['created_id'];
          $fileParams['mime_type']    = $attachmentMimeType;
          $fileParams['description']  = "Size: " . $attachmentSize . " bytes";
          $fileParams['uri']          = $fileName;

          $result = civicrm_api3('File', 'create', $fileParams);

          // link attachment to the activity
          if (CRM_Utils_Array::value('id', $result) &&
          CRM_Utils_Array::value('activity_id', $params)
          ) {
            $lastActivityID = $params['activity_id'];
            $entityFileDAO = new CRM_Core_DAO_EntityFile();
            $entityFileDAO->entity_table = 'civicrm_activity';
            $entityFileDAO->entity_id = $lastActivityID;
            $entityFileDAO->file_id = $result['id'];
            $entityFileDAO->save();

            // mapping entity id => file_id
            $resultAttachment[$entityFileDAO->entity_id] = $entityFileDAO->file_id;
          }
        }
        catch (CiviCRM_API3_Exception $e) {
          $error = $e->getMessage();
          CRM_Core_Error::debug_log_message($error);
        }
      }
    }
  }
  return civicrm_api3_create_success($resultAttachment, $params, 'Civigmailaddon', 'Createattachment');
}
