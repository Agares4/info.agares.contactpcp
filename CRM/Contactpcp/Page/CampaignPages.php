<?php

require_once 'CRM/Core/Page.php';

class CRM_Contactpcp_Page_CampaignPages extends CRM_Core_Page {
  public function run() {
    CRM_Utils_System::setTitle(ts('Personal campaign pages'));
    $statusNames = CRM_Core_OptionGroup::values("pcp_status", FALSE, FALSE, FALSE, NULL, 'name');

    $query =
    "SELECT
       pcp.id,
       pcp.title,
       pcp.status_id,
       pcp.page_id,
       count(cc.total_amount) as contribution_count,
       sum(cc.total_amount) as amount_raised,
       pcp.goal_amount,
       pcp.currency
     FROM civicrm_pcp pcp
     LEFT JOIN civicrm_contribution_soft cs ON ( pcp.id = cs.pcp_id )
     LEFT JOIN civicrm_contribution cc ON ( cs.contribution_id = cc.id)
     WHERE pcp.contact_id = %1
     GROUP BY pcp.id";

    $cpages = CRM_Core_DAO::executeQuery($query, array(1 => array($_GET['cid'], 'Integer')));
    $pages = array();
    while($cpages->fetch()) {
      $pages[] = array(
        'id' => $cpages->id,
        'title' => $cpages->title,
        'status' => $statusNames[$cpages->status_id],
        'page' => CRM_PCP_BAO_PCP::getPcpPageTitle($cpages->page_id, 'contribute'),
        'contribution_count' => $cpages->contribution_count,
        'amount_raised' => $cpages->amount_raised,
        'goal_amount' => $cpages->goal_amount,
        'currency' => $cpages->currency,
        'edit' => CRM_Utils_System::url('civicrm/pcp/info', 'action=update&reset=1&id=' . $cpages->id)
      );
    }

    $this->assign('pages', $pages);

      parent::run();
  }
}
