<?

#######################################################
#  Visites de Membres version 2.1 pour Xoops 2.0.x	#
#  Copyright © 2002, Pascal Le Boustouller		#
#  Adaptation © 2003, Solo ( www.wolfpackclan.com )	#
#  									#
#  Licence : GPL 							#
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


function convert($duree) {
$minute = 60;
$heure = 60*$minute;
$jour = 24*$heure;
$annee = 365*$jour;
$chaine .= floor($duree / $heure)."h ";
$reste = $duree % $heure;
$chaine .= floor($reste / $minute)."mn ";
$reste = $reste % $minute;
$chaine .= $reste."s";
return $chaine;
}

echo "<B>"._MD_USERVISIT_HEADER." ".$xoopsConfig['sitename']."</B><p>";
echo "<img src=../images/dummy.gif align=\"right\"></a><p>";

 echo    "<CENTER>[ <A HREF=\"admin.php\">"._MD_USERVISIT_BACK."</A> | <A HREF=\"suppr-visit.php?su=mems\">"._MD_USERVISIT_DELSTAT."</A> ]</CENTER><P>";

$vm = $HTTP_GET_VARS['vm'];
    $visit= mysql_query("SELECT * FROM ".$xoopsDB->prefix("visit_user")." WHERE visitname = '$vm' ORDER BY temps");
    $visi=mysql_num_rows($visit);

