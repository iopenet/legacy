<?php
// Syntax replace define with const v2.3.0 2021/05/15 @gigamaster XCL-PHP7

const _MD_MESSAGE_NEWMESSAGE = 'You have {0} messages.';

const _MD_MESSAGE_FORMERROR1 = 'Name is required.';
const _MD_MESSAGE_FORMERROR2 = 'Add a name with a maximum of 30 characters.';
const _MD_MESSAGE_FORMERROR3 = 'Subject is required.';
const _MD_MESSAGE_FORMERROR4 = 'Add a subject with a maximum of 100 characters.';
const _MD_MESSAGE_FORMERROR5 = 'Message is required.';
const _MD_MESSAGE_FORMERROR6 = 'The selected user doesn\'t exist.';

const _MD_MESSAGE_ACTIONMSG1 = 'The message doesn\'t exist.';
const _MD_MESSAGE_ACTIONMSG2 = 'You don\'t have the required permissions.';
const _MD_MESSAGE_ACTIONMSG3 = 'The Message was deleted.';
const _MD_MESSAGE_ACTIONMSG4 = 'Delete fail!';
const _MD_MESSAGE_ACTIONMSG5 = 'Message could not be sent.';
const _MD_MESSAGE_ACTIONMSG6 = 'Fail adding to the Sent Box.';
const _MD_MESSAGE_ACTIONMSG7 = 'Message was sent.';
const _MD_MESSAGE_ACTIONMSG8 = 'You don\'t have the required permissions.';
const _MD_MESSAGE_ACTIONMSG9 = 'The user you reply to doesn\'t exist.';

const _MD_MESSAGE_TEMPLATE1 = 'Send message';
const _MD_MESSAGE_TEMPLATE2 = 'User name';
const _MD_MESSAGE_TEMPLATE3 = 'Subject';
const _MD_MESSAGE_TEMPLATE4 = 'Message';
const _MD_MESSAGE_TEMPLATE5 = 'Preview';
const _MD_MESSAGE_TEMPLATE6 = 'Submit';
const _MD_MESSAGE_TEMPLATE7 = 'Sent Box';
const _MD_MESSAGE_TEMPLATE8 = 'New message';
const _MD_MESSAGE_TEMPLATE9 = 'To';
const _MD_MESSAGE_TEMPLATE10 = 'Date';
const _MD_MESSAGE_TEMPLATE11 = 'Message Read';
const _MD_MESSAGE_TEMPLATE12 = 'From';
const _MD_MESSAGE_TEMPLATE13 = 'Reply';
const _MD_MESSAGE_TEMPLATE14 = 'Delete';
const _MD_MESSAGE_TEMPLATE15 = 'Inbox';
const _MD_MESSAGE_TEMPLATE16 = 'Unread';
const _MD_MESSAGE_TEMPLATE17 = 'Read';
const _MD_MESSAGE_TEMPLATE18 = 'Order';
const _MD_MESSAGE_TEMPLATE19 = 'Lock';
const _MD_MESSAGE_TEMPLATE20 = 'Unlock';
const _MD_MESSAGE_TEMPLATE21 = 'Forward to email';
const _MD_MESSAGE_TEMPLATE22 = 'Status';

const _MD_MESSAGE_ADDFAVORITES = 'Add to favorites';

const _MD_MESSAGE_FAVORITES0 = 'Select an user to add.';
const _MD_MESSAGE_FAVORITES1 = 'Fail adding!';
const _MD_MESSAGE_FAVORITES2 = 'Add';
const _MD_MESSAGE_FAVORITES3 = 'Fail Updating!';
const _MD_MESSAGE_FAVORITES4 = 'Update';
const _MD_MESSAGE_FAVORITES5 = 'Delete';

const _MD_MESSAGE_SETTINGS = 'Private Message Settings';
const _MD_MESSAGE_SETTINGS_MSG1 = 'Use private message';
const _MD_MESSAGE_SETTINGS_MSG2 = 'Forward to Email';
const _MD_MESSAGE_SETTINGS_MSG3 = 'change settings';
const _MD_MESSAGE_SETTINGS_MSG4 = 'Fail updating !';
const _MD_MESSAGE_SETTINGS_MSG5 = 'You cannot use private message. Please modify settings.';
const _MD_MESSAGE_SETTINGS_MSG6 = 'The selected user cannot receive the message.';
const _MD_MESSAGE_SETTINGS_MSG7 = 'Display message in the mail.';
const _MD_MESSAGE_SETTINGS_MSG8 = 'Number of messages per page';
const _MD_MESSAGE_SETTINGS_MSG9 = 'Default settings (15) if value is 0.';
const _MD_MESSAGE_SETTINGS_MSG10 = 'Blacklist';
const _MD_MESSAGE_SETTINGS_MSG11 = 'Separate User IDs with a comma.';
const _MD_MESSAGE_SETTINGS_MSG12 = '{0} was added to the blacklist.';
const _MD_MESSAGE_SETTINGS_MSG13 = 'Fail adding {0}\'s to blacklist.';
const _MD_MESSAGE_SETTINGS_MSG14 = '{0} already exists.';
const _MD_MESSAGE_SETTINGS_MSG15 = 'Blacklist management';
const _MD_MESSAGE_SETTINGS_MSG16 = 'The user was removed.';
const _MD_MESSAGE_SETTINGS_MSG17 = 'Fail removing user.';
const _MD_MESSAGE_SETTINGS_MSG18 = 'Details';
const _MD_MESSAGE_SETTINGS_MSG19 = 'The user does not exist.';

const _MD_MESSAGE_MAILSUBJECT = 'You have a New Private Message';
const _MD_MESSAGE_MAILBODY = '{0} login, please.';

const _MD_MESSAGE_ADDBLACKLIST = 'Blacklist User';

const _MD_MESSAGE_DELETEMSG1 = 'The parameter is incorrect.';
const _MD_MESSAGE_DELETEMSG2 = 'No Items Selected.';

const _MD_MESSAGE_SEARCH = 'Search';

if (!defined('LEGACY_MAIL_LANG')) {
    define('LEGACY_MAIL_LANG','en');
    define('LEGACY_MAIL_CHAR','UTF-8');
    define('LEGACY_MAIL_ENCO','7bit');
}
