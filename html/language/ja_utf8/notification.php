<?php
// $Id: notification.php, Syntax replace define with const v2.3.0 2021/05/15 @gigamaster XCL-PHP7

// RMV-NOTIFY
// Text for various templates...

const _NOT_NOTIFICATIONOPTIONS = 'イベントの選択';
const _NOT_UPDATENOW = '今すぐ更新';
const _NOT_UPDATEOPTIONS = 'イベントの更新';

const _NOT_CANCEL = '中止';
const _NOT_CLEAR = 'クリア';
const _NOT_DELETE = '削除';
const _NOT_CHECKALL = '全てチェック';
const _NOT_MODULE = 'モジュール';
const _NOT_CATEGORY = 'カテゴリ';
const _NOT_ITEMID = 'ID';
const _NOT_ITEMNAME = '名称';
const _NOT_EVENT = 'イベント';
const _NOT_EVENTS = 'イベント';
const _NOT_ACTIVENOTIFICATIONS = '選択可能なイベント';
const _NOT_NAMENOTAVAILABLE = '無題';
const _NOT_ITEMNAMENOTAVAILABLE = '項目名が無効です';
const _NOT_ITEMTYPENOTAVAILABLE = '項目タイプが無効です';
const _NOT_ITEMURLNOTAVAILABLE = '項目URLが無効です';
const _NOT_DELETINGNOTIFICATIONS = '選択イベントの削除';
const _NOT_DELETESUCCESS = '選択されたイベントを削除しました';
const _NOT_UPDATEOK = 'イベントを更新しました';
const _NOT_NOTIFICATIONMETHODIS = '通知方法：';
const _NOT_EMAIL = 'メール';
const _NOT_PM = 'プライベート・メッセージ';
const _NOT_DISABLE = '無効にする';
const _NOT_CHANGE = '変更';
const _NOT_RUSUREDEL = '選択したイベントを削除してもいいですか？';
const _NOT_NOACCESS = 'このページにアクセスする権限がありません。';

// Text for module config options

const _NOT_ENABLE = '有効にする';
const _NOT_NOTIFICATION = 'イベント通知機能';

const _NOT_CONFIG_ENABLED = 'イベント通知機能の設定';
const _NOT_CONFIG_ENABLEDDSC = 'このモジュールでは、ある特定のイベントが発生した際に、当該イベント購読者に対し通知メッセージが送られるように設定できます。この機能を有効にするには「はい」を選択してください。';

const _NOT_CONFIG_EVENTS = '特定イベントを有効にする';
const _NOT_CONFIG_EVENTSDSC = 'ユーザが選択可能なイベントを設定してください。';

const _NOT_CONFIG_ENABLE = 'イベント通知機能の設定';
const _NOT_CONFIG_ENABLEDSC = 'このモジュールでは、ある特定のイベントが発生した際に、当該イベント購読者に対し通知メッセージが送られるように設定できます。この機能を有効にするための形式を選択してください。';
const _NOT_CONFIG_DISABLE = 'この機能を無効にする';
const _NOT_CONFIG_ENABLEBLOCK = 'イベント選択オプションをブロックに表示する';
const _NOT_CONFIG_ENABLEINLINE = 'イベント選択オプションをメインコンテンツ下部に表示する';
const _NOT_CONFIG_ENABLEBOTH = 'イベント選択オプションをブロックおよびメインコンテンツ下部の両方に表示する';

// For notification about comment events

const _NOT_COMMENT_NOTIFY = 'コメントが追加されました';
const _NOT_COMMENT_NOTIFYCAP = 'このページにコメントが追加された際に通知する';
const _NOT_COMMENT_NOTIFYDSC = '';
const _NOT_COMMENT_NOTIFYSBJ = '[{X_MODULE}] 「{X_ITEM_TYPE}」に対してコメントが追加されました （自動通知）';

const _NOT_COMMENTSUBMIT_NOTIFY = '新規コメントの投稿がありました';
const _NOT_COMMENTSUBMIT_NOTIFYCAP = 'このページに承認が必要なコメントが投稿された際に通知する';
const _NOT_COMMENTSUBMIT_NOTIFYDSC = '';
const _NOT_COMMENTSUBMIT_NOTIFYSBJ = '[{X_MODULE}] 「{X_ITEM_TYPE}」に対して新規コメントの投稿がありました （自動通知）';

// For notification bookmark feature
// (Not really notification, but easy to do with this module)

const _NOT_BOOKMARK_NOTIFY = 'ブックマーク';
const _NOT_BOOKMARK_NOTIFYCAP = 'このページをブックマークする';
const _NOT_BOOKMARK_NOTIFYDSC = 'このページをブックマークします。通知メッセージは送られません。';

// For user profile
// FIXME: These should be reworded a little...

const _NOT_NOTIFYMETHOD = 'イベント更新通知メッセージの受取方法';
const _NOT_METHOD_EMAIL = 'メール';
const _NOT_METHOD_PM = 'プライベート・メッセージ';
const _NOT_METHOD_DISABLE = '一時的に中止';

const _NOT_NOTIFYMODE = 'イベント通知のタイミング';
const _NOT_MODE_SENDALWAYS = 'イベント更新時に必ず通知する';
const _NOT_MODE_SENDONCE = '一度だけ通知する';
const _NOT_MODE_SENDONCEPERLOGIN = '一度通知した後、再度ログインするまで通知しない';

const _NOT_NOTHINGTODELETE = '削除するイベントがありません';
