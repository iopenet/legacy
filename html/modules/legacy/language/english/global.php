<?php
// $Id: global.php, Syntax replace define with const v2.3.0 2021/05/15 @gigamaster XCL-PHP7

const _TOKEN_ERROR = 'Alert ! This prevent you from instantiating a malformed request or post. Please, submit again to confirm!';
const _SYSTEM_MODULE_ERROR = 'The following modules are required.';
const _INSTALL = 'Install';
const _UNINSTALL = 'Uninstall';
const _SYS_MODULE_UNINSTALLED = 'Required (Not Installed)';
const _SYS_MODULE_DISABLED = 'Required (Disabled)';
const _SYS_RECOMMENDED_MODULES = 'Recommended Module';
const _SYS_OPTION_MODULES = 'Optional Module';
const _UNINSTALL_CONFIRM = 'Are you sure to uninstall system module?';

//%%%%%%	File Name mainfile.php 	%%%%%
const _PLEASEWAIT = 'Please Wait';
const _FETCHING = 'Loading...';
const _TAKINGBACK = 'Taking you back to where you were....';
const _LOGOUT = 'Logout';
const _SUBJECT = 'Subject';
const _MESSAGEICON = 'Message Icon';
const _COMMENTS = 'Comments';
const _POSTANON = 'Post Anonymously';
const _DISABLESMILEY = 'Disable smiley';
const _DISABLEHTML = 'Disable html';
const _PREVIEW = 'Preview';

const _GO = 'Apply';
const _NESTED = 'Nested';
const _NOCOMMENTS = 'No Comments';
const _FLAT = 'Flat';
const _THREADED = 'Threaded';
const _OLDESTFIRST = 'Oldest First';
const _NEWESTFIRST = 'Newest First';
const _MORE = 'more...';
const _MULTIPAGE = 'To have your article span multiple pages, insert the word <span style="color:red">[pagebreak]</span> (with brackets) in the article.';
const _IFNOTRELOAD = "If the page does not automatically reload, please [ <a href='%s'>click here</a> ]";
const _WARNINSTALL2 = "WARNING: Directory {0} exists on your server.<br/> Add a password to the file install/passwd.php or remove this directory for security reasons.";
const _WARNINWRITEABLE = "WARNING: File {0} is writeable by the server.<br/> Change permissions of this file for security reasons. Unix (0444), Windows (read-only)";
const _WARNPHPENV = 'WARNING: php.ini parameter "%s" is set to "%s". %s';
const _WARNSECURITY = '(It may cause a security problem)';
const _WARN_INSTALL_TIP = 'Activate the Preload — For development purposes only!<br>The preload allows to keep mainfile unchanged and install directory.<br>Remember to chomd and delete install to prevent any security problem.';

//%%%%%%	File Name themeuserpost.php 	%%%%%
const _PROFILE = 'Profile';
const _POSTEDBY = 'Posted by';
const _VISITWEBSITE = 'Visit Website';
const _SENDPMTO = 'Send Private Message to %s';
const _SENDEMAILTO = 'Send Email to %s';
const _ADD = 'Add';
const _REPLY = 'Reply';
const _DATE = 'Date';   // Posted date

//%%%%%%	File Name admin_functions.php 	%%%%%
const _MAIN = 'Main';
const _MANUAL = 'Manual';
const _INFO = 'Info';
const _CPHOME = 'Control Panel Home';
const _YOURHOME = 'Home Page';

//%%%%%%	File Name misc.php (who's-online popup)	%%%%%
const _WHOSONLINE = "Who's Online";
const _GUESTS = 'Guests';
const _MEMBERS = 'Members';
const _ONLINEPHRASE = '%s user(s) are online';
const _ONLINEPHRASEX = '%s user(s) are browsing %s';
const _CLOSE = 'Close';  // Close window

//%%%%%%	File Name module.textsanitizer.php 	%%%%%
const _QUOTEC = 'Quote:';

//%%%%%%	File Name admin.php 	%%%%%
const _NOPERM = "Sorry, you don't have the permission to access this area.";

//%%%%%		Common Phrases		%%%%%
const _NO = 'No';
const _YES = 'Yes';
const _EDIT = 'Edit';
const _DELETE = 'Delete';
const _VIEW = 'View';
const _SUBMIT = 'Submit';
const _MODULENOEXIST = 'Selected module does not exist!';
const _ALIGN = 'Align';
const _LEFT = 'Left';
const _CENTER = 'Center';
const _RIGHT = 'Right';
const _FORM_ENTER = 'Please enter %s';
// %s represents file name
const _MUSTWABLE = 'File %s must be writable by the server!';
// Module info
const _PREFERENCES = 'Preferences';
const _VERSION = 'Version';
const _DESCRIPTION = 'Description';
const _ERRORS = 'Errors';
const _NONE = 'None';
const _ON = 'on';
const _READS = 'reads';
const _WELCOMETO = 'Welcome to %s';
const _SEARCH = 'Search';
const _ALL = 'All';
const _TITLE = 'Title';
const _OPTIONS = 'Options';
const _QUOTE = 'Quote';
const _LIST = 'List';
const _LOGIN = 'User Login';
const _USERNAME = 'Username';
const _PASSWORD = 'Password';
const _SELECT = 'Select';
const _IMAGE = 'Image';
const _SEND = 'Send';
const _CANCEL = 'Cancel';
const _ASCENDING = 'Ascending order';
const _DESCENDING = 'Descending order';
const _BACK = 'Back';
const _NOTITLE = 'No title';
const _RETURN_TOP = 'returns to the top';

