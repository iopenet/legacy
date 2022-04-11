<?php
// Syntax replace define with const v2.3.0 2021/05/15 @gigamaster XCL-PHP7

const _TOKEN_ERROR = '照合用のワンタイム・チケットが見つかりませんでした。ほとんどの場合は操作手順の関係でワンタイム・チケットが消費されただけですが、CSRF攻撃を受けた可能性もあります（この操作は本当にあなたが望んだ操作ですか？）　操作内容をしっかり確認し、もう一度操作を行ってください。';
const _SYSTEM_MODULE_ERROR = '以下のモジュールが導入されていません';
const _INSTALL = 'インストール';
const _UNINSTALL = '削除';
const _SYS_MODULE_UNINSTALLED = '必須(未導入)';
const _SYS_MODULE_DISABLED = '必須(無効)';
const _SYS_RECOMMENDED_MODULES = '導入推奨';
const _SYS_OPTION_MODULES = '選択導入可能';
const _UNINSTALL_CONFIRM = '必須モジュールのアンインストールを行いますか？';

//%%%%%%	File Name mainfile.php 	%%%%%
const _PLEASEWAIT = 'しばらくお待ちください';
const _FETCHING = 'Loading...';
const _TAKINGBACK = '元の場所へと戻ります....';
const _LOGOUT = 'ログアウト';
const _SUBJECT = '表題';
const _MESSAGEICON = 'アイコン';
const _COMMENTS = 'コメント';
const _POSTANON = '匿名で投稿';
const _DISABLESMILEY = '顔アイコンを無効';
const _DISABLEHTML = 'HTMLタグを無効';
const _PREVIEW = 'プレビュー';

const _GO = '送信';
const _NESTED = 'ネスト表示';
const _NOCOMMENTS = 'コメント非表示';
const _FLAT = 'フラット表示';
const _THREADED = 'スレッド表示';
const _OLDESTFIRST = '古いものから';
const _NEWESTFIRST = '新しいものから';
const _MORE = 'もっと...';
const _MULTIPAGE = '[pagebreak]タグを本文内に記入することでページ区切りを挿入することができます。';
const _IFNOTRELOAD = 'ページが自動的に更新されない場合は<a href="%s">ここ</a>をクリックしてください';
const _WARNINSTALL2 = "注）ディレクトリ %s はサーバー上に存在します。<br>'install/passwd.php' ファイルを開き、パスワードを追加するか、必ず削除してください。";
const _WARNINWRITEABLE = '注意：ファイル%sへの書き込みが可能となっています。このファイルのパーミッション設定を変更してください。';
const _WARNPHPENV = '注意：PHPの設定環境の中で、"%s" が "%s"になっています。%s';
const _WARNSECURITY = '（サイトの脆弱につながる危険性があります。）';
const _WARN_INSTALL_TIP = 'Activate the Preload — For development purposes only!<br> Use the preload to keep mainfile and install directory.<br>Remember to chomd and delete install to prevent any security problem.';

//%%%%%%	File Name themeuserpost.php 	%%%%%
const _POSTEDBY = '投稿者：'; // Posted date
const _PROFILE = 'プロフィール';
const _VISITWEBSITE = 'ホームページ';
const _SENDPMTO = '%sさんにプライベートメッセージを送る。';
const _SENDEMAILTO = '%sさんにメールを送る。';
const _ADD = '追加';
const _REPLY = '返信';
const _DATE = '投稿日時：';

//%%%%%%	File Name admin_functions.php 	%%%%%
const _MAIN = 'トップ';
const _MANUAL = 'マニュアル';
const _INFO = 'バージョン情報';
const _CPHOME = '管理メニュー';
const _YOURHOME = 'ホームページ';

//%%%%%%	File Name misc.php (who's-online popup)	%%%%%
const _WHOSONLINE = 'オンライン状況';
const _GUESTS = 'ゲスト';
const _MEMBERS = '登録ユーザ';
const _ONLINEPHRASE = '%s 人のユーザが現在オンラインです。';
const _ONLINEPHRASEX = '%s 人のユーザが %s を参照しています。';
const _CLOSE = '閉じる';    // Close window

//%%%%%%	File Name module.textsanitizer.php 	%%%%%
const _QUOTEC = '引用：';

//%%%%%%	File Name admin.php 	%%%%%
const _NOPERM = 'このエリアへのアクセスは、ログイン若しくは許可された権限が必要です。';

//%%%%%		Common Phrases		%%%%%
const _NO = 'いいえ';
const _YES = 'はい';
const _EDIT = '編集';
const _DELETE = '削除';
const _VIEW = '閲覧';
const _SUBMIT = '送信';
const _MODULENOEXIST = '選択されたページは存在しません';
const _ALIGN = '位置';
const _LEFT = '左';
const _CENTER = '中央';
const _RIGHT = '右';
const _FORM_ENTER = '%sを入力してください';
// %s represents file name
const _MUSTWABLE = 'ファイル %s への書き込み権限があるかどうか確認してください。';

