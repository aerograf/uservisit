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

if (!isset($_POST['ord'])) {
    $ord = isset($_GET['ord']) ? $_GET['ord'] : '';
} else {
    $ord = $_POST['ord'];
}

if ($ord == '') {
    $ordre = 'visitname';
    $sort_ordre = 'ASC';
    $ord_text = '' . _AD_USERVISIT_NAME . '';
}
if ($ord == '1') {
    $ordre = 'nnvisit';
    $sort_ordre = 'DESC';
    $ord_text = '' . _AD_USERVISIT_PAGESVIEW . '';
}
if ($ord == '2') {
    $ordre = 'cvisit';
    $sort_ordre = 'DESC';
    $ord_text = '' . _AD_USERVISIT_VISITS . '';
}
if ($ord == '3') {
    $ordre = 'tempsf';
    $sort_ordre = 'DESC';
    $ord_text = '' . _AD_USERVISIT_LAST_VISITS . '';
}

echo '<fieldset>';
echo '<legend>&nbsp;' . _AD_USERVISIT_HEADER . '&nbsp;' . $xoopsConfig['sitename'] . '&nbsp;</legend>';
echo "<div class='ul_dummy'><img src='../assets/images/dummy.gif' alt='User Visit'></div>";

    $visit = $GLOBALS['xoopsDB']->query('SELECT tempsf, visitname, Sum(nvisit) as nnvisit, count(nvisit) as cvisit ,nvisit FROM ' . $xoopsDB->prefix('visit_user') . " GROUP BY visitname ORDER BY $ordre $sort_ordre");
    
    $visi = $visit->num_rows;

if ($visi == 0) {
    echo "<div class='ul_novisit'>" . _AD_USERVISIT_NOVISIT . '</div></fieldset>';
} else {
    echo "<div class='ul_members'>" . _AD_USERVISIT_MEMBERS . " <b>$visi</b></div>";
    echo "<div class='ul_ranking'>" . _AD_USERVISIT_RANKING . " <b>$ord_text</b></div>";
    echo "<br style='clear:both;' />";
    echo "<div style='text-align:center;'>";
    echo "<div class='ul_div_th_10'>№</div>";
    echo "<div class='ul_div_th_15'><a href='admin.php'>" . _AD_USERVISIT_NAME . '</a></div>';
    echo "<div class='ul_div_th_15'><a href='admin.php?ord=1'>" . _AD_USERVISIT_PAGESVIEWS . '</a></div>';
    echo "<div class='ul_div_th_15'><a href='admin.php?ord=2'>" . _AD_USERVISIT_VISITS . '</a></div>';
    echo "<div class='ul_div_th_15'>" . _AD_USERVISIT_OPTIONS . "</div><br style='clear:both;' />";

    $i=0;
    while ($i < $visi) {
        $nnvisit  =     mysqli_result($visit, $i, 'nnvisit');
        $ccvisit  =     mysqli_result($visit, $i, 'cvisit');
        $nom      =     mysqli_result($visit, $i, 'visitname');
        $nvisite  =     mysqli_result($visit, $i, 'nvisit');

        $i++;
        echo "<div style='text-align:center;'>";
        echo "<div class='ul_div_td_10'>$i</div>";
        echo "<div class='ul_div_td_15'>$nom</div>";
        echo "<div class='ul_div_td_15'>$nnvisit</div>";
        echo "<div class='ul_div_td_15'>$ccvisit</div>";
        echo "<div class='ul_div_td_15'><a href='user-visit.php?vm=$nom'><img src='../assets/images/view_mini.png' alt='" . _AD_USERVISIT_DETAILS . "'></a>&nbsp;&nbsp;<a href='suppr-visit.php?su=memb&visitname=$nom'><img src='../assets/images/delete_mini.png' alt='" . _AD_USERVISIT_DELET . "'></a></div>";
    }
    echo "</div><br style='clear:both;' />";
    echo "<br /><hr style='border:1px dashed black;' /><br /><div style='text-align:center;'><div class='ul_button'><a href='suppr-visit.php?su=mems'>" . _AD_USERVISIT_DELALLSTATS . '</a></div></div></fieldset>';
}

require_once __DIR__ . '/admin_footer.php';
