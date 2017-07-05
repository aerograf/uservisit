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

require_once __DIR__ . '/admin_header.php';

xoops_cp_header();
$adminObject  = \Xmf\Module\Admin::getInstance();
$adminObject->displayNavigation(basename(__FILE__));
    
global $xoopsDB, $xoopsUser;

echo "<div style='float:left;'><img src='../assets/images/delet.png'  alt='User Visit'></div>";
echo "<br style='clear:both;' /><hr /><br />";

function SupprM($visitname, $q)
{
    global $xoopsDB;

    if ($q == 'yes') {
        $result = $GLOBALS['xoopsDB']->queryF('DELETE FROM ' . $xoopsDB->prefix('visit_user') . " WHERE visitname = '$visitname'");
        $result = $GLOBALS['xoopsDB']->queryF('DELETE FROM ' . $xoopsDB->prefix('visit_user_page') . " WHERE nom = '$visitname'");

        echo '<fieldset>';
        echo '<legend>&nbsp;' . _AD_USERVISIT_ALLSTATS . "&nbsp;$visitname&nbsp;" . _AD_USERVISIT_DELETED . '&nbsp;</legend>';
        echo "<div style='text-align:center;'><img src='../assets/images/attention.png'  alt='Attention'></div>";
        echo "<br /><br /><div style='text-align:center;'><div class='ul_button'><a href='admin.php'>" . _AD_USERVISIT_BACKLIST . '</a></div></div><br />';
        echo '</fieldset>';
    } else {
        echo '<fieldset>';
        echo '<legend>&nbsp;' . _AD_USERVISIT_DELSTATS . "&nbsp;$visitname&nbsp;?</legend>";
        echo "<div style='text-align:center;'><img src='../assets/images/attention.png'  alt='Attention'></div>";
        echo "<br /><br /><div class='ul_button'><a href='suppr-visit.php?su=memb&visitname=$visitname&q=yes'>" . _AD_USERVISIT_YES . "</a></div>&nbsp;&nbsp;<div class='ul_button'><a href='admin.php'>" . _AD_USERVISIT_NO . '</a></div></div><br />';
        echo '</fieldset>';
    }
}

function SupprD($visitname, $id, $q, $supip)
{
    global $xoopsDB;

    if ($q == 'yes') {
        $result = $GLOBALS['xoopsDB']->queryF('DELETE FROM ' . $xoopsDB->prefix('visit_user') . " WHERE visitname = '$visitname' AND ip='$supip'");
        $result = $GLOBALS['xoopsDB']->queryF('DELETE FROM ' . $xoopsDB->prefix('visit_user_page') . " WHERE nom = '$visitname' AND enregis='$supip'");

        echo '<fieldset>';
        echo '<legend>&nbsp;' . _AD_USERVISIT_OLDSTATS . "&nbsp;$visitname&nbsp;" . _AD_USERVISIT_DELETED . '&nbsp;</legend>';
        echo "<div style='text-align:center;'><img src='../assets/images/attention.png'  alt='Attention'></div>";
        echo "<br /><br /><div style='text-align:center;'><div class='ul_button'><a href='admin.php'>" . _AD_USERVISIT_BACKLIST . '</a></div></div><br />';
        echo '</fieldset>';
    } else {
        echo '<fieldset>';
        echo '<legend>&nbsp;' . _AD_USERVISIT_DELSTATS . "&nbsp;$visitname&nbsp;?</legend>";
        echo "<div style='text-align:center;'><img src='../assets/images/attention.png'  alt='Attention'></div>";
        echo "<br /><br /><div style='text-align:center;'><div class='ul_button'><a href='suppr-visit.php?su=mdet&visitname=$visitname&supip=$supip&q=yes'>" . _AD_USERVISIT_YES . "</a></div>&nbsp;&nbsp;<div class='ul_button'><a href='admin.php'>" . _AD_USERVISIT_NO . '</a></div></div><br />';
        echo '</fieldset>';
    }
}
  
function SupprAll($q)
{
    global $xoopsDB;

    if ($q == yes) {
        $result = $GLOBALS['xoopsDB']->queryF('DELETE FROM ' . $xoopsDB->prefix('visit_user') . '');
        $result = $GLOBALS['xoopsDB']->queryF('DELETE FROM ' . $xoopsDB->prefix('visit_user_page') . '');

        echo '<fieldset>';
        echo '<legend>&nbsp;' . _AD_USERVISIT_TOTALDELET . '&nbsp;</legend>';
        echo "<div style='text-align:center;'><img src='../assets/images/attention.png'  alt='Attention'></div>";
        echo "<br /><br /><div style='text-align:center;'><div class='ul_button'><a href='admin.php'>" . _AD_USERVISIT_BACKLIST . '</a></div></div><br />';
        echo '</fieldset>';
    } else {
        echo '<fieldset>';
        echo '<legend>&nbsp;' . _AD_USERVISIT_DELSTATSALL . '&nbsp;</legend>';
        echo "<div style='text-align:center;'><img src='../assets/images/attention.png'  alt='Attention'></div>";
        echo "<br /><br /><div style='text-align:center;'><div class='ul_button'><a href='suppr-visit.php?su=mems&q=yes'>" . _AD_USERVISIT_YES . "</a></div>&nbsp;&nbsp;<div class='ul_button'><a href='admin.php'>" . _AD_USERVISIT_NO . '</a></div></div><br />';
        echo '</fieldset>';
    }
}

$su=$_GET['su'];
$visitname = isset($_GET['visitname']) ? $_GET['visitname']:'';
$id = isset($_GET['id']) ? $_GET['id']:'';
$q = isset($_GET['q']) ? $_GET['q']:'';
$supip = isset($_GET['supip']) ? $_GET['supip']:'';

switch ($su) {
                                    
        case 'mems':
                      SupprAll($q);
                      break;
                            
        case 'memb':
                      SupprM($visitname, $q);
                      break;


        case 'mdet':
                      SupprD($visitname, $id, $q, $supip);
                      break;
                      
        }
        
require_once __DIR__ . '/admin_footer.php';
