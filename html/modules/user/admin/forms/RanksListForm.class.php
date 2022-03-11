<?php

if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

require_once XOOPS_ROOT_PATH . '/core/XCube_ActionForm.class.php';

/**
 * This class is generated by makeActionForm tool.
 * @auchor makeActionForm
 */
class User_RanksListForm extends XCube_ActionForm
{
    /**
     * If the request is GET, never return token name.
     * By this logic, a action can have three page in one action.
     */
    public function getTokenName()
    {
        //
        //
        if ('POST' == xoops_getenv('REQUEST_METHOD')) {
            return 'module.user.RanksSettingsForm.TOKEN';
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
        $this->mFormProperties['title'] =new XCube_StringArrayProperty('title');
        $this->mFormProperties['min'] =new XCube_IntArrayProperty('min');
        $this->mFormProperties['max'] =new XCube_IntArrayProperty('max');
        $this->mFormProperties['delete']= new XCube_BoolArrayProperty('delete');
        //to display error-msg at confirm-page
        $this->mFormProperties['confirm'] =new XCube_BoolProperty('confirm');

        $this->mFieldProperties['title'] =new XCube_FieldProperty($this);
        $this->mFieldProperties['title']->setDependsByArray(['required', 'maxlength']);
        $this->mFieldProperties['title']->addMessage('required', _MD_USER_ERROR_REQUIRED, _AD_USER_LANG_RANK_TITLE, '50');
        $this->mFieldProperties['title']->addMessage('maxlength', _MD_USER_ERROR_MAXLENGTH, _AD_USER_LANG_RANK_TITLE, '50');
        $this->mFieldProperties['title']->addVar('maxlength', 50);

        $this->mFieldProperties['min'] =new XCube_FieldProperty($this);
        $this->mFieldProperties['min']->setDependsByArray(['required', 'min']);
        $this->mFieldProperties['min']->addMessage('required', _MD_USER_ERROR_REQUIRED, _AD_USER_LANG_RANK_MIN);
        $this->mFieldProperties['min']->addMessage('min', _AD_USER_ERROR_MIN, _AD_USER_LANG_RANK_MIN, 0);
        $this->mFieldProperties['min']->addVar('min', 0);

        $this->mFieldProperties['max'] =new XCube_FieldProperty($this);
        $this->mFieldProperties['max']->setDependsByArray(['required', 'min']);
        $this->mFieldProperties['max']->addMessage('required', _MD_USER_ERROR_REQUIRED, _AD_USER_LANG_RANK_MAX);
        $this->mFieldProperties['max']->addMessage('min', _AD_USER_ERROR_MIN, _AD_USER_LANG_RANK_MAX, 0);
        $this->mFieldProperties['max']->addVar('min', 0);
    }
}
