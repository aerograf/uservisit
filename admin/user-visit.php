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

/**
 * @param $duree
 * @return string
 */
function convert($duree)
{
    $minute = 60;
    $heure  = 60*$minute;
    $jour   = 24*$heure;
    $annee  = 365*$jour;
    $chaine .= floor($duree / $heure) . 'h ';
    $reste  = $duree % $heure;
    $chaine .= floor($reste / $minute) . 'mn ';
    $reste  = $reste % $minute;
    $chaine .= $reste . 's';
    return $chaine;
}

echo "<div style='float:left;'><img src='../"
      . $pathModIcon32
      . "/about.png'  alt='User Visit'></div>&nbsp;<strong style='color:blue;font-size:large;'>"
      . _AD_USERVISIT_HEADER
      . "&nbsp;"
      . $xoopsConfig['sitename']
      . "</strong><br style='clear:both;'><hr><br>";

    $vm = $_GET['vm'];
    $visit= $GLOBALS['xoopsDB']->query('SELECT * FROM '
                                        . $xoopsDB->prefix('visit_user')
                                        . " WHERE visitname = '$vm' ORDER BY temps");
    $visi = $visit->num_rows;

if ($visi == 0) {
    echo '<fieldset>';
    echo "<div class='ul_dummy'><img src='../assets/images/dummy.gif' alt='User Visit'></div>";
    echo "<div class='ul_novisit'>"
          . _AD_USERVISIT_NOVISIT
          . '</div>';
} else {
    echo '<fieldset><legend>&nbsp;'
          . _AD_USERVISIT_THEREIS
          . "&nbsp;<strong style='color:#FF0000'>"
          . $visi
          . "</strong>&nbsp;"
          . _AD_USERVISIT_VISITFROM
          . "&nbsp;"
          . $vm
          . "&nbsp;</legend>";
    echo "<div style='float:right;'><img src='../assets/images/dummy.gif' alt='User Visit'></div>";
    echo "<br style='clear:both;'>";
    echo "<div style='text-align:center;'><div class='ul_div_th_10'>"
          . _AD_USERVISIT_VISITS
          . "</div><div class='ul_div_th_10'>"
          . _AD_USERVISIT_PAGESVIEW
          . "</div><div class='ul_div_th_20'>"
          . _AD_USERVISIT_LOADIN
          . "</div><div class='ul_div_th_20'>"
          . _AD_USERVISIT_LOADOUT
          . "</div><div class='ul_div_th_20'>"
          . _AD_USERVISIT_VISITLENGHT
          . "</div><br style='clear:both;'>";

    $i=0;
    while ($i < $visi) {
        $supip   = mysqli_result($visit, $i, 'ip');
        $id      = mysqli_result($visit, $i, 'id');
        $nom     = mysqli_result($visit, $i, 'visitname');
        $nvisite = mysqli_result($visit, $i, 'nvisit');
        $tem     = mysqli_result($visit, $i, 'temps');
        $temf    = mysqli_result($visit, $i, 'tempsf');
        $tems    = date('j-m-Y H:i:s', $tem);
        $temss   = date('j-m-Y H:i:s', $temf);
        $temm    = abs($temf-$tem);

        $ii = ($i+1);
        echo "<div style='text-align:center;'><div class='ul_div_td_u_10'>"
              . $ii
              . "</div><div class='ul_div_td_u_10'>"
              . $nvisite
              . "</div><div class='ul_div_td_20'>"
              . $tems
              . "</div><div class='ul_div_td_20'>"
              . $temss
              . "</div><div class='ul_div_td_20'>"
              . convert($temm)
              . "</div></div>";

        $i++;
    }
    echo "<br><hr style='border:1px dashed black;'><br><div style='text-align:center;'><div class='ul_button'><a href='suppr-visit.php?su=mdet&visitname="
          . $nom
          . "&supip=termine'>"
          . _AD_USERVISIT_DELSTATOF
          . "&nbsp;"
          . $nom
          . "</a></div><br>"
          . _AD_USERVISIT_DELSTATNOTE
          . "</div><br style='clear:both;'>";
}

    $visit = $GLOBALS['xoopsDB']->query('SELECT distinct page, count(page) as cpage FROM '
                                        . $xoopsDB->prefix('visit_user_page')
                                        . " WHERE nom = '$vm' GROUP BY page ORDER BY page ASC");
    $visi = $visit->num_rows;

  echo "<div style='float:left;color:blue;font-weight:600;'>"
        . $vm
        . "&nbsp;"
        . _AD_USERVISIT_HASVISITED
        . "&nbsp;"
        . $visi
        . "&nbsp;"
        . _AD_USERVISIT_DIFFPAGES
        . "</div><br><br style='clear:both;'>
          <div style='text-align:center;'><div class='ul_div_th_25'>"
        . _AD_USERVISIT_PAGES
        . "</div><div class='ul_div_th_25'>"
        . _AD_USERVISIT_VIEW
        . "</div><br style='clear:both;'>";

        while (list($page, $cpage) = $GLOBALS['xoopsDB']->fetchRow($visit)) {
            $page_html = preg_replace('/wpc/', '/.../', $page);
            $page_modules = preg_replace('/modules/', '/', $page_html);
            if (strlen($page_modules) >= 52) {
                $page_modules = substr($page_modules, 0, 52 - 1) . '...';
            }
            echo "<div class='ul_div_td_25'><a href='"
                  . $page
                  . "' target='_blank'>"
                  . $page_modules
                  . "</a></div><div class='ul_div_td_25'>"
                  . $cpage
                  . "</div><br style='clear:both;'>";
        }
  echo "</div><br style='clear:both;'>";
    $visit2 = $GLOBALS['xoopsDB']->query('SELECT distinct nav, count(nav) as cnav, langue FROM '
                                          . $xoopsDB->prefix('visit_user_page')
                                          . " WHERE nom = '$vm' GROUP BY nav ORDER BY cnav DESC");
    $visi2=mysqli_num_rows($visit2);

  echo "<div style='float:left;color:blue;font-weight:600;'>"
        . _AD_USERVISIT_OSOF
        . "&nbsp;"
        . $vm
        . "</div><br><br style='clear:both;'><div style='text-align:center;'><div class='ul_div_th_45'>"
        . _AD_USERVISIT_OS
        . "</div><div class='ul_div_th_10'>"
        . _AD_USERVISIT_PAGES
        . "</div><div class='ul_div_th_25'>"
        . _AD_USERVISIT_LANG
        . "</div><br style='clear:both;'>";

      while (list($nav, $cnav, $langue) = $GLOBALS['xoopsDB']->fetchRow($visit2)) {
          echo "<div style='text-align:center;'><div class='ul_div_td_45'>"
                . $nav
                . "</div><div class='ul_div_td_u_10'>"
                . $cnav
                . "</div><div class='ul_div_td_25'>"
                . $langue
                . "</div></div>";
      }
  echo "</div><br style='clear:both;'>";
  echo "<div style='float:left;color:blue;font-weight:600;'>"
        . _AD_USERVISIT_INFO
        . "&nbsp;"
        . $vm
        . "</div><br><br style='clear:both;'>";
  
    $result = $GLOBALS['xoopsDB']->query('SELECT name, email, url, user_regdate, user_icq, user_from, user_aim, user_yim, user_msnm, user_occ, bio FROM '
                                          . $xoopsDB->prefix('users')
                                          . " where uname='$vm'");
    if (mysqli_num_rows($result)==1) {
        while ($user = mysqli_fetch_array($result)) {
            $date = formatTimestamp($user['user_regdate'], 's');
            echo "<div style='float:left;font-weight:600;text-align:left;'>";
            echo _AD_USERVISIT_DATE . " " . $date . "<br>";
            if ($user['name']) {
                echo _AD_USERVISIT_NAME . ": " . $user[name] . "<br>";
            }
            if ($user['url']) {
                echo _AD_USERVISIT_WEBSITE . " <a href=" . $user[url] . " target='_blank'>" . $user[url] . "</a><br>";
            }
            if ($user['email']) {
                echo _AD_USERVISIT_MAIL . " <a href='mailto:" . $user[email] . "'>" . $user[email] . "</a><br>";
            }
            if ($user['user_occ']) {
                echo _AD_USERVISIT_OCCUP . " " . $user[user_occ] . "<br>";
            }
            if ($user['user_icq']) {
                echo _AD_USERVISIT_ICQ . " " . $user[user_icq] . "<br>";
            }
            if ($user['user_aim']) {
                echo _AD_USERVISIT_AIM . " " . $user[user_aim] . "<br>";
            }
            if ($user['user_yim']) {
                echo _AD_USERVISIT_YIM . " " . $user[user_yim] . "<br>";
            }
            if ($user['user_msnm']) {
                echo _AD_USERVISIT_MSNM . " " . $user[user_msnm] . "<br>";
            }
            if ($user['user_from']) {
                echo _AD_USERVISIT_FROM . " " . $user[user_from] . "<br>";
            }
            if ($user['bio']) {
                echo _AD_USERVISIT_BIO . " " . $user[bio] . "<br>";
            }
            echo "</div>";
        }
    } else {
        echo "<div style='margin:auto;text-align:center;color:blue;'>"
              . _AD_USERVISIT_NOINFO
              . "&nbsp;<strong style='color:#FF0000'>"
              . $vm
              . "</strong></div>";
    }

  echo "<br><br style='clear:both;'>";
    
if ($visi == 0) {
    echo "<br style='clear:both;'></fieldset>";
} else {
    echo "<br><hr style='border:1px dashed black;'><br><div style='text-align:center;'><div class='ul_button'><a href='admin.php'>"
          . _AD_USERVISIT_BACKLIST
          . "</a></div>&nbsp;&nbsp;<div class='ul_button'><a href='suppr-visit.php?su=mems'>"
          . _AD_USERVISIT_DELSTAT
          . '</a></div></div></fieldset>';
}

require_once __DIR__ . '/admin_footer.php';
