<?
#######################################################
#  Visites de Membres version 2.1 pour Xoops 2.0.x	#
#  Copyright © 2002, Pascal Le Boustouller		#
#  Adaptation © 2003, Solo ( www.wolfpackclan.com )	#
#  									#
#  Licence : GPL 							#
#######################################################


	global $xoopsDB, $xoopsUser;
	$httprefmax = '500';
      $res = mysql_query("SELECT * FROM ".$xoopsDB->prefix("visit_user_page")."");
      $numrows = mysql_num_rows($res);
      if (($numrows + 1) >= $httprefmax) { 
        mysql_query("delete FROM ".$xoopsDB->prefix("visit_user_page")." WHERE enregis = 'termine'");
        mysql_query("delete FROM ".$xoopsDB->prefix("visit_user")." WHERE ip = 'termine'");
	}
	

    if ($xoopsUser)
        {
         $lognom = $xoopsUser->uname();
		 $addip = getenv("REMOTE_ADDR");
	     $langue = getenv("HTTP_ACCEPT_LANGUAGE");
		$nav = getenv("HTTP_USER_AGENT");
		$page = getenv("REQUEST_URI");
//        	$page = ereg_replace("/modules/", "/", $page);
		 
if (!$page) {
$page = "index.php";
}
			
		$result = mysql_query("SELECT visitname, temps, tempsf  FROM ".$xoopsDB->prefix("visit_user")." WHERE visitname='$lognom' AND ip='$addip'");	
		while ($resultat = mysql_fetch_array($result)) {
		
      $visitname = $resultat[visitname];
	$tem = $resultat[temps];
      $temf = $resultat[tempsf];
}

$tempe = time();

# si le visiteur revient apres + 1 heure avec la meme ip
	if ($visitname && (($tempe - $tem) > 3600))	
	    {
		$addips = "termine";
		mysql_query("UPDATE ".$xoopsDB->prefix("visit_user")." SET ip='$addips' WHERE visitname='$lognom' AND ip='$addip'");
		mysql_query("UPDATE ".$xoopsDB->prefix("visit_user_page")." SET enregis='$addips' WHERE nom='$lognom' AND enregis='$addip'");
		$nvisit = 1;
		$tempes = $tempe + 1;
        mysql_query("INSERT INTO ".$xoopsDB->prefix("visit_user")." VALUES ('','$lognom','$nvisit','$addip','$tempe','$tempes')");
		mysql_query("INSERT INTO ".$xoopsDB->prefix("visit_user_page")." VALUES ('', '$lognom', '$page', '$nav', '$langue', '$addip')");
	  } 
	  
	  
	if ($visitname && (($tempe - $tem) < 3600))	{
		mysql_query("UPDATE ".$xoopsDB->prefix("visit_user")." SET nvisit=nvisit+1,  tempsf='$tempe' WHERE visitname='$lognom' AND ip='$addip'");
		mysql_query("INSERT INTO ".$xoopsDB->prefix("visit_user_page")." VALUES ('', '$lognom', '$page', '$nav', '$langue', '$addip')");
	  }

# si le visiteur n'existe pas dans la base
	if (!$visitname) {
		$nvisit = 1;
		$tempes = $tempe + 1;
        mysql_query("INSERT INTO ".$xoopsDB->prefix("visit_user")." VALUES ('','$lognom','$nvisit','$addip','$tempe','$tempes')");
		mysql_query("INSERT INTO ".$xoopsDB->prefix("visit_user_page")." VALUES ('', '$lognom', '$page', '$nav', '$langue', '$addip')");
       }
	}

?>