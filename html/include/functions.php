<?php
/**
 * Xoops functions (compatibility)
 * @package    XCL
 * @subpackage core
 * @version    XCL 2.3.1
 * @author     Other authors gigamaster, 2020 XCL PHP7
 * @author     Other authors Mumincacao, 2008/10/03
 * @author     Community
 * @copyright  (c) 2000-2003 XOOPS.org
 * @license    GPL 2.0
 * @brief      Functions for Compatibility with Xoops2
 */

// ################## Various functions from here ################

/**
 * @param $name
 * @return
 * @deprecated see RequestObject
 */
function xoops_getrequest($name)
{
    $root =& XCube_Root::getSingleton();
    return $root->mContext->mRequest->getRequest($name);
}

/**
 * @param bool $closehead
 * @deprecated
 */
function xoops_header($closehead = true)
{
    $root =& XCube_Root::getSingleton();
    $renderSystem =& $root->getRenderSystem('Legacy_RenderSystem');
    if ($renderSystem !== null) {
        $renderSystem->showXoopsHeader($closehead);
    }
}

/**
 * @deprecated
 */
function xoops_footer()
{
    $root =& XCube_Root::getSingleton();
    $renderSystem =& $root->getRenderSystem('Legacy_RenderSystem');
    if ($renderSystem !== null) {
        $renderSystem->showXoopsFooter();
    }
}

function xoops_error($message, $title='', $style='errorMsg')
{
    $root =& XCube_Root::getSingleton();
    $renderSystem =& $root->getRenderSystem($root->mContext->mBaseRenderSystemName);

    $renderTarget =& $renderSystem->createRenderTarget('main');

    $renderTarget->setAttribute('legacy_module', 'legacy');
    $renderTarget->setTemplateName('legacy_xoops_error.html');

    $renderTarget->setAttribute('style', $style);
    $renderTarget->setAttribute('title', $title);
    $renderTarget->setAttribute('message', $message);

    $renderSystem->render($renderTarget);

    print $renderTarget->getResult();
}

/**
 * @deprecated Don't use.
 * @param        $message
 * @param string $title
 */
function xoops_result($message, $title='')
{
    $root =& XCube_Root::getSingleton();
    $renderSystem =& $root->getRenderSystem($root->mContext->mBaseRenderSystemName);

    $renderTarget =& $renderSystem->createRenderTarget('main');

    $renderTarget->setAttribute('legacy_module', 'legacy');
    $renderTarget->setTemplateName('legacy_xoops_result.html');

    $renderTarget->setAttribute('title', $title);
    $renderTarget->setAttribute('message', $message);

    $renderSystem->render($renderTarget);

    print $renderTarget->getResult();
}

function xoops_confirm($hiddens, $action, $message, $submit = '', $addToken = true)
{
    //
    // Create token.
    //
    $tokenHandler = new XoopsMultiTokenHandler();
    $token =& $tokenHandler->create(XOOPS_TOKEN_DEFAULT);

    //
    // Register to session. And, set it to own property.
    //
    $tokenHandler->register($token);

    $root =& XCube_Root::getSingleton();
    $renderSystem =& $root->getRenderSystem($root->mContext->mBaseRenderSystemName);

    $renderTarget =& $renderSystem->createRenderTarget('main');

    $renderTarget->setAttribute('legacy_module', 'legacy');
    $renderTarget->setTemplateName('legacy_xoops_confirm.html');

    $renderTarget->setAttribute('action', $action);
    $renderTarget->setAttribute('message', $message);
    $renderTarget->setAttribute('hiddens', $hiddens);
    $renderTarget->setAttribute('submit', $submit);
    $renderTarget->setAttribute('tokenName', $token->getTokenName());
    $renderTarget->setAttribute('tokenValue', $token->getTokenValue());

    $renderSystem->render($renderTarget);

    print $renderTarget->getResult();
}

/**
 * @brief xoops_confirm alias [test]
 * @param        $hiddens
 * @param        $action
 * @param        $msg
 * @param string $submit
 */
function xoops_token_confirm($hiddens, $action, $msg, $submit='')
{
    return xoops_confirm($hiddens, $action, $msg, $submit, true);
}

