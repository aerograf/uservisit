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
$pathIcon32 = \Xmf\Module\Admin::iconUrl('', 32);
echo "<br style='clear:both;' />";
echo "<div class='center smallsmall italic pad5'><strong>" . $xoopsModule->getVar('name') . "</strong> is maintained by the <br /><br /><a class='tooltip' rel='external' href='http://www.xoops.org/' title='Visit XOOPS Community'><img src='{$pathIcon32}/xoopsmicrobutton.gif' alt='XOOPS' title='XOOPS'></a></div>";
xoops_cp_footer();
