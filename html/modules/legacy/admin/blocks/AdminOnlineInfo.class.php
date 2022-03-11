<?php
/**
 * Admin Users Online
 * @package    Legacy
 * @version    XCL 2.3.1
 * @author     Other authors gigamaster, 2020 XCL/PHP7
 * @author     Kilica
 * @copyright  (c) 2005-2022 The XOOPSCube Project
 * @license    https://github.com/xoopscube/xcl/blob/master/GPL_V2.txt
 */

if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

class Legacy_AdminOnlineInfo extends Legacy_AbstractBlockProcedure
{
    public function getName()
    {
        return 'onlineinfo';
    }

    public function getTitle()
    {
        return 'TEST: AdminOnlineInfo';
    }

    public function getEntryIndex()
    {
        return 0;
    }

    public function isEnableCache()
    {
        return false;
    }

    public function execute()
    {
        $render =& $this->getRenderTarget();

        // Load theme template ie fallback
        $render->setAttribute('legacy_module', 'legacy');
        $render->setTemplateName('legacy_admin_block_onlineinfo.html');

        $root =& XCube_Root::getSingleton();
        $root->mLanguageManager->loadBlockMessageCatalog('user');
        require_once XOOPS_ROOT_PATH . '/modules/user/blocks/user_online.php';

        $contents = b_user_online_show();

        $render->setAttribute('contents', $contents);
        $render->setAttribute('blockid', $this->getName());

        $renderSystem =& $root->getRenderSystem($this->getRenderSystemName());
        $renderSystem->renderBlock($render);
    }

    public function hasResult()
    {
        return true;
    }

    public function &getResult()
    {
        $dmy = 'dummy';
        return $dmy;
    }

    public function getRenderSystemName()
    {
        return 'Legacy_AdminRenderSystem';
    }
}


