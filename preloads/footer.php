<?php
defined('XOOPS_ROOT_PATH') || exit('Restricted access');

/**
 * Class uservisitFooterPreload
 */
class uservisitFooterPreload extends XoopsPreloadItem
{
    public function eventCoreFooterStart()
    {
        include XOOPS_ROOT_PATH . '/modules/uservisit/index.php';
    }
}
