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
  include_once dirname(dirname(__DIR__)) . '/mainfile.php';

    global $xoopsDB, $xoopsUser;
    $httprefmax = '500';
      $res = $GLOBALS['xoopsDB']->query("SELECT * FROM ".$xoopsDB->prefix("visit_user_page")."");
      $numrows = $res->num_rows;
      if (($numrows + 1) >= $httprefmax) {
          $GLOBALS['xoopsDB']->queryF("delete FROM ".$xoopsDB->prefix("visit_user_page")." WHERE enregis = 'termine'");
          $GLOBALS['xoopsDB']->queryF("delete FROM ".$xoopsDB->prefix("visit_user")." WHERE ip = 'termine'");
      }
    

    if ($xoopsUser) {
        $lognom = $xoopsUser->uname();
        $addip = $_SERVER["REMOTE_ADDR"];
        $langue = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
        $nav = $_SERVER["HTTP_USER_AGENT"];
        $page = $_SERVER["REQUEST_URI"];
         
        if (!$page) {
            $page = "index.php";
        }
            
        $result = $GLOBALS['xoopsDB']->query("SELECT visitname, temps, tempsf  FROM ".$xoopsDB->prefix("visit_user")." WHERE visitname='$lognom' AND ip='$addip'");
        while ($resultat = $GLOBALS['xoopsDB']->fetchArray($result)) {
            $visitname = $resultat['visitname'];
            $tem = $resultat['temps'];
            $temf = $resultat['tempsf'];
        }

        $tempe = time();

# si le visiteur revient apres + 1 heure avec la meme ip
    if ($visitname && (($tempe - $tem) > 3600)) {
        $addips = "termine";
        $GLOBALS['xoopsDB']->queryF("UPDATE ".$xoopsDB->prefix("visit_user")." SET ip='$addips' WHERE visitname='$lognom' AND ip='$addip'");
        $GLOBALS['xoopsDB']->queryF("UPDATE ".$xoopsDB->prefix("visit_user_page")." SET enregis='$addips' WHERE nom='$lognom' AND enregis='$addip'");
        $nvisit = 1;
        $tempes = $tempe + 1;
        $GLOBALS['xoopsDB']->queryF("INSERT INTO ".$xoopsDB->prefix("visit_user")." VALUES ('','$lognom','$nvisit','$addip','$tempe','$tempes')");
        $GLOBALS['xoopsDB']->queryF("INSERT INTO ".$xoopsDB->prefix("visit_user_page")." VALUES ('', '$lognom', '$page', '$nav', '$langue', '$addip')");
    }
      
      
        if ($visitname && (($tempe - $tem) < 3600)) {
            $GLOBALS['xoopsDB']->queryF("UPDATE ".$xoopsDB->prefix("visit_user")." SET nvisit=nvisit+1,  tempsf='$tempe' WHERE visitname='$lognom' AND ip='$addip'");
            $GLOBALS['xoopsDB']->queryF("INSERT INTO ".$xoopsDB->prefix("visit_user_page")." VALUES ('', '$lognom', '$page', '$nav', '$langue', '$addip')");
        }

# si le visiteur n'existe pas dans la base
    if (!$visitname) {
        $nvisit = 1;
        $tempes = $tempe + 1;
        $GLOBALS['xoopsDB']->queryF("INSERT INTO ".$xoopsDB->prefix("visit_user")." VALUES ('','$lognom','$nvisit','$addip','$tempe','$tempes')");
        $GLOBALS['xoopsDB']->queryF("INSERT INTO ".$xoopsDB->prefix("visit_user_page")." VALUES ('', '$lognom', '$page', '$nav', '$langue', '$addip')");
    }
    }
