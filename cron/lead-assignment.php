<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');
$fetch_unassign_leads = $db_handle->runQuery($Conn1,"select * from crm_query where is_lead_assign = 0 limit 50");
preArray($fetch_unassign_leads);



?>