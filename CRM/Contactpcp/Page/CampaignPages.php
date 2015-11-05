<?php

require_once 'CRM/Core/Page.php';

class CRM_Contactpcp_Page_CampaignPages extends CRM_Core_Page {
  public function run() {
    CRM_Utils_System::setTitle(ts('Personal campaign pages'));
    $pages = CRM_Contactpcp_DAO_CampaignPages::allForContact($_GET['cid']);

    $this->assign('pages', $pages);

    parent::run();
  }
}
