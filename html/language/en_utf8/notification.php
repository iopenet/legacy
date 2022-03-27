<?php
// $Id: notification.php, Syntax replace define with const v2.3.0 2021/05/15 @gigamaster XCL-PHP7

// RMV-NOTIFY
// Text for various templates...

const _NOT_NOTIFICATIONOPTIONS = 'Notification Options';
const _NOT_UPDATENOW = 'Update Now';
const _NOT_UPDATEOPTIONS = 'Update Notification Options';

const _NOT_CANCEL = 'Cancel';
const _NOT_CLEAR = 'Clear';
const _NOT_DELETE = 'Delete';
const _NOT_CHECKALL = 'Check All';
const _NOT_MODULE = 'Module';
const _NOT_CATEGORY = 'Category';
const _NOT_ITEMID = 'ID';
const _NOT_ITEMNAME = 'Name';
const _NOT_EVENT = 'Event';
const _NOT_EVENTS = 'Events';
const _NOT_ACTIVENOTIFICATIONS = 'Active Notifications';
const _NOT_NAMENOTAVAILABLE = 'Name Not Available';
// RMV-NEW : TODO: remove NAMENOTAVAILBLE above
const _NOT_ITEMNAMENOTAVAILABLE = 'Item Name Not Available';
const _NOT_ITEMTYPENOTAVAILABLE = 'Item Type Not Available';
const _NOT_ITEMURLNOTAVAILABLE = 'Item URL Not Available';
const _NOT_DELETINGNOTIFICATIONS = 'Deleting Notifications';
const _NOT_DELETESUCCESS = 'Notification(s) deleted successfully.';
const _NOT_UPDATEOK = 'Notification options updated';
const _NOT_NOTIFICATIONMETHODIS = 'Notification method is';
const _NOT_EMAIL = 'email';
const _NOT_PM = 'private message';
const _NOT_DISABLE = 'disabled';
const _NOT_CHANGE = 'Change';
const _NOT_RUSUREDEL = 'Are you sure you want to delete these Notifications';
const _NOT_NOACCESS = 'You do not have permission to access this page.';

// Text for module config options

const _NOT_ENABLE = 'Enable';
const _NOT_NOTIFICATION = 'Notification';

const _NOT_CONFIG_ENABLED = 'Enable Notification';
const _NOT_CONFIG_ENABLEDDSC = 'This module allows users to select to be notified when certain events occur.  Choose "yes" to enable this feature.';

const _NOT_CONFIG_EVENTS = 'Enable Specific Events';
const _NOT_CONFIG_EVENTSDSC = 'Select which notification events to which your users may subscribe.';

const _NOT_CONFIG_ENABLE = 'Enable Notification';
const _NOT_CONFIG_ENABLEDSC = 'This module allows users to be notified when certain events occur.  Select if users should be presented with notification options in a Block (Block-style), within the module (Inline-style), or both.  For block-style notification, the Notification Options block must be enabled for this module.';
const _NOT_CONFIG_DISABLE = 'Disable Notification';
const _NOT_CONFIG_ENABLEBLOCK = 'Enable only Block-style';
const _NOT_CONFIG_ENABLEINLINE = 'Enable only Inline-style';
const _NOT_CONFIG_ENABLEBOTH = 'Enable Notification (both styles)';

// For notification about comment events

const _NOT_COMMENT_NOTIFY = 'Comment Added';
const _NOT_COMMENT_NOTIFYCAP = 'Notify me when a new comment is posted for this item.';
const _NOT_COMMENT_NOTIFYDSC = 'Receive notification whenever a new comment is posted (or approved) for this item.';
const _NOT_COMMENT_NOTIFYSBJ = '[{X_SITENAME}] {X_MODULE} auto-notify: Comment added to {X_ITEM_TYPE}';

const _NOT_COMMENTSUBMIT_NOTIFY = 'Comment Submitted';
const _NOT_COMMENTSUBMIT_NOTIFYCAP = 'Notify me when a new comment is submitted (awaiting approval) for this item.';
const _NOT_COMMENTSUBMIT_NOTIFYDSC = 'Receive notification whenever a new comment is submitted (awaiting approval) for this item.';
const _NOT_COMMENTSUBMIT_NOTIFYSBJ = '[{X_SITENAME}] {X_MODULE} auto-notify: Comment submitted for {X_ITEM_TYPE}';

// For notification bookmark feature
// (Not really notification, but easy to do with this module)

const _NOT_BOOKMARK_NOTIFY = 'Bookmark';
const _NOT_BOOKMARK_NOTIFYCAP = 'Bookmark this item (no notification).';
const _NOT_BOOKMARK_NOTIFYDSC = 'Keep track of this item without receiving any event notifications.';

// For user profile
// FIXME: These should be reworded a little...

const _NOT_NOTIFYMETHOD = 'Notification Method: When you monitor e.g. a forum, how would you like to receive notifications of updates?';
const _NOT_METHOD_EMAIL = 'Email (use address in my profile)';
const _NOT_METHOD_PM = 'Private Message';
const _NOT_METHOD_DISABLE = 'Temporarily Disable';

const _NOT_NOTIFYMODE = 'Default Notification Mode';
const _NOT_MODE_SENDALWAYS = 'Notify me of all selected updates';
const _NOT_MODE_SENDONCE = 'Notify me only once';
const _NOT_MODE_SENDONCEPERLOGIN = 'Notify me once then disable until I log in again';
