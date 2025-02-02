<?php
// Syntax replace define with const v2.3.0 2021/05/15 @gigamaster XCL-PHP7

// mymenu
const _MD_A_MYMENU_MYTPLSADMIN = '';
const _MD_A_MYMENU_MYBLOCKSADMIN = 'アクセス権限';
const _MD_A_MYMENU_MYPREFERENCES = '一般設定';

// index.php
const _AM_TH_DATETIME = '日時';
const _AM_TH_USER = 'ユーザ';
const _AM_TH_IP = 'IP';
const _AM_TH_IP_BAN = 'System IP Ban';
const _AM_TH_AGENT = 'AGENT';
const _AM_TH_TYPE = '種別';
const _AM_TH_DESC = '詳細';
const _AM_TH_INFO = '概要';
const _AM_TH_TIPS = 'チップ';

const _AM_TH_BADIPS = '拒否IPリスト<br><br><span style="font-weight:normal;">１行１IPアドレスで記述してください（前方一致）。空欄なら全許可。<br>IPv6 アドレスの省略表記 "::" 及び "0" の省略は使用できません。</span>';
const _AM_TH_GROUP1IPS = '管理者グループ(1)の許可IP<br><br><span style="font-weight:normal;">１行１IPアドレスで記述してください（前方一致）。<br>IPv6 アドレスの省略表記 "::" 及び "0" の省略は使用できません。<br>192.168. とすれば、192.168.*からのみ管理者になれます。空欄なら全許可。</span>';

const _AM_LABEL_COMPACTLOG = 'ログをコンパクト化する';
const _AM_BUTTON_COMPACTLOG = 'コンパクト化実行';
const _AM_JS_COMPACTLOGCONFIRM = 'IPと種別の重複したレコードを削除します';
const _AM_LABEL_REMOVEALL = '全レコードを削除する:';
const _AM_BUTTON_REMOVEALL = '全削除実行';
const _AM_JS_REMOVEALLCONFIRM = 'ログを無条件で削除します。本当によろしいですか？';
const _AM_LABEL_REMOVE = 'チェックしたレコードを削除する:';
const _AM_BUTTON_REMOVE = '削除実行';
const _AM_JS_REMOVECONFIRM = '本当に削除してよろしいですか？';
const _AM_MSG_IPFILESUPDATED = 'IPリストファイルを書き換えました';
const _AM_MSG_BADIPSCANTOPEN = '拒否IPリストファイルが開けません';
const _AM_MSG_GROUP1IPSCANTOPEN = '管理者用IPリストファイルが開けません';
const _AM_MSG_REMOVED = '削除しました';
const _AM_FMT_CONFIGSNOTWRITABLE = 'configsディレクトリが書込許可されていません: %s';

// prefix_manager.php
const _AM_H3_PREFIXMAN = 'PREFIX マネージャ';
const _AM_MSG_DBUPDATED = 'データベースが更新されました';
const _AM_CONFIRM_DELETE = '全テーブルが削除されますがよろしいですか?';
const _AM_TXT_HOWTOCHANGEDB = "prefixを変更する場合は、%s/mainfile.php 内の以下の部分を書き換えてください<br><br>define('XOOPS_DB_PREFIX', '<b>%s</b>');";


// advisory.php
const _AM_ADV_NOTSECURE = '非推奨';
const _AM_ADV_TITLE = 'プロテクターセキュリティアドバイザー';
const _AM_ADV_TITLE_TIP = 'プロテクターセキュリティアドバイザー、一連のセキュリティチェックを実行し、潜在的なセキュリティリスクを検出できます。<br>
    さらに、検出されたセキュリティリスクの推奨事項と修正方法を入手できます。';
const _AM_ADV_NGINX ='NginXはApacheのようなphpプロセスを管理しないため、php-fpmまたはphp-cgiのいずれかを構成する必要がある場合があることに注意してください。';
const _AM_ADV_NGINX_VAR ='Sサーバーソフトウェアvar_dump';
const _AM_ADV_SERVER = 'サーバーソフトウェア';
const _AM_ADV_ENV = 'このテーブルのエントリは、Webサーバーによって作成されます。 すべてのWebサーバーがこれらのいずれかを提供するという保証はありません。
     サーバーは一部を省略したり、ここに記載されていない他のサーバーを提供したりする場合があります。これらの変数は»CGI/1.1仕様で考慮されているため、これらを期待できるはずです。';
const _AM_ADV_ENV_LABEL ='サーバーと実行環境の情報';
const _AM_ADV_APACHE = 'Apache関数は、PHPをApacheモジュールとして実行している場合にのみ使用できます。<br>
    さらに、一部のWebサーバー構成では、次の値が返されない場合があります。';

// Mainfile
const _AM_ADV_MAINUNPATCHED = '事前チェックと事後チェックの両方が必要です。 mainfile.phpを編集するには、モジュールのドキュメントを参照してください';
const _AM_ADV_MAIN_PRECHECK = '必要な事前チェックがありません。!';
const _AM_ADV_MAIN_POSTCHECK = '必要なポストチェックがありません!';

