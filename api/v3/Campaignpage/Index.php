<?php

/**
 * Campaignpage.Index API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_campaignpage_Index_spec(&$spec) {
  $spec['contact_id']['api.required'] = 1;
}

/**
 * Campaignpage.Index API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_campaignpage_Index($params) {
  $pages = CRM_Contactpcp_DAO_CampaignPages::allForContact($params['contact_id']);

  return civicrm_api3_create_success($pages, $params, 'CampaignPage', 'Index');
}