function xoops_confirm_validate()
{
    return XoopsMultiTokenHandler::quickValidate(XOOPS_TOKEN_DEFAULT);
}

function xoops_refcheck($docheck=1)
{
    $ref = xoops_getenv('HTTP_REFERER');
    if ($docheck === 0) {
        return true;
    }
    if ($ref === '') {
        return false;
    }
    if (strpos($ref, XOOPS_URL) !== 0) {
        return false;
    }
    return true;
}

function xoops_getUserTimestamp($time, $timeoffset='')
{
    global $xoopsConfig, $xoopsUser;
    if ($timeoffset === '') {
        if ($xoopsUser) {
            static $offset;
            $timeoffset = $offset ?? $offset = $xoopsUser->getVar('timezone_offset', 'n');
        } else {
            $timeoffset = $xoopsConfig['default_TZ'];
        }
    }

    return (int)$time + ((int)$timeoffset - $xoopsConfig['server_TZ'])*3600;
}

/*
 * Function to display formatted times in user timezone
 */
function formatTimestamp($time, $format='l', $timeoffset='')
{
    $usertimestamp = xoops_getUserTimestamp($time, $timeoffset);
    return _formatTimeStamp($usertimestamp, $format);
}

/*
 * Function to display formatted times in user timezone
 */
function formatTimestampGMT($time, $format='l', $timeoffset='')
{
    if ($timeoffset === '') {
        global $xoopsUser;
        if ($xoopsUser) {
            $timeoffset = $xoopsUser->getVar('timezone_offset', 'n');
        } else {
            $timeoffset = $GLOBALS['xoopsConfig']['default_TZ'];
        }
    }

    $usertimestamp = (int)$time + ((int)$timeoffset)*3600;
    return _formatTimeStamp($usertimestamp, $format);
}

function _formatTimeStamp($time, $format='l')
{
    switch (strtolower($format)) {
    case 's':
        $datestring = _SHORTDATESTRING;
        break;
    case 'm':
        $datestring = _MEDIUMDATESTRING;
        break;
    case 'mysql':
        $datestring = 'Y-m-d H:i:s';
        break;
    case 'rss':
        $datestring = 'r';
        break;
    case 'l':
        $datestring = _DATESTRING;
        break;
    default:
        if ($format !== '') {
            $datestring = $format;
        } else {
            $datestring = _DATESTRING;
        }
        break;
    }
    return ucfirst(date($datestring, $time));
}

/*
 * Function to calculate server timestamp from user entered time (timestamp)
 */
function userTimeToServerTime($timestamp, $userTZ=null)
{
    global $xoopsConfig;
    if (!isset($userTZ)) {
        $userTZ = $xoopsConfig['default_TZ'];
    }
    //@gigamaster changed short this : $timestamp = $timestamp - (($userTZ - $xoopsConfig['server_TZ']) * 3600);
    $timestamp -= (($userTZ - $xoopsConfig['server_TZ']) * 3600);
    return $timestamp;
}

function xoops_makepass()
{
    $makepass = '';
    $syllables = ['er', 'in', 'tia', 'wol', 'fe', 'pre', 'vet', 'jo', 'nes', 'al', 'len', 'son', 'cha', 'ir', 'ler', 'bo', 'ok', 'tio', 'nar', 'sim', 'ple', 'bla', 'ten', 'toe', 'cho', 'co', 'lat', 'spe', 'ak', 'er', 'po', 'co', 'lor', 'pen', 'cil', 'li', 'ght', 'wh', 'at', 'the', 'he', 'ck', 'is', 'mam', 'bo', 'no', 'fi', 've', 'any', 'way', 'pol', 'iti', 'cs', 'ra', 'dio', 'sou', 'rce', 'sea', 'rch', 'pa', 'per', 'com', 'bo', 'sp', 'eak', 'st', 'fi', 'rst', 'gr', 'oup', 'boy', 'ea', 'gle', 'tr', 'ail', 'bi', 'ble', 'brb', 'pri', 'dee', 'kay', 'en', 'be', 'se'];
    mt_srand((double)microtime() * 1000000);
    for ($count = 1; $count <= 4; $count++) {
        if (mt_rand() % 10 === 1) {
            $makepass .= sprintf('%0.0f', (mt_rand() % 50) + 1);
        } else {
            $makepass .= sprintf('%s', $syllables[mt_rand() % 62]);
        }
    }
    return $makepass;
}