const _PREFERENCES = '一般設定';
const _VERSION = 'バージョン';
const _DESCRIPTION = '説明';
const _ERRORS = 'エラー';
const _NONE = 'なし';
const _ON = '投稿日時：';
const _READS = 'ヒット';
const _WELCOMETO = '%sへようこそ';
const _SEARCH = '検索';
const _ALL = 'すべて';
const _TITLE = '題名';       //-no use
const _OPTIONS = 'オプション';
const _QUOTE = '引用';      //-no use
const _LIST = '一覧';
const _LOGIN = 'ログイン';
const _USERNAME = 'ユーザ名';
const _PASSWORD = 'パスワード';
const _SELECT = '選択';
const _IMAGE = '画像';
const _SEND = '送信';
const _CANCEL = 'キャンセル';
const _ASCENDING = '昇順';
const _DESCENDING = '降順';
const _BACK = '戻る';
const _NOTITLE = '無題';
const _RETURN_TOP = 'Topへ戻る';

/* Image manager */
const _IMGMANAGER = 'イメージ・マネジャー';
const _NUMIMAGES = '%s 枚';
const _ADDIMAGE = '画像ファイルの追加';
const _IMAGENAME = '画像名:';
const _IMGMAXSIZE = 'アップロードを許可するファイルサイズ(バイト数):';
const _IMGMAXWIDTH = 'アップロードを許可する画像の横幅（ピクセル数）:';
const _IMGMAXHEIGHT = 'アップロードを許可する画像の高さ（ピクセル数）:';
const _IMAGECAT = 'カテゴリ:';
const _IMAGEFILE = '画像ファイル名:';
const _IMGWEIGHT = 'イメージマネジャーでの表示順:';
const _IMGDISPLAY = 'この画像を表示する';
const _IMAGEMIME = 'MIMEタイプ:';
const _FAILFETCHIMG = 'アップロードファイル %s が取得できませんでした。';
const _FAILSAVEIMG = '画像ファイル %s をデータベースに格納できませんでした。';
const _NOCACHE = 'キャッシュなし';
const _CLONE = '複製';



//%%%%%	File Name class/xoopsform/formmatchoption.php 	%%%%%
const _STARTSWITH = '前方一致';
const _ENDSWITH = '後方一致';
const _MATCHES = '完全一致';
const _CONTAINS = '次の単語を含む';

//%%%%%%	File Name commentform.php 	%%%%%
const _REGISTER = '登録';

//%%%%%%	File Name xoopscodes.php 	%%%%%
const _SIZE = '大きさ';  // font size
const _FONT = 'フォント';  // font family
const _COLOR = '色';    // font color
const _EXAMPLE = 'サンプル';
const _ENTERURL = 'リンクしたいサイトのURLを入力してください。';
const _ENTERWEBTITLE = 'サイト名を入力してください。';
const _ENTERIMGURL = '画像ファイルのURLを入力してください。';
const _ENTERIMGPOS = '画像ファイルの配置を決めてください。';
const _IMGPOSRORL = '「R」または「r」を入力すると右側に、「L」または「l」を入力すると左側に表示されます。指定しない場合は空欄にしてください。';
const _ERRORIMGPOS = '入力が正しくありません。画像ファイルの配置を決めてください。';
const _ENTEREMAIL = 'リンクしたいメールアドレスを入力してください。';
const _ENTERCODE = 'プログラムコードを入力してください。';
const _ENTERQUOTE = '引用したい文を入力してください。';
const _ENTERTEXTBOX = 'テキストボックスに入力してください。';
const _ALLOWEDCHAR = '最大バイト数：';
const _CURRCHAR = '現在のバイト数：';
const _PLZCOMPLETE = '表題およびメッセージ文を記入してください。';
const _MESSAGETOOLONG = 'メッセージ文が長すぎます。';

//%%%%%		TIME FORMAT SETTINGS   %%%%%

const _SECOND = '1秒';
const _SECONDS = '%s秒';
const _MINUTE = '1分';
const _MINUTES = '%s分';
const _HOUR = '1時間';
const _HOURS = '%s時間';
const _DAY = '1日';
const _DAYS = '%s日';
const _WEEK = '1週間';
const _MONTH = '1ヶ月';

const _HELP = 'ヘルプ';

const _CATEGORY = 'カテゴリ';
const _TAG = 'タグ';
const _STATUS = 'ステータス';
const _STATUS_DELETED = '削除済み';
const _STATUS_REJECTED = '却下';
const _STATUS_POSTED = '投稿済み';
const _STATUS_PUBLISHED = '承認済み';

//%%%%% Group %%%%%
const _GROUP = 'グループ';
const _MEMBER = 'メンバー';
const _GROUP_RANK_GUEST = 'ゲスト';
const _GROUP_RANK_ASSOCIATE = '準会員';
const _GROUP_RANK_REGULAR = '会員';
const _GROUP_RANK_STAFF = 'スタッフ';
const _GROUP_RANK_OWNER = 'オーナー';

//%%%%% System %%%%%
const _DEBUG_MODE = 'Debug';
const _DEBUG_MODE_PHP = 'PHP';
const _DEBUG_MODE_SQL = 'SQL';
const _DEBUG_MODE_SMARTY = 'Smarty';
const _DEBUG_MODE_DESC = 'Disable debug mode in production. Admin > Settings > Debug mode [Off].';
