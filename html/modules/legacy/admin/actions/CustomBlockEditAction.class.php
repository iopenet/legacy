<?php
/**
 * CustomBlockEditAction.class.php
 * @package    Legacy
 * @version    XCL 2.3.1
 * @author     Other authors gigamaster, 2020 XCL/PHP7
 * @author     Kilica, 2008/09/25
 * @copyright  (c) 2005-2022 The XOOPSCube Project
 * @license    GPL 2.0
 */

if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

require_once XOOPS_MODULE_PATH . '/legacy/class/AbstractEditAction.class.php';
require_once XOOPS_MODULE_PATH . '/legacy/admin/actions/BlockEditAction.class.php';
require_once XOOPS_MODULE_PATH . '/legacy/admin/forms/CustomBlockEditForm.class.php';

class Legacy_CustomBlockEditAction extends Legacy_BlockEditAction
{
    public function _setupActionForm()
    {
        $this->mActionForm =new Legacy_CustomBlockEditForm();
        $this->mActionForm->prepare();
    }

    public function isEnableCreate()
    {
        return true;
    }

    public function _isEditable()
    {
        return true;
    }

    public function executeViewInput(&$controller, &$xoopsUser, &$render)
    {
        $render->setTemplateName('customblock_edit.html');
        $render->setAttribute('actionForm', $this->mActionForm);

        //
        // lazy loading
        //
        $this->mObject->loadModule();

        $render->setAttribute('object', $this->mObject);

        //
        // Build active modules list and set.
        //
        $handler =& xoops_gethandler('module');
        $moduleArr[0] =& $handler->create();
        $moduleArr[0]->set('mid', -1);
        $moduleArr[0]->set('name', _AD_LEGACY_LANG_TOPPAGE);

        $moduleArr[1] =& $handler->create();
        $moduleArr[1]->set('mid', 0);
        $moduleArr[1]->set('name', _AD_LEGACY_LANG_ALL_MODULES);

        $criteria =new CriteriaCompo();
        $criteria->add(new Criteria('hasmain', 1));
        $criteria->add(new Criteria('isactive', 1));

        $t_Arr =& $handler->getObjects($criteria);
        $moduleArr = array_merge($moduleArr, $t_Arr);
        $render->setAttribute('moduleArr', $moduleArr);

        $handler =& xoops_getmodulehandler('columnside');
        $columnSideArr =& $handler->getObjects();
        $render->setAttribute('columnSideArr', $columnSideArr);

        $handler =& xoops_gethandler('group');
        $groupArr =& $handler->getObjects();
        $render->setAttribute('groupArr', $groupArr);

        //
        // Build cachetime list and set.
        //
        $handler =& xoops_gethandler('cachetime');
        $cachetimeArr =& $handler->getObjects();
        $render->setAttribute('cachetimeArr', $cachetimeArr);

        //
        // Build ctype list and set.
        //
        $handler =& xoops_getmodulehandler('blockctype');
        $ctypeArr =& $handler->getObjects();
        $render->setAttribute('ctypeArr', $ctypeArr);
    }

    public function executeViewCancel(&$controller, &$xoopsUser, &$render)
    {
        if ($this->mObject->isNew()) {
            $controller->executeForward('./index.php?action=BlockInstallList');
        } else {
            $controller->executeForward('./index.php?action=BlockList');
        }
    }
}
