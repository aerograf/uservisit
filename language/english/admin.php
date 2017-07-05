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

//%%%%%%        File Name  index.php           %%%%%

define("_AD_USERVISIT_RANKING",		"Ranking by");
define("_AD_USERVISIT_NAME",			"Name");
define("_AD_USERVISIT_MEMBERS",		"Number of visitors :");
define("_AD_USERVISIT_LAST_VISITS",		"Last visit");
define("_AD_USERVISIT_OPTIONS",		"Options");
define("_AD_USERVISIT_PAGESVIEWS",		"Pages view");
define("_AD_USERVISIT_DETAILS",		"Visit details");
define("_AD_USERVISIT_DELET",			"Delete");
define("_AD_USERVISIT_DELALLSTATS",		"Delete all stats on members");


//%%%%%%        File Name  user-visit.php           %%%%%

define("_AD_USERVISIT_HEADER",		"The User visits of");
define("_AD_USERVISIT_BACK",			"Back to the list");
define("_AD_USERVISIT_DELSTAT",		"Delete all stats on members");
define("_AD_USERVISIT_NOVISIT",		"There is no visits recorded in the Data Base at the moment.");
define("_AD_USERVISIT_THEREIS",		"There were ");
define("_AD_USERVISIT_VISITFROM",		"visit(s) of");
define("_AD_USERVISIT_VISITS",		"Visits");
define("_AD_USERVISIT_PAGESVIEW",		"Pages View");
define("_AD_USERVISIT_LOADIN",		"First page loading");
define("_AD_USERVISIT_LOADOUT",		"Last page loading");
define("_AD_USERVISIT_VISITLENGHT",		"Visit time lenght");
define("_AD_USERVISIT_DELSTATOF",		"Delete old stats of");
define("_AD_USERVISIT_DELSTATNOTE",		"(Only the last visit is kept)");
define("_AD_USERVISIT_HASVISITED",		"has visited");
define("_AD_USERVISIT_DIFFPAGES",		"different page(s).");
define("_AD_USERVISIT_PAGES",			"Pages");
define("_AD_USERVISIT_VIEW",			"View");
define("_AD_USERVISIT_OS",			"Browser and OS");
define("_AD_USERVISIT_OSOF",			"Browser et OS used by");
define("_AD_USERVISIT_LANG",			"Language");
define("_AD_USERVISIT_INFO",			"Informations on");
define("_AD_USERVISIT_DATE",			"Registered on :");
define("_AD_USERVISIT_WEBSITE",		"Website :");
define("_AD_USERVISIT_MAIL",			"E-mail :");
define("_AD_USERVISIT_ICQ",			"Icq :");
define("_AD_USERVISIT_AIM",			"AIM :");
define("_AD_USERVISIT_YIM",			"YIM :");
define("_AD_USERVISIT_MSNM",			"Msn :");
define("_AD_USERVISIT_FROM",			"From :");
define("_AD_USERVISIT_BIO",			"Informations :");
define("_AD_USERVISIT_OCCUP",			"Occupation :");
define("_AD_USERVISIT_NOINFO",		"There are no informations available for");
define("_AD_USERVISIT_BACKLIST",		"Back to the list");
define("_AD_USERVISIT_CREDIT",		"Uservisit 2.1 is an original creation of");
define("_AD_USERVISIT_AND",			"adapted by");

//%%%%%%        File Name  suppr-visit.php           %%%%%

define("_AD_USERVISIT_ALLSTATS",		"All the stats about");
define("_AD_USERVISIT_DELETED",		"have been deleted !");
define("_AD_USERVISIT_TOTALDELET",		"All the stats have been deleted");
define("_AD_USERVISIT_DELSTATS",		"Are you sure you want to delet all the stats about");
define("_AD_USERVISIT_DELSTATSALL",		"Are you sure you want to delet all the stats?");
define("_AD_USERVISIT_YES",			"Yes");
define("_AD_USERVISIT_NO",			"No");
define("_AD_USERVISIT_OLDSTATS",		"Old stats of ");
define("_AD_USERVISIT_DELOLDSTATS",		"Are you sure you want to delet all the old stats about");

define("_AD_USERVISIT_STARTUP_DATA","Module status");
define("_AD_USERVISIT_STARTUP_DATA_ON","Module Enabled");
define("_AD_USERVISIT_STARTUP_DATA_OFF","The module is not active. To activate the module, you must copy the <strong style='color:black;'>include_once XOOPS_ROOT_PATH.'/modules/uservisit/index.php';</strong> And paste at the end of the file /footer.php, located in the root of the site, before the last line.<br /><strong style='color:red;'>Attention:</strong> Insert the line as it is without making any changes!");