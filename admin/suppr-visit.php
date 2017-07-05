<?
#######################################################
#  Visites de Membres version 2.1 pour Xoops 2.0.x	#
#  Copyright © 2002, Pascal Le Boustouller		#
#  Adaptation © 2003, Solo ( www.wolfpackclan.com )	#
#  Bug-fix 2005, Dasdan    ( www.dasdan.be )            # 
#							#	
#  Licence : GPL 					#
#######################################################

include("../include/admin_header.php");
xoops_cp_header();
if ( file_exists("../language/".$xoopsConfig['language']."/main.php") ) {
	include "../language/".$xoopsConfig['language']."/main.php";
} else {
	include "../language/english/main.php";
}
		echo "<br />\n";
		
global $xoopsDB, $xoopsUser;

	            OpenTable();


function SupprM($visitname, $q)
{
global $xoopsDB;

if ($q == 'yes') {
$result = mysql_query("DELETE FROM ".$xoopsDB->prefix("visit_user")." WHERE visitname = '$visitname'");
$result = mysql_query("DELETE FROM ".$xoopsDB->prefix("visit_user_page")." WHERE nom = '$visitname'");

echo "<P><BR>"._MD_USERVISIT_ALLSTATS." <B>$visitname</B> "._MD_USERVISIT_DELETED."<P>";
 echo    "<CENTER>[ <A HREF=\"admin.php\">"._MD_USERVISIT_BACKLIST."</A> ]</CENTER>";
 } else {
echo "<P><BR>"._MD_USERVISIT_DELSTATS." <B>$visitname</B> ?<P>";
echo "<P><CENTER>[ <A HREF=\"suppr-visit.php?su=memb&visitname=$visitname&q=yes\">"._MD_USERVISIT_YES."</A> | <A HREF=\"admin.php?fct=uservisit\">"._MD_USERVISIT_NO."</A> ]</CENTER><P>";
}
}



function SupprD($visitname, $id, $q, $supip)
{
global $xoopsDB;

if ($q == 'yes') {
$result = mysql_query("DELETE FROM ".$xoopsDB->prefix("visit_user")." WHERE visitname = '$visitname' AND ip='$supip'");
$result = mysql_query("DELETE FROM ".$xoopsDB->prefix("visit_user_page")." WHERE nom = '$visitname' AND enregis='$supip'");

echo "<BR>"._MD_USERVISIT_OLDSTATS." <B>$visitname</B> "._MD_USERVISIT_DELETED."<P>";
 echo    "<CENTER>[ <A HREF=\"admin.php\">"._MD_USERVISIT_BACKLIST."</A> ]</CENTER>";
 } else {
echo "<P><BR>"._MD_USERVISIT_DELSTATS." <B>$visitname</B> ?<P>";
echo "<P><CENTER>[ <A HREF=\"suppr-visit.php?su=mdet&visitname=$visitname&supip=$supip&q=yes\">"._MD_USERVISIT_YES."</A> | <A HREF=\"admin.php\">"._MD_USERVISIT_NO."</A> ]</CENTER><P>";
}
}

function SupprAll( $q)
{
global $xoopsDB;

if ($q == yes) {
$result = mysql_query("DELETE FROM ".$xoopsDB->prefix("visit_user")."");
$result = mysql_query("DELETE FROM ".$xoopsDB->prefix("visit_user_page")."");
echo "<BR>"._MD_USERVISIT_TOTALDELET."<P>";
 echo    "<CENTER>[ <A HREF=\"admin.php\">"._MD_USERVISIT_BACKLIST."</A> ]</CENTER>";
 } else {
echo "<P><BR>"._MD_USERVISIT_DELSTATSALL."<P>";
echo "<P><CENTER>[ <A HREF=\"suppr-visit.php?su=mems&q=yes\">"._MD_USERVISIT_YES."</A> | <A HREF=\"admin.php\">"._MD_USERVISIT_NO."</A> ]</CENTER><P>";
}
}

$su=$HTTP_GET_VARS['su'];
$visitname = (isset($HTTP_GET_VARS['visitname']))?$HTTP_GET_VARS['visitname']:'';    
$id = (isset($HTTP_GET_VARS['id']))?$HTTP_GET_VARS['id']:'';
$q = (isset($HTTP_GET_VARS['q']))?$HTTP_GET_VARS['q']:'';
$supip = (isset($HTTP_GET_VARS['supip']))?$HTTP_GET_VARS['supip']:'';

switch($su)
        {
									
        case "mems":
                      SupprAll($q);
                      break;
							
        case "memb":
                      SupprM($visitname, $q);
                      break;


        case "mdet":
                      SupprD($visitname, $id, $q, $supip );
                      break;
					  
        }
		
include("../include/admin_footer.php");
?>
