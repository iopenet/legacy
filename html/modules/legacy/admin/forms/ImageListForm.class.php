<?php
/**
 * This class is generated by makeActionForm tool.
 * @package    Legacy
 * @version    XCL 2.3.1
 * @author     Other authors gigamaster, 2020 XCL/PHP7
 * @author     code generator makeActionForm
 * @copyright  (c) 2005-2022 The XOOPSCube Project
 * @license    https://github.com/xoopscube/xcl/blob/master/GPL_V2.txt
 */

if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

require_once XOOPS_ROOT_PATH . '/core/XCube_ActionForm.class.php';

/**
 *
 * @auchor
 */
class Legacy_ImageListForm extends XCube_ActionForm
{
    /**
     * If the request is GET, never return token name.
     * By this logic, a action can have three page in one action.
     */
    public function getTokenName()
    {
        //
        //
        if ('POST' === xoops_getenv('REQUEST_METHOD')) {
            return 'module.legacy.ImageSettingsForm.TOKEN';
        } else {
            return null;
        }
    }

    /**
     * For displaying the confirm-page, don't show CSRF error.
     * Always return null.
     */
    public function getTokenErrorMessage()
    {
        return null;
    }

    public function prepare()
    {
        // set properties
        $this->mFormProperties['nicename']=new XCube_StringArrayProperty('nicename');
        $this->mFormProperties['weight']=new XCube_IntArrayProperty('weight');
        $this->mFormProperties['display']=new XCube_BoolArrayProperty('display');
        $this->mFormProperties['delete']=new XCube_BoolArrayProperty('delete');
        //to display error-msg at confirm-page
        $this->mFormProperties['confirm'] =new XCube_BoolProperty('confirm');
        // set fields
        $this->mFieldProperties['nicename'] =new XCube_FieldProperty($this);
        $this->mFieldProperties['nicename']->setDependsByArray(['required']);
        $this->mFieldProperties['nicename']->addMessage('required', _MD_LEGACY_ERROR_REQUIRED, _MD_LEGACY_LANG_IMAGE_NICENAME);

        $this->mFieldProperties['weight'] =new XCube_FieldProperty($this);
        $this->mFieldProperties['weight']->setDependsByArray(['required']);
        $this->mFieldProperties['weight']->addMessage('required', _MD_LEGACY_ERROR_REQUIRED, _AD_LEGACY_LANG_IMAGE_WEIGHT);
    }
}
