<?php
#######################################################
#  Visites de Membres version 2.1 pour Xoops 2.0.x	#
#  Copyright © 2002, Pascal Le Boustouller		#
#  Adaptation © 2003, Solo ( www.wolfpackclan.com )	#
#  Visites de Membres version 2.5 pour Xoops 2.5.8+	#
#  Adaptation © 2017 XOOPS 2.5.8+ (PHP7) - Aerograf
#  									#
#  Licence : GPL 							#
#######################################################
require_once __DIR__ . '/../../../mainfile.php';
include XOOPS_ROOT_PATH . '/include/cp_functions.php';
include_once XOOPS_ROOT_PATH . '/kernel/module.php';
require_once __DIR__ . '/../../../include/cp_header.php';

$myts = MyTextSanitizer::getInstance();

  if ($xoopsUser) {
      $xoopsModule = XoopsModule::getByDirname('uservisit');
      if (!$xoopsUser->isAdmin($xoopsModule->mid())) {
          redirect_header(XOOPS_URL . '/', 3, _NOPERM);
          exit();
      }
  } else {
      redirect_header(XOOPS_URL . '/', 3, _NOPERM);
      exit();
  }

  if (!isset($moduleDirName)) {
      $moduleDirName = basename(dirname(__DIR__));
  }
  if (false !== ($moduleHelper = Xmf\Module\Helper::getHelper($moduleDirName))) {
  } else {
      $moduleHelper = Xmf\Module\Helper::getHelper('system');
  }
  $pathModIcon32 = $moduleHelper->getModule()->getInfo('modicons32');
  
echo "<style>@import '../assets/css/admin.css' screen;</style>";

/**
 * @param     $res
 * @param     $row
 * @param int $field
 * @return mixed
 */
function mysqli_result($res, $row, $field=0)
{
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}
