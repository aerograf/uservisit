<?
#######################################################
#  Visites de Membres version 2.1 pour Xoops 2.0.x	#
#  Copyright © 2002, Pascal Le Boustouller		#
#  Adaptation © 2003, Solo ( www.wolfpackclan.com )	#
#  									#
#  Licence : GPL 							#
#######################################################

include("../include/admin_header.php");
include '../../../include/cp_header.php';
if ( file_exists("../language/".$xoopsConfig['language']."/main.php") ) {
	include "../language/".$xoopsConfig['language']."/main.php";
} else {
	include "../language/english/main.php";
}
xoops_cp_header();
		echo "<br />\n";
		
global $xoopsDB, $xoopsUser;

	            OpenTable();

if (!isset($_POST["ord"])) {
    $ord = isset($_GET["ord"]) ? $_GET["ord"] : "";
} else {
    $ord = $_POST["ord"];
}// if


if ($ord == "") {
$ordre = "visitname";
$sort_ordre = "ASC";
$ord_text = ""._MD_USERVISIT_NAME."";
}
if ($ord == "1") {
$ordre = "nnvisit";
$sort_ordre = "DESC";
$ord_text = ""._MD_USERVISIT_PAGESVIEW."";
}
if ($ord == "2") {
$ordre = "cvisit";
$sort_ordre = "DESC";
$ord_text = ""._MD_USERVISIT_VISITS."";
}
if ($ord == "3") {
$ordre = "tempsf";
$sort_ordre = "DESC";
$ord_text = ""._MD_USERVISIT_LAST_VISITS."";
} 

echo "<B>"._MD_USERVISIT_HEADER." ".$xoopsConfig['sitename']."</B><p>";
echo "<img src=../images/dummy.gif align=\"right\"></a><p>";

    $visit = $xoopsDB->query("SELECT tempsf, visitname, Sum(nvisit) as nnvisit, count(nvisit) as cvisit ,nvisit FROM ".$xoopsDB->prefix("visit_user")." GROUP BY visitname ORDER BY $ordre $sort_ordre");
    //$visit2 = $xoopsDB->query("SELECT tempsf, visitname, Sum(nvisit) as nnvisit, count(nvisit) as cvisit ,nvisit FROM ".$xoopsDB->prefix("visit_user")." GROUP BY tempsf ORDER BY $ordre $sort_ordre");


    $visi=mysql_NumRows($visit);

if($visi == 0) 
{
  echo ""._MD_USERVISIT_NOVISIT."<P>";
}
else
{

 
  echo ""._MD_USERVISIT_MEMBERS." <B>$visi</B><p><CENTER>"._MD_USERVISIT_RANKING." <B>$ord_text</B></CENTER><BR>";
  echo "<CENTER><TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1 class='bg2'>
    <TR class='bg2'>
      <TD><CENTER><B>N°</B></CENTER></TD>
      <TD><CENTER><B><A HREF=\"admin.php\">"._MD_USERVISIT_NAME."</A></B></CENTER></TD>
      <TD><CENTER><B><A HREF=\"admin.php?ord=1\">"._MD_USERVISIT_PAGESVIEWS."</A></B></CENTER></TD>
      <TD><CENTER><B><A HREF=\"admin.php?ord=2\">"._MD_USERVISIT_VISITS."</A></B></CENTER></TD>
      <TD><CENTER><B>"._MD_USERVISIT_OPTIONS."</B></CENTER></TD>
    </TR>";


  $i=0; 
while ($i < $visi) 
  {
  $nnvisit = 	mysql_result($visit, $i, "nnvisit");
  $ccvisit = 	mysql_result($visit, $i, "cvisit");
  $nom = 		mysql_result($visit, $i, "visitname");
  $nvisite = 	mysql_result($visit, $i, "nvisit");
//  $lastvisit_1 = 	mysql_result($visit2, $i, "tempsf");
//  $lastvisit = 	date("j-m-Y H:i:s" ,$lastvisit_1);
  $i++;
 echo "<tr class='bg1'>
	<td><CENTER>$i</CENTER></td>
	<td>&nbsp;&nbsp;$nom&nbsp;&nbsp;</td>
	<td><CENTER>$nnvisit</CENTER></td>
	<td><CENTER>$ccvisit</CENTER></td>
	<td><CENTER>[ <A HREF=\"user-visit.php?vm=$nom\">"._MD_USERVISIT_DETAILS."</A> | <A HREF=\"suppr-visit.php?su=memb&visitname=$nom\">"._MD_USERVISIT_DELET."</A> ]</CENTER></td>
</tr>";


 
  }
 echo    "</TABLE></CENTER>";
 echo "<P><CENTER>[ <A HREF=\"suppr-visit.php?su=mems\">"._MD_USERVISIT_DELALLSTATS."</A> ]</CENTER><P><BR>";
}

                CloseTable();
	echo "<P>";
	            OpenTable();
	echo "<DIV ALIGN=\"right\">"._MD_USERVISIT_CREDIT." Pascal Le Boustouller </br>"._MD_USERVISIT_AND." <A HREF=\"mailto:solo@wolfpackclan.com\">Solo</A> ( <A HREF=\"http://www.wolfpackclan.com\" TARGET=\"_blank\">www.wolfpackclan.com</A> )</DIV>";
                CloseTable();

include("../include/admin_footer.php");
?>