/* Image manager */
const _IMGMANAGER = 'Image Manager';
const _NUMIMAGES = '%s images';
const _ADDIMAGE = 'Add Image File';
const _IMAGENAME = 'Name:';
const _IMGMAXSIZE = 'Max size allowed (bytes):';
const _IMGMAXWIDTH = 'Max width allowed (pixels):';
const _IMGMAXHEIGHT = 'Max height allowed (pixels):';
const _IMAGECAT = 'Category:';
const _IMAGEFILE = 'Image file:';
const _IMGWEIGHT = 'Display order in image manager:';
const _IMGDISPLAY = 'Display this image?';
const _IMAGEMIME = 'MIME type:';
const _FAILFETCHIMG = 'Could not get uploaded file %s';
const _FAILSAVEIMG = 'Failed storing image %s into the database';
const _NOCACHE = 'No Cache';
const _CLONE = 'Clone';

//%%%%%	File Name class/xoopsform/formmatchoption.php 	%%%%%
const _STARTSWITH = 'Starts with';
const _ENDSWITH = 'Ends with';
const _MATCHES = 'Matches';
const _CONTAINS = 'Contains';

//%%%%%%	File Name commentform.php 	%%%%%
const _REGISTER = 'Register';

//%%%%%%	File Name xoopscodes.php 	%%%%%
const _SIZE = 'SIZE';  // font size
const _FONT = 'FONT';  // font family
const _COLOR = 'COLOR';  // font color
const _EXAMPLE = 'SAMPLE';
const _ENTERURL = 'Enter the URL of the link you want to add:';
const _ENTERWEBTITLE = 'Enter the web site title:';
const _ENTERIMGURL = 'Enter the URL of the image you want to add.';
const _ENTERIMGPOS = 'Now, enter the position of the image.';
const _IMGPOSRORL = "'R' or 'r' for right, 'L' or 'l' for left, or leave it blank.";
const _ERRORIMGPOS = 'ERROR! Enter the position of the image.';
const _ENTEREMAIL = 'Enter the email address you want to add.';
const _ENTERCODE = 'Enter the codes that you want to add.';
const _ENTERQUOTE = 'Enter the text that you want to be quoted.';
const _ENTERTEXTBOX = 'Please input text into the textbox.';
const _ALLOWEDCHAR = 'Allowed max chars length: ';
const _CURRCHAR = 'Current chars length: ';
const _PLZCOMPLETE = 'Please complete the subject and message fields.';
const _MESSAGETOOLONG = 'Your message is too long.';

//%%%%%		TIME FORMAT SETTINGS   %%%%%
const _SECOND = '1 second';
const _SECONDS = '%s seconds';
const _MINUTE = '1 minute';
const _MINUTES = '%s minutes';
const _HOUR = '1 hour';
const _HOURS = '%s hours';
const _DAY = '1 day';
const _DAYS = '%s days';
const _WEEK = '1 week';
const _MONTH = '1 month';

const _HELP = 'Help';

//%%%%%		   %%%%%
const _CATEGORY = 'Category';
const _TAG = 'Tag';
const _STATUS = 'Status';
const _STATUS_DELETED = 'Deleted';
const _STATUS_REJECTED = 'Rejected';
const _STATUS_POSTED = 'Posted';
const _STATUS_PUBLISHED = 'Published';

//%%%%% Group %%%%%
const _GROUP = 'Group';
const _MEMBER = 'Member';
const _GROUP_RANK_GUEST = 'Guest';
const _GROUP_RANK_ASSOCIATE = 'Associate';
const _GROUP_RANK_REGULAR = 'Regular';
const _GROUP_RANK_STAFF = 'Staff';
const _GROUP_RANK_OWNER = 'Owner';

//%%%%% System %%%%%
const _DEBUG_MODE = 'Debug';
const _DEBUG_MODE_PHP = 'PHP';
const _DEBUG_MODE_SQL = 'SQL';
const _DEBUG_MODE_SMARTY = 'Smarty';
const _DEBUG_MODE_DESC = 'Disable debug mode in production. Admin > Settings > Debug mode [Off].';

const _SYS_OS = 'OS';
const _SYS_SERVER = 'Server';
const _SYS_USERAGENT = 'User agent';
const _SYS_PHPVERSION = 'PHP version';
const _SYS_MYSQLVERSION = 'MySQL version';
