<?php

#######################################################
#  Visites de Membres version 2.1 pour Xoops 2.0.x	#
#  Copyright © 2002, Pascal Le Boustouller		#
#  Adaptation © 2003, Solo ( www.wolfpackclan.com )	#
#  									#
#  Licence : GPL 							#
#######################################################


$modversion['name'] = _MI_USERVISIT_NAME;
$modversion['version'] = 2.31;
$modversion['description'] = _MI_USERVISIT_DESC;
$modversion['credits'] = "Pascal Le Boustouller";
$modversion['author'] = "Solo<br />( www.wolfpackclan.com )";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 0;
$modversion['image'] = "images/uservisit_slogo.png";
$modversion['dirname'] = "uservisit";

//sql tables
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][0] = "visit_user";
$modversion['tables'][1] = "visit_user_page";

// Admin
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/admin.php";
$modversion['adminmenu'] = "admin/menu.php";

?>