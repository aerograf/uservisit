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
if (!isset($moduleDirName)) {
    $moduleDirName = basename(dirname(__DIR__));
}

if (false !== ($moduleHelper = Xmf\Module\Helper::getHelper($moduleDirName))) {
} else {
    $moduleHelper = Xmf\Module\Helper::getHelper('system');
}
$adminObject = \Xmf\Module\Admin::getInstance();

$pathIcon32    = \Xmf\Module\Admin::menuIconPath('');
$pathModIcon32 = $moduleHelper->getModule()->getInfo('modicons32');

$moduleHelper->loadLanguage('modinfo');
$moduleHelper->loadLanguage('admin');

$adminmenu = [
    [
     'title'   =>  _MI_USERVISIT_ADMENU0,
     'link'    =>  'admin/index.php',
     'desc'    =>  '',
     'icon'    =>    $pathModIcon32 . '/slogo.png'
    ],
    [
     'title'   =>  _MI_USERVISIT_ADMENU1,
     'link'    =>  'admin/admin.php',
     'desc'    =>  '',
     'icon'    =>    $pathModIcon32 . '/view.png'
    ],
    [
     'title'   =>  _MI_USERVISIT_ADMENU2,
     'link'    =>  'admin/suppr-visit.php?su=mems',
     'desc'    =>  '',
     'icon'    =>    $pathModIcon32 . '/del.png'
    ],
    [
     'title'   =>  _MI_USERVISIT_ADMENU3,
     'link'    =>  'admin/about.php',
     'desc'    =>  '',
     'icon'    =>    $pathModIcon32 . '/about.png'
    ]
];