/*
 * Functions to display dhtml loading image box
 */
function OpenWaitBox()
{
    $GLOBALS['xoopsLogger']->addDeprecated('Function ' . __FUNCTION__ . '() is deprecated');
    echo '<div id="waitDiv" style="position:absolute;left:40%;top:50%;visibility:hidden;text-align: center;">
    <table class="table outer">
      <tr>
        <td align="center"><b>' ._FETCHING.'</b><br><img src="'.XOOPS_URL.'/images/await.gif" alt=""><br>' ._PLEASEWAIT.'</td>
      </tr>
    </table>
    </div>
    <script type="text/javascript">
    <!--//
    var DHTML = (document.getElementById || document.all || document.layers);
    function ap_getObj(name) {
        if (document.getElementById) {
            return document.getElementById(name).style;
        } else if (document.all) {
            return document.all[name].style;
        } else if (document.layers) {
            return document.layers[name];
        }
    }
    function ap_showWaitMessage(div,flag)  {
        if (!DHTML) {
            return;
        }
        var x = ap_getObj(div);
        x.visibility = (flag) ? "visible" : "hidden";
        if (!document.getElementById) {
            if (document.layers) {
                x.left=280/2;
            }
        }
        return true;
    }
    ap_showWaitMessage("waitDiv", 1);
    //-->
    </script>';
}

function CloseWaitBox()
{
    echo '<script type="text/javascript">
    <!--//
    ap_showWaitMessage("waitDiv", 0);
    //-->
    </script>
    ';
}

function checkEmail($email, $antispam = false)
{
    if (!$email || !preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+([\.][a-z0-9-]+)+$/i', $email)) {
        return false;
    }
    if ($antispam) {
        $email = str_replace('@', ' at ', $email);
        $email = str_replace('.', ' dot ', $email);
        return $email;
    }

    return true;
}

function formatURL($url)
{
    $url = trim($url);
    if ($url !== '') {
        if ((!preg_match('/^http[s]*:\/\//i', $url))
            && (!preg_match('/^ftp*:\/\//i', $url))
			/* InterPlanetary File System (IPFS) is a protocol and peer-to-peer network */
            && (!preg_match('/^ipfs*:\/\//i', $url))
            && (!preg_match('/^ed2k*:\/\//i', $url))) {
            $url = 'https://'.$url;
        }
    }
    return $url;
}

/*
 * Function to display banners in all pages
 */
function showbanner()
{
    echo xoops_getbanner();
}

/*
 * Function to get the banner html tags for templates
 */
function xoops_getbanner()
{
    global $xoopsConfig;
    $db =& Database::getInstance();
    $bresult = $db->query('SELECT COUNT(*) FROM ' . $db->prefix('banner'));
    [$numrows] = $db->fetchRow($bresult);
    if ($numrows > 1) {
        $numrows = $numrows-1;
        mt_srand((double)microtime()*1000000);
        try {
            $bannum = random_int (0, $numrows);
        } catch (Exception $e) {
        }
    } else {
        $bannum = 0;
    }
    if ($numrows > 0) {
        $bresult = $db->query('SELECT * FROM ' . $db->prefix('banner'), 1, $bannum);
        [$bid, $cid, $imptotal, $impmade, $clicks, $imageurl, $clickurl, $date, $htmlbanner, $htmlcode] = $db->fetchRow($bresult);
        if ($xoopsConfig['my_ip'] == xoops_getenv('REMOTE_ADDR')) {
            // EMPTY
        } else {
            $db->queryF(sprintf('UPDATE %s SET impmade = impmade+1 WHERE bid = %u', $db->prefix('banner'), $bid));
        }
        /* Check if this impression is the last one and print the banner */
        if ($imptotal !== 0 && $imptotal == $impmade) {
            $newid = $db->genId($db->prefix('bannerfinish') . '_bid_seq');
            $sql = sprintf('INSERT INTO %s (bid, cid, impressions, clicks, datestart, dateend) VALUES (%u, %u, %u, %u, %u, %u)', $db->prefix('bannerfinish'), $newid, $cid, $impmade, $clicks, $date, time());
            $db->queryF($sql);
            $db->queryF(sprintf('DELETE FROM %s WHERE bid = %u', $db->prefix('banner'), $bid));
        }
        if ($htmlbanner) {
            $bannerobject = $htmlcode;
        } else {
            $bannerobject = '<div><a href="'.XOOPS_URL.'/banners.php?op=click&amp;bid='.$bid.'" rel="external">';
            $bannerobject .= '<img src="' . $imageurl . '" alt="">';
            $bannerobject .= '</a></div>';
        }
        return $bannerobject;
    }
}

