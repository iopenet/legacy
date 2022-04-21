<?php
// Syntax replace define with const v2.3.0 2021/05/15 @gigamaster XCL-PHP7

const _AD_PROFILE_LANG_USERS = 'User management';
const _AD_PROFILE_LANG_DEFINITIONS_EDIT = 'プロフィール定義の編集';
const _AD_PROFILE_LANG_DEFINITIONS_DELETE = 'プロフィール定義の削除';
const _AD_PROFILE_LANG_DEFINITIONS_VIEW = 'プロフィール定義の表示';
const _AD_PROFILE_TIPS_DATA_DOWNLOAD = 'ユーザID順に並んだデータをCSV形式でダウンロードすることができます。';
const _AD_PROFILE_DATA_NUM = '%d 人のプロフィールが登録されています。';
const _AD_PROFILE_DATA_DOWNLOAD_DO = 'CSVファイルをダウンロード';

const _AD_PROFILE_DESC_FIELD_SELECTBOX = '選択肢を | で区切って入力してください';
const _AD_PROFILE_DESC_FIELD_CHECKBOX = '「チェックありの場合の表示」「チェック無しの場合の表示」を | で区切って入力してください。空の場合は、「' . _YES . '」と 「' . _NO . '」が表示されます';
const _AD_PROFILE_DESC_FIELD_STRING = '初期値を入れてください。';
const _AD_PROFILE_DESC_FIELD_INT = '初期値を入れてください。';
const _AD_PROFILE_DESC_FIELD_FLOAT = 'Set the default value.';
const _AD_PROFILE_DESC_FIELD_TEXT = '"html" を選ぶと、Wysiwygエディタになります（Wysiwygエディタをインストールしてある場合）."bbcode" を選ぶと、BBCode エディタになります。';
const _AD_PROFILE_DESC_FIELD_CATEGORY = 'カテゴリモジュールのディレクトリ名';

const _AD_PROFILE_TIPS1_DATA_UPLOAD = 'CSVファイルでプロフィールの一括登録が可能です。';
const _AD_PROFILE_TIPS2_DATA_UPLOAD = '<a href="?action=UserDataDownload" style="color:#941d55;font-weight:bold;">' . _MI_PROFILE_DATA_DOWNLOAD . '</a> から、ダウンロードした CSV ファイルを使用してください。カラムの増減はしないでください。';
const _AD_PROFILE_TIPS3_DATA_UPLOAD = 'CSVファイル内へ新たに情報の登録や更新をしようとしたユーザーのみを記述してください。';
const _AD_PROFILE_TIPS4_DATA_UPLOAD = '左端の行のUIDが空（または0）の時は、登録されません。';
const _AD_PROFILE_TIPS5_DATA_UPLOAD = 'ユーザー情報は左端の行（UID）の値があるときに更新されます。';
const _AD_PROFILE_DATA_UPLOAD_DONE = 'CSVデータにより、ユーザーデータが更新されました。';
const _AD_PROFILE_DATA_UPLOAD_SELECT_CSVFILE = '登録されたCSVファイルを選択して下さい。';
const _AD_PROFILE_DATA_UPLOAD_CONF = '登録内容の確認';
const _AD_PROFILE_DATA_UPLOAD_DO = '登録';

const _AD_PROFILE_DATA_UPLOAD_BACK = 'CSVファイルを再度選択';
const _AD_PROFILE_DATA_UPLOAD_CHECK_PROFILE_CSVFILE = '登録の内容をご確認ください。';
