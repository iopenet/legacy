<?php
/**
 * ThemeSelectForm.class.php
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

/***
 * @internal
 *
 */
class Legacy_ThemeSelectForm extends XCube_ActionForm
{
    public function getTokenName()
    {
        return 'module.legacy.ThemeSelectForm.TOKEN';
    }

    public function prepare()
    {
        //
        // Set form properties
        //
        $this->mFormProperties['select'] =new XCube_BoolArrayProperty('select');
        $this->mFormProperties['choose'] =new XCube_StringArrayProperty('choose');
    }

    /**
     * @access public
     */
    public function getChooseTheme()
    {
        foreach ($this->get('choose') as $dirname => $dmy) {
            return $dirname;
        }

        return null;
    }

    public function getSelectableTheme()
    {
        $ret = [];

        foreach ($this->get('select') as $themeName => $isSelect) {
            if (1 === $isSelect) {
                $ret[] = $themeName;
            }
        }

        return $ret;
    }

    public function load(&$themeArr)
    {
        foreach ($themeArr as $themeName) {
            $this->set('select', $themeName, 1);
        }
    }
}