/*
* Function to redirect user to certain pages
*/
function redirect_header($url, $time = 3, $message = '', $addredirect = true)
{
    global $xoopsConfig, $xoopsRequestUri;
    if (preg_match('/[\\0-\\31]/', $url) || preg_match('/^(javascript|vbscript|about):/i', $url)) {
        $url = XOOPS_URL;
    }
    if (!defined('XOOPS_CPFUNC_LOADED')) {
        require_once XOOPS_ROOT_PATH.'/class/template.php';
        $xoopsTpl = new XoopsTpl();
        //@gigamaster changed this to save memory
        if ($addredirect && strpos($url, 'user.php') !== false) {
            if (strpos($url, '?') === false) {
                $url .= '?xoops_redirect='.urlencode($xoopsRequestUri);
            } else {
                $url .= '&amp;xoops_redirect='.urlencode($xoopsRequestUri);
            }
        }
        if (defined('SID') && (! isset($_COOKIE[session_name()]) || ($xoopsConfig['use_mysession'] && '' !== $xoopsConfig['session_name'] && !isset($_COOKIE[$xoopsConfig['session_name']])))) {
            if (strpos($url, XOOPS_URL) === 0) {
                //@gigamaster changed this to save memory
                if (strpos($url, '?') === false) {
                    $connector = '?';
                } else {
                    $connector = '&amp;';
                }
                //@gigamaster changed this to save memory
                if (strpos($url, '#') !== false) {
                    $urlArray = explode('#', $url);
                    $url = $urlArray[0] . $connector . SID;
                    if (! empty($urlArray[1])) {
                        $url .= '#' . $urlArray[1];
                    }
                } else {
                    $url .= $connector . SID;
                }
            }
        }
        $url = preg_replace('/&amp;/i', '&', htmlspecialchars($url, ENT_QUOTES));
        $message = trim($message) !== '' ? $message : _TAKINGBACK;
        $xoopsTpl->assign(
            [
                'xoops_sitename'   =>htmlspecialchars($xoopsConfig['sitename'], ENT_QUOTES),
                'sitename'         =>htmlspecialchars($xoopsConfig['sitename'], ENT_QUOTES),
                'langcode'         =>_LANGCODE,
                'charset'          =>_CHARSET,
                'time'             =>$time,
                'url'              =>$url,
                'message'          =>$message,
                'lang_ifnotreload' =>sprintf(_IFNOTRELOAD, $url)
            ]
        );
        $GLOBALS['xoopsModuleUpdate'] = 1;
        $xoopsTpl->display('db:system_redirect.html');
        exit();
    }
    //@gigamaster split workflow
    $url = preg_replace('/&amp;/i', '&', htmlspecialchars($url, ENT_QUOTES));
    //File from module templates for ease of customization
    $file = XOOPS_ROOT_PATH.'/modules/legacy/templates/legacy_redirect_function.html';
    if (file_exists($file)) {
        include $file;
        die();
    } else {

        echo '
            <!DOCTYPE html>
            <head>
            <title>' . htmlspecialchars($xoopsConfig['sitename']) . '</title>
            <meta http-equiv="Content-Type" content="text/html; charset=' . _CHARSET . '">
            <meta>
            <link rel="stylesheet" href="' . XOOPS_URL . '/modules/legacy/admin/theme/style.css">
            <style>

            body {
                background      : rgb(35, 40, 47);
                color           : azure;
                margin          : 0;
                transition      : background 500ms ease-in-out, color 200ms ease;
                }

                a, a:visited {
                color           : orange;
                }
                a:hover {
                color           : #fff;
                }

                .wrapper-redirect {
                align-content   : center;
                display         : flex;
                flex-direction  : column;
                justify-content : center;
                min-height      : 100vh;
                }

                .wrapper-redirect > * {
                margin          : 1em auto;
                text-align      : center;
                }
                table {
                width           : 100%;
                border-spacing  : 1px;
                border-collapse : separate;
                }
                td {
                padding         : 1em 2em;
                }
                .icon-package {
                margin-right    : 1em;	   /* Space icon -> text  */
                vertical-align  : middle; /* Align icon and text */
                width           : 1.5em; /* Size icon to text   */
                }

                .cube-loading {
                    position    : relative;
                    width       : 227px;
                    height      : 227px;
                    line-height : 50px;
                    margin      : 0 auto;
                    cursor      : pointer;
                    transition  : 0.5s;
                }
                .cube-loading .vcenter {
                    margin      : 1em auto;
                    position    : absolute;
                    transform   : rotate(-45deg);
                    top         : 25%;
                    left        : 27%;
                }
                .cube-loading i {
                    position    : relative;
                    transition  : 0.2s;
                    top         : 0;
                }

                .cube-loading .cube-line1,
                .cube-loading .cube-line2,
                .cube-loading .cube-line3,
                .cube-loading .cube-line4 {
                    margin      : 0 auto;
                    line-height : 50px;
                    position    : absolute;
                    content     : "";
                }
                .cube-loading .cube-line1 {
                    top         : 0px;
                    left        : 0px;
                    right       : auto;
                    width       : 227px;
                    height      : 1px;
                    z-index     : -1;
                    animation   : impulse1 2s linear infinite;
                }
                .cube-loading .cube-line2 {
                    top         : 0px;
                    left        : 0px;
                    right       : auto;
                    width       : 1px;
                    height      : 227px;
                    z-index     : -1;
                    animation   : impulse2 2s linear infinite;
                }
                .cube-loading .cube-line3 {
                    top         : 0px;
                    left        : auto;
                    right       : 0;
                    width       : 0px;
                    height      : 227px;
                    z-index     : -1;
                    animation   : impulse2 2s 0.3s linear infinite;
                }
                .cube-loading .cube-line4	{
                    bottom      : 0px;
                    left        : 0px;
                    right       : auto;
                    width       : 227px;
                    height      : 0px;
                    z-index     : -1;
                    animation   : impulse1 2s 0.3s linear infinite;
                }
                @keyframes impulse1 {
                    0% {    width: 0px;	height: 1px; }
                    10% {   width: 227px;	left: 0;	right: auto; }
                    15% {   width: 227px;	right: 0;	left: auto; }
                    20% {   width: 0px; }
                    100% {  width: 0px;	right: 0;	left: auto; }
                    }
                    @keyframes impulse2 {
                    0% {    height: 0px; width: 1px; }
                    10% {   height: 227px; top: 0;	bottom: auto; }
                    15% {   height: 227px;	bottom: 0;	top: auto; }
                    20% {   height: 0px; }
                    100% {  height: 0px; bottom: 0;	top: auto; }
                    }

                .cube-loading {
                transform       : rotate(45deg);
                margin-bottom   : 50px;
                }
                .cube-line1 {
                    background  : linear-gradient(to right, transparent, #006eff, transparent);
                }
                .cube-line2 {
                    background  : linear-gradient(transparent, #006eff, transparent);
                }
                .cube-line3 {
                    background  : linear-gradient(transparent, rgb(250, 205, 115), transparent);
                }
                .cube-line4 {
                    background  : linear-gradient(to right, transparent, #ffe000, transparent);
                }

                .cube-loading {
                background  : rgba(35, 40, 47, 0.5);
                box-shadow  : 3px 9px 16px rgb(0,0,0,0.4), -3px -3px 10px rgba(255,255,255, 0.05), inset 14px 14px 26px rgb(0,0,0,0.4), inset -3px -3px 15px rgba(255,255,255, 0.05);
                background  : transparent;
                overflow    :hidden;
                transition  : all 0.3s ease-in-out 0s;
                }

                .cube-loading:hover{
                background  : linear-gradient(to right, rgba(31, 27, 21, 0.47), rgba(115, 127, 128, 0.15),  rgba(15, 99, 127, 0.47));
                border:1px solid rgba(21, 142, 215, 0.15);
                transition  : all 0.3s ease-in-out 0s;
                }

                </style>

            </head>
            <body>
            <div class="wrapper-redirect">
            <div class="cube-loading"><i class="vcenter">Loading</i>
                <div class="cube-line1"></div>
                <div class="cube-line2"></div>
                <div class="cube-line3"></div>
                <div class="cube-line4"></div>
            </div>
            <br>
            <h4>' . $message . '</h4>
            <p>' . sprintf(_IFNOTRELOAD, $url) . '</p>
            </div>
            </body>
            </html>';
        exit();
    }
}

function xoops_getenv($key)
{
    $ret = null;

        if (isset($_SERVER[$key]) || isset($_ENV[$key])) {
            $ret = $_SERVER[$key] ?? $_ENV[$key];
        }


    switch ($key) {
        case 'PHP_SELF':
        case 'PATH_INFO':
        case 'PATH_TRANSLATED':
            $ret = htmlspecialchars($ret, ENT_QUOTES);
            break;
    }

    return $ret;
}

/*
 * This function is deprecated. Do not use!
 */
function getTheme()
{
    $root =& XCube_Root::getSingleton();
    return $root->mContext->getXoopsConfig('theme_set');
}

/*
 * Function to get css file for a certain theme
 * This function will be deprecated.
 */
function getcss($theme = '')
{
    return xoops_getcss($theme);
}

/*
 * Function to get css file for a certain themeset
 */
function xoops_getcss($theme = '')
{
    if ($theme === '') {
        $theme = $GLOBALS['xoopsConfig']['theme_set'];
    }
    $uagent = xoops_getenv('HTTP_USER_AGENT');
    //@gigamaster removed MAC.css MSIE.css
    $str_css = '/style.css';

    if (is_dir($path = XOOPS_THEME_PATH.'/'.$theme)) {
        if (file_exists($path.$str_css)) {
            return XOOPS_THEME_URL.'/'.$theme.$str_css;
        }
        //@gigamaster split workflows
        if (file_exists($path.'/style.css')) {
            return XOOPS_THEME_URL.'/'.$theme.'/style.css';
        }
    }
    return '';
}

function &getMailer()
{
    global $xoopsConfig;
    $ret = null;
    require_once XOOPS_ROOT_PATH.'/class/xoopsmailer.php';
    if (file_exists(XOOPS_ROOT_PATH.'/language/'.$xoopsConfig['language'].'/xoopsmailerlocal.php')) {
        require_once XOOPS_ROOT_PATH.'/language/'.$xoopsConfig['language'].'/xoopsmailerlocal.php';
        if (XC_CLASS_EXISTS('XoopsMailerLocal')) {
            $ret = new XoopsMailerLocal();
            return $ret;
        }
    }
    $ret = new XoopsMailer();
    return $ret;
}

/**
 * This function is Fly-Weight to get an instance of XoopsObject in Legacy
 * Kernel.
 * @param      $name
 * @param bool $optional
 * @return bool|mixed|null
 */
function &xoops_gethandler($name, $optional = false)
{
    static $handlers= [];
    $name = strtolower(trim($name));
    if (isset($handlers[$name])) {
        return $handlers[$name];
    }

        //
        // The following delegate was tested with version Alpha4-c.
        //
        $handler = null;
    XCube_DelegateUtils::call('Legacy.Event.GetHandler', new XCube_Ref($handler), $name, $optional);
    if ($handler) {
	    $var = $handlers[ $name ] =& $handler;
	    return $var;
    }

    // internal Class handler exist
        if (XC_CLASS_EXISTS($class = 'Xoops'.ucfirst($name).'Handler')) {
            $handler = new $class($GLOBALS[ 'xoopsDB' ]);
            $handlers[ $name ] = $handler;
            return $handler;
        }
    include_once XOOPS_ROOT_PATH.'/kernel/'.$name.'.php';
    if (XC_CLASS_EXISTS($class)) {
        $handler = new $class($GLOBALS[ 'xoopsDB' ]);
        $handlers[ $name ] = $handler;
        return $handler;
    }

    if (!$optional) {
        trigger_error('Class <b>'.$class.'</b> does not exist<br>Handler Name: '.$name, E_USER_ERROR);
    }

    $falseRet = false;
    return $falseRet;
}

function &xoops_getmodulehandler($name = null, $module_dir = null, $optional = false)
{
    static $handlers;
    // if $module_dir is not specified
    if ($module_dir) {
        $module_dir = trim($module_dir);
    } else {
        //if a module is loaded
        global $xoopsModule;
        if ($xoopsModule) {
            $module_dir = $xoopsModule->getVar('dirname', 'n');
        } else {
            trigger_error('No Module is loaded', E_USER_ERROR);
        }
    }
    $name = $name ? trim($name) : $module_dir;
    $mhdr = &$handlers[$module_dir];
    if (isset($mhdr[$name])) {
        return $mhdr[$name];
    }
        //
        // Cube Style load class
        //
        if (file_exists($hnd_file = XOOPS_ROOT_PATH . '/modules/'.$module_dir.'/class/handler/' . ($ucname = ucfirst($name)) . '.class.php')) {
            include_once $hnd_file;
        } elseif (file_exists($hnd_file = XOOPS_ROOT_PATH . '/modules/'.$module_dir.'/class/'.$name.'.php')) {
            include_once $hnd_file;
        }

    $className = ($ucdir = ucfirst(strtolower($module_dir))) . '_' . $ucname . 'Handler';
    if (XC_CLASS_EXISTS($className)) {
        $mhdr[$name] = new $className($GLOBALS['xoopsDB']);
    } else {
        $className = $ucdir . $ucname . 'Handler';
        if (XC_CLASS_EXISTS($className)) {
            $mhdr[$name] = new $className($GLOBALS['xoopsDB']);
        }
    }

    if (!isset($mhdr[$name]) && !$optional) {
        trigger_error('Handler does not exist<br>Module: '.$module_dir.'<br>Name: '.$name, E_USER_ERROR);
    }

    return $mhdr[$name];
}

function xoops_getrank($rank_id =0, $posts = 0)
{
    $db =& Database::getInstance();
    $myts =& MyTextSanitizer::sGetInstance();
    $rank_id = (int)$rank_id;
    if ($rank_id !== 0) {
        $sql = 'SELECT rank_title AS title, rank_image AS image, rank_id AS id FROM '.$db->prefix('ranks').' WHERE rank_id = '.$rank_id;
    } else {
        $sql = 'SELECT rank_title AS title, rank_image AS image, rank_id AS id FROM '.$db->prefix('ranks').' WHERE rank_min <= '.$posts.' AND rank_max >= '.$posts.' AND rank_special = 0';
    }
    $rank = $db->fetchArray($db->query($sql));
    $rank['title'] = $myts->makeTboxData4Show($rank['title']);

    return $rank;
}


/**
* Returns partial string specified by the start and length parameters. If $trimmarker is supplied, it is appended to the return string.
* This function works fine with multi-byte characters if mb_* functions exist on the server.
*
* @param    string    $str
* @param    int       $start
* @param    int       $length
* @param    string    $trimmarker
*
* @return   string
*/
function xoops_substr($str, $start, $length, $trimmarker = '...')
{
    if (!XOOPS_USE_MULTIBYTES) {
        return (strlen($str) - $start <= $length) ? substr($str, $start, $length) : substr($str, $start, $length - strlen($trimmarker)) . $trimmarker;
    }
    if (function_exists('mb_internal_encoding') && @mb_internal_encoding(_CHARSET)) {
        $str2 = mb_strcut($str, $start, $length - strlen($trimmarker));
        return $str2 . (mb_strlen($str)!==mb_strlen($str2) ? $trimmarker : '');
    }
    // phppp patch
    $DEP_CHAR=127;
    $pos_st=0;
    $action = false;
    for ($pos_i = 0, $pos_iMax = strlen($str); $pos_i < $pos_iMax; $pos_i++) {
        //@gigamaster changed to array
        if (ord($str[$pos_i]) > 127) {
            $pos_i++;
        }
        if ($pos_i<=$start) {
            $pos_st=$pos_i;
        }
        if ($pos_i>=$pos_st+$length) {
            $action = true;
            break;
        }
    }
    return ($action) ? substr($str, $pos_st, $pos_i - $pos_st - strlen($trimmarker)) . $trimmarker : $str;
}

// RMV-NOTIFY
// ################ Notification Helper Functions ##################

// We want to be able to delete by module, by user, or by item.
// How do we specify this??

function xoops_notification_deletebymodule($module_id)
{
    $notification_handler =& xoops_gethandler('notification');
    return $notification_handler->unsubscribeByModule($module_id);
}

function xoops_notification_deletebyuser($user_id)
{
    $notification_handler =& xoops_gethandler('notification');
    return $notification_handler->unsubscribeByUser($user_id);
}

function xoops_notification_deletebyitem($module_id, $category, $item_id)
{
    $notification_handler =& xoops_gethandler('notification');
    return $notification_handler->unsubscribeByItem($module_id, $category, $item_id);
}

// ################### Comment helper functions ####################

function xoops_comment_count($module_id, $item_id = null)
{
    $comment_handler =& xoops_gethandler('comment');
    $criteria = new CriteriaCompo(new Criteria('com_modid', (int)$module_id));
    if (isset($item_id)) {
        $criteria->add(new Criteria('com_itemid', (int)$item_id));
    }
    return $comment_handler->getCount($criteria);
}

function xoops_comment_delete($module_id, $item_id)
{
    if ((int)$module_id > 0 && (int)$item_id > 0) {
        $comment_handler =& xoops_gethandler('comment');
        $comments =& $comment_handler->getByItemId($module_id, $item_id);
        if (is_array($comments)) {
            $deleted_num = [];
            //@gigamaster changed to foreach
            foreach ($comments as $i => $iValue) {
                if ($comment_handler->delete($comments[$i]) !== false) {
                    // store poster ID and deleted post number into array for later use
                    $poster_id = $iValue->getVar('com_uid', 'n');
                    if ($poster_id !== 0) {
                        $deleted_num[$poster_id] = !isset($deleted_num[$poster_id]) ? 1 : ($deleted_num[$poster_id] + 1);
                    }
                }
            }
            $member_handler =& xoops_gethandler('member');
            foreach ($deleted_num as $user_id => $post_num) {
                // update user posts
                $com_poster = $member_handler->getUser($user_id);
                if (is_object($com_poster)) {
                    $member_handler->updateUserByField($com_poster, 'posts', $com_poster->getVar('posts', 'n') - $post_num);
                }
            }
            return true;
        }
    }
    return false;
}

// ################ Group Permission Helper Functions ##################

function xoops_groupperm_deletebymoditem($module_id, $perm_name, $item_id = null)
{
    // do not allow system permissions to be deleted
    if ((int)$module_id <= 1) {
        return false;
    }
    $gperm_handler =& xoops_gethandler('groupperm');
    return $gperm_handler->deleteByModule($module_id, $perm_name, $item_id);
}

function &xoops_utf8_encode(&$text)
{
    if (XOOPS_USE_MULTIBYTES === 1) {
        if (function_exists('mb_convert_encoding')) {
            $out_text = mb_convert_encoding($text, 'UTF-8', 'auto');
            return $out_text;
        }
        return $out_text;
    }
    $out_text = utf8_encode($text);
    return $out_text;
}

function &xoops_convert_encoding(&$text)
{
    return xoops_utf8_encode($text);
}

function xoops_getLinkedUnameFromId($userid)
{
    $userid = (int)$userid;
    if ($userid > 0) {
        $member_handler =& xoops_gethandler('member');
        $user =& $member_handler->getUser($userid);
        if (is_object($user)) {
            $linkeduser = '<a href="'.XOOPS_URL.'/userinfo.php?uid='.$userid.'">'. $user->getVar('uname').'</a>';
            return $linkeduser;
        }
    }
    return $GLOBALS['xoopsConfig']['anonymous'];
}

function xoops_trim($text)
{
    if (function_exists('xoops_language_trim')) {
        return xoops_language_trim($text);
    }
    return trim($text);
}

if (!function_exists('htmlspecialchars_decode')) {
    function htmlspecialchars_decode($text)
    {
        return strtr($text, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
    }
}
