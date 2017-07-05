<?php
use Xmf\Request;
#######################################################
#  Visites de Membres version 2.1 pour Xoops 2.0.x	#
#  Copyright © 2002, Pascal Le Boustouller		#
#  Adaptation © 2003, Solo ( www.wolfpackclan.com )	#
#  Visites de Membres version 2.5 pour Xoops 2.5.8+	#
#  Adaptation © 2017 XOOPS 2.5.8+ (PHP7) - Aerograf
#  									#
#  Licence : GPL 							#
#######################################################
$moduleDirName = basename(__DIR__);
xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();
$xoops_url     = parse_url(XOOPS_URL);

$modversion = array(
          'name'              =>  _MI_USERVISIT_NAME,
          'version'           =>  2.5,
          'description'       =>  _MI_USERVISIT_DESC,
          'credits'           =>  'Pascal Le Boustouller',
          'author'            =>  'Solo ( www.wolfpackclan.com )',
          'license'           =>  'GPL see LICENSE',
          'official'          =>  0,
          'image'             =>  'assets/images/uservisit_slogo.png',
          'dirname'           =>  'uservisit',
          'min_php'           =>  '5.5',
          'min_xoops'         =>  '2.5.8+',
          'min_admin'         =>  '1.2',
          'module_website_url'    =>  'www.xoops.org',
          'module_website_name'   =>  'XOOPS',
          'module_status'     =>  'Beta 1 - Test',
          //sql tables
          'sqlfile'           =>  array('mysql' => 'sql/mysql.sql'),
          'tables'            =>  array(
                            'visit_user',
                            'visit_user_page'
          ),
          // Admin
          'hasAdmin'          =>  1,
          'adminindex'        =>  'admin/index.php',
          'adminmenu'         =>  'admin/menu.php',
          'system_menu'       =>  1,
          'use_smarty'        =>  1,
          'hasProfile'        =>  0,
          'hasMain'           =>  0,
          // XoopsInfo
          'developer_website_url'     =>  'https://www.shmel.org/forums/viewtopic.php?forum=8&topic_id=25',
          'developer_website_name'    =>  'SHMEL.ORG',
          'download_website'          =>  'https://github.com/aerograf/uservisit',
          'status_fileinfo'           =>  '',
          'status_version'            =>  'Test',
          'status'                    =>  'Beta1',
          'date'                      =>  '28.06.2017',
          'demo_site_url'             =>  '',
          'demo_site_name'            =>  '',
          'support_site_url'          =>  'https://github.com/aerograf/uservisit',
          'support_site_name'         =>  'GitHub',
          'submit_bug'                =>  'http://xoops.org/',
          'submit_feature'            =>  'http://xoops.org/'     
);

$modversion['hasNotification'] = 0;