// TRUST PATH
const _AM_ADV_TRUSTPATH_PUBLIC_LINK = 'Click here !';
const _AM_ADV_TRUSTPATH_PUBLIC = '上にNGという画像が表示されていたり、リンク先でエラーが出ないようならXOOPS_TRUST_PATHの設置方法に問題があります。TRUST_PATH内のPHPファイルに直アクセスできないことの確認（リンク先が404,403,500エラーなら正常）';
const _AM_ADV_TRUSTPATH_DESC = 'XOOPS_TRUST_PATHはDocumentRoot外に設置するのが基本ですが。';
const _AM_ADV_TRUSTPATH_TIPS = 'そうできない場合でもXOOPS_TRUST_PATH直下にDENY FROM ALLの一行を持つ.htaccessを追加するなどして、XOOPS_TRUST_PATH内に直接アクセスできないようにする必要があります。';

// allow_url_fopen
const _AM_ADV_FOPEN = 'Allow url fopen';
const _AM_ADV_FOPEN_ON = 'この設定だと、外部の任意のスクリプトを実行される危険性があります';
const _AM_ADV_FOPEN_DESC = '<p>この設定変更にはサーバの管理者権限が必要です<br>ご自身で管理しているサーバであれば、php.iniやhttpd.confを編集して下さい<br>そうでない場合は、サーバ管理者にお願いしてみて下さい.</p>';
const _AM_ADV_FOPEN_TIPS= '<p><b>.htaccess</b>または<b>php.ini</b><br>から<b>allow_url_fopen</b>を無効にできます
     mod_rewriteモジュールがApacheで有効になっている場合は、次の行をパブリックルートフォルダーの.htaccessファイルに挿入できます。<br>
     <b>php_flag allow_url_fopen off</b><br>
     または、「php.ini」でこのphp機能を無効にします。<br>
     <b>allow_url_fopen = "off"</b></p>';

// session.use_trans_sid
const _AM_ADV_SESSION_ERROR ='';
const _AM_ADV_SESSION_ON = '<b> session.use_trans_sid</b>をオフにすることをお勧めします<br>
    それ以外の場合、PHPはURLを介してセッションIDを渡します。';
const _AM_ADV_SESSION_DESC ='use_trans_sidが有効になっている場合、PHPはURLを介してセッションIDを渡します。 これにより、アプリケーションはセッションハイジャック攻撃に対してより脆弱になります。
     セッションハイジャックは基本的に、ハッカーがセッションIDを盗むことによって正当なユーザーになりすますID盗難の一形態です。
     セッショントークンがCookieで送信され、SSLを介して要求が行われる場合、トークンは安全です。';
const _AM_ADV_SESSION_TIPS ='<b> .htaccess</b>または<b>php.ini</b>から<b>session.use_trans_sid</b>を無効にできます<br>
    mod_rewriteモジュールがApacheで有効になっている場合は、この行をパブリックルートフォルダーの.htaccessファイルに挿入できます。<br>
    <b>php_flag session.use_trans_sid off</b><br>
    または、「php.ini」でこのphp機能を無効にします:<br>
    <b>session.use_trans_sid = "off"</b>';

// Database
const _AM_ADV_DBPREFIX_ON = "<b>データベースプレフィックス</b>を変更することをお勧めします !";
const _AM_ADV_DBPREFIX_DESC = "この設定は、<b>SQLインジェクション攻撃</b>のセキュリティリスクです。<br>
    入力のサニタイズと検証により、最も一般的なWebサイト攻撃の一部を防ぐことができます。<br>
    モジュールの設定でSQL<b>サニタイズ</b>オプションを有効にします。";
const _AM_ADV_DBPREFIX_TIPS = 'Prefix Managerを使用して、データベースプレフィックスを管理、保存、および変更できます。<br> <a class="button" href="index.php?page=prefix_manager">Prefix manager</a>';

// Database factory
const _AM_ADV_DBFACTORYPATCHED = 'データベースファクトリはDBLayerTrappingAnti-SQL-Injectionの準備ができています';
const _AM_ADV_DBFACTORYUNPATCHED = 'あなたのデータベースファクトリーは準備ができていません！';
const _AM_ADV_DBFACTORY_ON = 'データベースファクトリは、DBLayerTrappingアンチSQLインジェクションの準備ができていません。 <br>パッチまたはアップデートが必要です！';
const _AM_ADV_DBFACTORY_DESC ='SQLインジェクション（SQLi）とは、攻撃者がWebアプリデータベースサーバーを制御する悪意のあるSQLステートメントを実行する可能性のあるインジェクション攻撃を指します。
      プロテクターは、ユーザー入力を含むSQLクエリを処理するときに、パラメーター化されたクエリを保証します。';
const _AM_ADV_DBFACTORY_TIPS = 'パラメータ化されたクエリにより、データベースはSQLクエリのどの部分をユーザー入力と見なす必要があるかを理解できるため、SQLインジェクションを解決できます。
      この機能を有効にするには、更新が必要です。 または、ファイルにパッチを適用します<b> class / database / databasefactory.php </b>';

// Test Protector
const _AM_ADV_SUBTITLECHECK = 'Protectorの動作チェック';
const _AM_ADV_CHECKCONTAMI = '変数汚染';
const _AM_ADV_CHECKISOCOM = '孤立コメント';