if($visi == 0) {
  echo ""._MD_USERVISIT_NOVISIT."<P>";
} else {  
  echo ""._MD_USERVISIT_THEREIS." <FONT COLOR=\"#FF0000\">$visi</FONT> "._MD_USERVISIT_VISITFROM." <B>$vm</B>.<p>";

  echo "<CENTER><TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1 class='bg2'>
    <TR class='bg2'>
      <TD><CENTER><B>"._MD_USERVISIT_VISITS."</B></CENTER></TD>
      <TD><CENTER><B>"._MD_USERVISIT_PAGESVIEW."</B></CENTER></TD>
      <TD><CENTER><B>"._MD_USERVISIT_LOADIN."</B></CENTER></TD>
      <TD><CENTER><B>"._MD_USERVISIT_LOADOUT."</B></CENTER></TD>
      <TD><CENTER><B>"._MD_USERVISIT_VISITLENGHT."</B></CENTER></TD>
    </TR>";


  $i=0; 
while ($i < $visi) {
  $supip = mysql_result($visit, $i, "ip");
  $id = mysql_result($visit, $i, "id");
  $nom = mysql_result($visit, $i, "visitname");
  $nvisite = mysql_result($visit, $i, "nvisit");
  $tem = mysql_result($visit, $i, "temps");
  $temf = mysql_result($visit, $i, "tempsf");
  
  $tems = date("j-m-Y H:i:s" ,$tem);
  $temss = date("j-m-Y H:i:s" ,$temf);
  
  
  $temm = abs($temf-$tem);

$ii = ($i+1);
  
 echo "<tr class='bg1'><td><CENTER>$ii</CENTER></td><td><CENTER>$nvisite</CENTER></td><td><CENTER><FONT SIZE=1>$tems</FONT></CENTER></td><td><CENTER><FONT SIZE=1>$temss</FONT></CENTER></td><td><CENTER>". convert($temm) ."</CENTER></td></tr>";


  $i++; 
  }
 echo    "</TABLE></CENTER><P>";
 echo "<CENTER>[ <A HREF=\"suppr-visit.php?su=mdet&visitname=$nom&supip=termine\">"._MD_USERVISIT_DELSTATOF." $nom</A> ]<BR>"._MD_USERVISIT_DELSTATNOTE."</CENTER>";
 
 
 echo "<P><BR>";
}



    $visit = mysql_query("SELECT distinct page, count(page) as cpage FROM ".$xoopsDB->prefix("visit_user_page")." WHERE nom = '$vm' GROUP BY page ORDER BY page ASC");
    $visi=mysql_num_rows($visit);


  echo "<B>$vm</B> "._MD_USERVISIT_HASVISITED." <B>$visi</B> "._MD_USERVISIT_DIFFPAGES."<p>";
  echo "<CENTER><TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1 class='bg2'>
    <TR class='bg2'>
      <TD><B>"._MD_USERVISIT_PAGES."</B></TD>
      <TD ALIGN=right><CENTER><B>"._MD_USERVISIT_VIEW."</B></CENTER></TD>
    </TR>";


        while(list($page, $cpage) = mysql_fetch_row($visit)) {
        	$page_html = ereg_replace("/wpc/", "/.../", $page);
        	$page_modules = ereg_replace("/modules/", "/", $page_html);
		if (strlen($page_modules) >= 52) {
				$page_modules = substr($page_modules,0,(52 -1))."...";
			}

echo "<tr class='bg1' align='left'><td><a href=\"$page\" target=\"_blank\">$page_modules </a></td><td align='right'>$cpage</td></tr>";

  }
 echo    "</TABLE></CENTER><P><BR>";
 
 $visit2 = mysql_query("SELECT distinct nav, count(nav) as cnav, langue FROM ".$xoopsDB->prefix("visit_user_page")." WHERE nom = '$vm' GROUP BY nav ORDER BY cnav DESC");
    $visi2=mysql_num_rows($visit2);


  echo ""._MD_USERVISIT_OSOF." <B>$vm</B>.<p>";
  echo "<CENTER><TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1 class='bg2'>
    <TR class='bg2'>
      <TD><B>"._MD_USERVISIT_OS."</B></TD>
      <TD ALIGN=right><B>"._MD_USERVISIT_PAGES."</B></TD>
      <TD><CENTER><B>"._MD_USERVISIT_LANG."</B></CENTER></TD>
    </TR>";


        while(list($nav, $cnav, $langue) = mysql_fetch_row($visit2)) {
  
 echo "<tr class='bg1'><td>$nav</td><td ALIGN=right>$cnav</td><td><CENTER>$langue</CENTER></td></tr>";

  }
 echo    "</TABLE></CENTER><P><BR>";
 
 	echo ""._MD_USERVISIT_INFO." <B>$vm</B><p>";
  echo "<CENTER><TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1 class='bg2'>
  <TR>
      <TD class='bg1'>";
  
    $result = mysql_query("SELECT name, email, url, user_regdate, user_icq, user_from, user_aim, user_yim, user_msnm, user_occ, bio FROM ".$xoopsDB->prefix("users")." where uname='$vm'");
	if(mysql_num_rows($result)==1)  {
while ($user = mysql_fetch_array($result)) {

	$date = formatTimestamp($user[user_regdate],"s");

        					echo ""._MD_USERVISIT_DATE." ".$date."<br>\n";
		if ($user[name]) { 	echo ""._MD_USERVISIT_NAME." $user[name]<br>\n"; }
		if ($user[url]) { 	echo ""._MD_USERVISIT_WEBSITE." <a href=\"$user[url]\" TARGET=\"_blank\">$user[url]</a><br>\n"; }
		if ($user[email]) { 	echo ""._MD_USERVISIT_MAIL." <a href=\"mailto:$user[email]\">$user[email]</a><br>\n"; }
		if ($user[user_occ]) {	echo ""._MD_USERVISIT_OCCUP." $user[user_occ]<br>\n";}
		if ($user[user_icq]) {	echo ""._MD_USERVISIT_ICQ." $user[user_icq]<br>\n";}
		if ($user[user_aim]) {	echo ""._MD_USERVISIT_AIM." $user[user_aim]<br>\n";}
		if ($user[user_yim]) {	echo ""._MD_USERVISIT_YIM." $user[user_yim]<br>\n";}
		if ($user[user_msnm]) {	echo ""._MD_USERVISIT_MSNM." $user[user_msnm]<br>\n";}
		if ($user[user_from]) {	echo ""._MD_USERVISIT_FROM." $user[user_from]<br>\n";}
		if ($user[bio]) {		echo ""._MD_USERVISIT_BIO." $user[bio]<br>\n";}

}
	} else {
		echo "<center>"._MD_USERVISIT_NOINFO." <FONT COLOR=\"#FF0000\">$vm</FONT></center>";
	}

	
 echo    "</TD></TR></TABLE></CENTER><P><BR>";

 echo    "<CENTER>[ <A HREF=\"admin.php\">"._MD_USERVISIT_BACKLIST."</A> | <A HREF=\"suppr-visit.php?su=mems\">"._MD_USERVISIT_DELSTAT."</A> ]</CENTER>";


                CloseTable();
	echo "<P>";
	            OpenTable();
	echo "<DIV ALIGN=\"right\">"._MD_USERVISIT_CREDIT." Pascal Le Boustouller </br>"._MD_USERVISIT_AND." <A HREF=\"mailto:solo@wolfpackclan.com\">Solo</A> ( <A HREF=\"http://www.wolfpackclan.com\" TARGET=\"_blank\">www.wolfpackclan.com</A> )</DIV>";
                CloseTable();

include("../include/admin_footer.php");
?>