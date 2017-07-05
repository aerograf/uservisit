<?php
/**
 * Printliminator module
 *
 * @copyright	The XOOPS Project https://github.com/XoopsModules25x
 * @license             http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package	Printliminator
 * @since		0.1.0
 * @author 	aerograf <https://www.shmel.org>
 * @version	$Id: blocks_mytype.php 2017-06-06 
**/
                                                                      
include_once __DIR__ . '/admin_header.php';
xoops_cp_header();
$adminObject  = \Xmf\Module\Admin::getInstance();
$adminObject->addInfoBox(_AD_USERVISIT_STARTUP_DATA);
if (strpos(file_get_contents('../../../footer.php'), "include_once XOOPS_ROOT_PATH.'/modules/uservisit/index.php';")) {
    $adminObject->addInfoBoxLine('<label><img class="ul_menu_ind" src="../assets/images/big_brother.gif">&nbsp;&mdash;&nbsp;<span class="green">' . _AD_USERVISIT_STARTUP_DATA_ON . '</span></label>', '', '');
} else {
    $adminObject->addInfoBoxLine('<label><img class="ul_menu_ind" src="../assets/images/attention.png"><br /><span class="blue">' . _AD_USERVISIT_STARTUP_DATA_OFF . '</span></label>', '', '');
}
$adminObject->displayNavigation(basename(__FILE__));
$adminObject->displayIndex();

include_once __DIR__ . '/admin_footer.php';
