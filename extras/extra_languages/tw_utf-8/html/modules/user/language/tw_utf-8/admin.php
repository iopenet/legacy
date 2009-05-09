<?php
// $Id: admin.php,v 1.1 2008/03/09 02:26:09 minahito Exp $
define('_AD_USER_ERROR_CONTENT_IS_NOT_FOUND', "查無資料");
define('_AD_USER_ERROR_EMAIL', "{0} 為不合格式的 email");
define('_AD_USER_ERROR_GROUP_VALUE', "群組值錯誤。");
define('_AD_USER_ERROR_IMAGE_REQUIRED', "您必須選擇一個圖形檔案");
define('_AD_USER_ERROR_INJURY_MIN_MAX', "最大值和最小值的關聯錯誤");
define('_AD_USER_ERROR_INTRANGE', " {0:toLower} 輸入錯誤。");
define('_AD_USER_ERROR_MAILJOB_SEND_FAIL', "傳送Email或私人訊息失敗。");
define('_AD_USER_ERROR_MAILJOB_SEND_MEANS', "您至少必須選擇一種郵件傳遞方式");
define('_AD_USER_ERROR_MIN', "輸入 {0:toLower} 為 {1} 或更大值.");
define('_AD_USER_ERROR_OBJECTEXIST', " {0:toLower} 輸入錯誤");
define('_AD_USER_ERROR_REQUEST_IS_WRONG', "需求無效");
define('_AD_USER_ERROR_UMODE', "回應評論排序的指定值不存在");
define('_AD_USER_ERROR_UNAME_NO_UNIQUE', "帳號已被使用");
define('_AD_USER_LANG_ALL_OF_USERS', "所有使用者");
define('_AD_USER_LANG_APPROVE_USERS_ONLY', "僅線帳號已啟用者");
define('_AD_USER_LANG_AVATAR_CREATED', "已建立");
define('_AD_USER_LANG_AVATAR_DELETE', "刪除頭像");
define('_AD_USER_LANG_AVATAR_DISPLAY', "顯示");
define('_AD_USER_LANG_AVATAR_FILE', "圖檔");
define('_AD_USER_LANG_AVATAR_MIMETYPE', "檔案格式");
define('_AD_USER_LANG_AVATAR_NAME', "名稱");
define('_AD_USER_LANG_AVATAR_NEW', "增加頭像");
define('_AD_USER_LANG_AVATAR_TYPE', "型態");
define('_AD_USER_LANG_AVATAR_TYPE_C', "客製");
define('_AD_USER_LANG_AVATAR_TYPE_S', "內建");
define('_AD_USER_LANG_AVATAR_USING_COUNT', "使用");
define('_AD_USER_LANG_AVATAR_WEIGHT', "排序");
define('_AD_USER_LANG_BODY', "主體");
define('_AD_USER_LANG_COMPLETED', "完成");
define('_AD_USER_LANG_CONTROL', "控制");
define('_AD_USER_LANG_CREATE_NEW', "新建");
define('_AD_USER_LANG_CREATE_UNIXTIME', "建立日期");
define('_AD_USER_LANG_DELETE_RANK', "刪除等級");
define('_AD_USER_LANG_DISPLAY_USER_LEVEL', "顯示使用者等級");
define('_AD_USER_LANG_DISPLAY_USER_MAIL_CONDITION', "顯示使用者郵件設定");
define('_AD_USER_LANG_FROM_EMAIL', "郵件來自");
define('_AD_USER_LANG_FROM_NAME', "寄件者");
define('_AD_USER_LANG_GROUP', "群組");
define('_AD_USER_LANG_GROUP_AMMO', "數量");
define('_AD_USER_LANG_GROUP_ASSIGN', "加入成員");
define('_AD_USER_LANG_GROUP_ASSIN_MEMBERS', "顯示這個群組的成員");
define('_AD_USER_LANG_GROUP_DELETE', "刪除群組");
define('_AD_USER_LANG_GROUP_DELETE_ADVICE', "您真的要刪除這個群組嗎?");
define('_AD_USER_LANG_GROUP_DELETE_ADVICE2', "當您刪除這個群組，屬於這個群組的成員將被刪除.");
define('_AD_USER_LANG_GROUP_DESC', "描述");
define('_AD_USER_LANG_GROUP_EDIT', "編輯群組");
define('_AD_USER_LANG_GROUP_GID', "群組ID");
define('_AD_USER_LANG_GROUP_LIST', "群組管理");
define('_AD_USER_LANG_GROUP_NAME', "群組名稱");
define('_AD_USER_LANG_GROUP_NEW', "增加新群組");
define('_AD_USER_LANG_GROUP_NOASSIN_MEMBERS', "不在此群組的成員");
define('_AD_USER_LANG_GROUP_PERMISSION', "權限設定");
define('_AD_USER_LANG_GROUP_PROPERTY', "群組詳情");
define('_AD_USER_LANG_GROUP_TYPE', "群組型態");
define('_AD_USER_LANG_IS_MAIL', "Mail");
define('_AD_USER_LANG_IS_PM', "私人訊息");
define('_AD_USER_LANG_LASTLOG_LESS', "最後登入時間距今少於 X 天");
define('_AD_USER_LANG_LASTLOG_MORE', "最後登入距今多於 X 天");
define('_AD_USER_LANG_LASTLOGIN', "最後登入時間");
define('_AD_USER_LANG_LEFT_TARGET_USER', "傳送狀態");
define('_AD_USER_LANG_LEVEL_ACTIVE', "已啟用帳號的會員");
define('_AD_USER_LANG_LEVEL_PENDING', "尚未啟用帳號的會員");
define('_AD_USER_LANG_LEVEL_ROOT', "系統使用者");
define('_AD_USER_LANG_MAIL_NG_USERS_ONLY', "不接受 mail 的使用者");
define('_AD_USER_LANG_MAIL_OK_USERS_ONLY', "接受Mail的使用者");
define('_AD_USER_LANG_MAILJOB_DELETE', "刪除郵遞工作");
define('_AD_USER_LANG_MAILJOB_EDIT', "編輯郵遞工作");
define('_AD_USER_LANG_MAILJOB_ID', "工作 ID");
define('_AD_USER_LANG_MAILJOB_LINK_LIST', "郵遞工作列表");
define('_AD_USER_LANG_MAILJOB_LIST', "郵遞工作列表");
define('_AD_USER_LANG_MAILJOB_NEW', "新郵遞工作");
define('_AD_USER_LANG_MAILJOB_SEND', "送出郵遞工作");
define('_AD_USER_LANG_MAILJOB_VIEW', "觀看郵遞工作");
define('_AD_USER_LANG_MESSAGE', "訊息");
define('_AD_USER_LANG_NO_SPECIAL_RANK', "--------------");
define('_AD_USER_LANG_OVER_POSTS', "發表數超過 X");
define('_AD_USER_LANG_PENDING_USERS_ONLY', "僅限尚未啟用帳號的使用者");
define('_AD_USER_LANG_PERM_ACCESS', "存取");
define('_AD_USER_LANG_PERM_ACCESS_ADMIN', "存取管理");
define('_AD_USER_LANG_PERM_ADMIN', "管理");
define('_AD_USER_LANG_PERM_BLOCK_ACCESS', "區塊權限");
define('_AD_USER_LANG_PERM_GROUP_PERM_BLOCK', "區塊");
define('_AD_USER_LANG_PERM_GROUP_PERM_MODULE', "系統 / 模組");
define('_AD_USER_LANG_PERM_MODULE_ACCESS', "系統/模組權限");
define('_AD_USER_LANG_PERM_SYSTEM_PERM_MODULE', "系統管理");
define('_AD_USER_LANG_RANK', "等級");
define('_AD_USER_LANG_RANK_EDIT', "編輯等級");
define('_AD_USER_LANG_RANK_IMAGE', "圖示");
define('_AD_USER_LANG_RANK_LIST', "使用者等級管理");
define('_AD_USER_LANG_RANK_MAX', "最大發表數");
define('_AD_USER_LANG_RANK_MIN', "最少發表數");
define('_AD_USER_LANG_RANK_NEW', "增加新等級");
define('_AD_USER_LANG_RANK_SPECIAL', "特殊等級");
define('_AD_USER_LANG_RANK_TITLE', "標題");
define('_AD_USER_LANG_RECOUNT', "重計");
define('_AD_USER_LANG_REGDATE', "註冊日");
define('_AD_USER_LANG_REGDATE_LESS', "註冊少於 X 天");
define('_AD_USER_LANG_REGDATE_MORE', "註冊超過 X 天");
define('_AD_USER_LANG_RESET', "重置");
define('_AD_USER_LANG_RETRY', "重試");
define('_AD_USER_LANG_SEARCH_AGAIN', "再次搜尋");
define('_AD_USER_LANG_SEND_MAIL_BY_THIS_CONDITION', "傳送郵件給使用者");
define('_AD_USER_LANG_TARGET_RETRY_NUMBER', "標記重試的數目");
define('_AD_USER_LANG_TITLE', "標題");
define('_AD_USER_LANG_UID', "使用者ID");
define('_AD_USER_LANG_UNDER_POSTS', "發表數少於 X");
define('_AD_USER_LANG_USER', "使用者");
define('_AD_USER_LANG_USER_DELETE', "刪除使用者");
define('_AD_USER_LANG_USER_DELETE_ADVICE', "您確定要刪除這個使用者嗎?");
define('_AD_USER_LANG_USER_EDIT', "編輯使用者");
define('_AD_USER_LANG_USER_LIST', "使用者管理");
define('_AD_USER_LANG_USER_NEW', "新增使用者");
define('_AD_USER_LANG_USER_NEW_FIELD', "Add a New Field");
define('_AD_USER_LANG_USER_SEARCH_LIST', "使用者搜尋列表");
define('_AD_USER_LANG_USER_VIEW', "瀏覽使用者");
define('_AD_USER_LANG_VPASS', "確認密碼");
define('_AD_USER_MESSAGE_CONFIRM_DELETE', "您確定要刪除嗎?");
define('_AD_USER_MESSAGE_CONFIRM_DELETE_RANK', "您確定要刪除這個等級嗎?");
define('_AD_USER_MESSAGE_RECOUNT_SUCCESS', "重新計算完成");
define('_AD_USER_TIP_DELETE_AVATAR', "使用者刪除個人頭向後將會以blank.gif 取代。");
define('_AD_USER_TIPS_MAILJOB_SEND', "如果您發送郵件的對象非常多的話，伺服器也許會產生沒有回應的狀態(如空白頁等等...，請重新整理瀏覽器幾次來完成傳送");
define('_AD_USER_TIPS_RECOUNT_POSTS', "您可以按下重新計算按鈕來重計使用者的發表數");
define('_AD_USER_TIPS_USER_EDIT', "如果您要變更密碼，請將新密碼填入密碼欄與確認密碼欄 。");
define('_AD_USER_TIPS_USER_NEW', "您必須輸入'帳號'、'Email'、'密碼'及'確認密碼。");

?>
