<?php
// Syntax replace define with const v2.3.0 2021/05/15 @gigamaster XCL-PHP7

//%%%%%%		File Name user.php 		%%%%%
const _US_NOTREGISTERED = '今すぐ<a href="register.php">登録</a>しませんか？';
const _US_LOSTPASSWORD = 'パスワードを紛失されましたか？';
const _US_NOPROBLEM = 'ご心配なく。まずはあなたが登録に使用したメールアドレスを入力し、ボタンをクリックしてください。 パスワード取得用のリンクが記載されたメールがあなたの登録メールアドレス宛に送られます。';
const _US_YOUREMAIL = '登録メールアドレス：';
const _US_SENDPASSWORD = '送信';
const _US_LOGGEDOUT = 'ログアウトしました。';
const _US_THANKYOUFORVISIT = '当サイトをご利用いただきありがとうございました。';
const _US_INCORRECTLOGIN = 'ログイン情報が間違っています。';
const _US_LOGGINGU = '%sさん、ようこそ。ログイン処理中です。';

// 2001-11-17 ADD
const _US_NOACTTPADM = '選択されたユーザはまだ存在しないか、承認が完了していません。<br>詳細についてはサイト管理者にお問合せください。';
const _US_ACTKEYNOT = '承認キーが間違っています。';
const _US_ACONTACT = '選択されたアカウントは既に承認が完了しています。';
const _US_ACTLOGIN = 'アカウントを承認しました。登録の際に記入したパスワードを使用してログインしてください。';
const _US_NOPERMISS = 'このユーザ情報を変更することはできません。';
const _US_SURETODEL = 'ユーザアカウントを本当に削除しても良いですか？';
const _US_REMOVEINFO = 'アカウントを削除した場合、全てのユーザ情報が失われます。';
const _US_BEENDELED = 'アカウントを削除しました。';
//

//%%%%%%		File Name register.php 		%%%%%
const _US_USERREG = 'ユーザ登録';
const _US_NICKNAME = 'ユーザ名';
const _US_EMAIL = 'メールアドレス';
const _US_ALLOWVIEWEMAIL = 'このメールアドレスを公開する';
const _US_WEBSITE = 'ホームページ';
const _US_TIMEZONE = 'タイムゾーン';
const _US_AVATAR = 'アバター';
const _US_VERIFYPASS = 'パスワード確認';
const _US_SUBMIT = '送信';
const _US_USERNAME = 'ユーザ名';
const _US_FINISH = '送信';
const _US_REGISTERNG = '登録できませんでした';
const _US_MAILOK = '当サイトの新着情報などを<br>メールで受け取る';

const _US_INVALIDMAIL = '不正なメールアドレスです。';
const _US_EMAILNOSPACES = 'メールアドレスに空白を含めないでください。';
const _US_INVALIDNICKNAME = '不正なユーザ名です。';
const _US_NICKNAMETOOLONG = 'ユーザ名が長すぎます。半角 %s 文字以内に収めてください。';
const _US_NICKNAMETOOSHORT = 'ユーザ名が短すぎます。半角 %s 文字以上にしてください。';
const _US_NAMERESERVED = 'このユーザ名は使用できません。';
const _US_NICKNAMENOSPACES = 'ユーザ名に空白を含めないでください。';
const _US_NICKNAMETAKEN = 'このユーザ名は既に使用されています。';
const _US_EMAILTAKEN = 'このメールアドレスは既に使用されています。';
const _US_ENTERPWD = 'パスワードを記入してください。';
const _US_SORRYNOTFOUND = 'ユーザ情報が見つかりませんでした。';

const _US_DISCLAIMER = '免責';
const _US_IAGREE = '私は上記事項に同意します。';
const _US_UNEEDAGREE = '申し訳ございませんが、登録するためには免責事項にご同意いただく必要があります。';
const _US_NOREGISTER = '申し訳ございませんが、現在このサイトでは新規ユーザの登録受付を行っておりません。';

// %s is username. This is a subject for email
const _US_USERKEYFOR = '%sさんの承認キーです';

const _US_YOURREGISTERED = '登録が完了しました。記載されたメールを登録メールアドレス宛に承認キーを送信しました。メールの指示に従い、承認を完了してください。';
const _US_YOURREGMAILNG = '登録が完了しました。しかし、サーバ内部エラーにより承認キーが記載されたメールを送信することができませんでした。大変申し訳ありませんが、サイト管理者までお問い合わせください。';
const _US_YOURREGISTERED2 = '登録が完了しました。サイト管理者がアカウントを承認するまでお待ちください。承認完了時にはメールにてお知らせします。';

// %s is your site name
const _US_NEWUSERREGAT = '新規登録ユーザ＠%s';
// %s is a username
const _US_HASJUSTREG = '新規登録ユーザがありました！　ユーザ名：%s';

// %s is your site name
const _US_NEWPWDREQ = '新規パスワードのリクエスト＠%s';
const _US_YOURACCOUNT = '%sでのユーザアカウント';

const _US_MAILPWDNG = 'mail_password: ユーザ情報の更新に失敗しました。お手数ですが、サイト管理者までお問合せください。';

// %s is a username
const _US_PWDMAILED = '%sさん宛にパスワードを送信しました。';
const _US_CONFMAIL = 'パスワード取得用リンクが記載されたメールを%sさん宛に送信しました。';
const _US_ACTVMAILNG = '%sさんへのメール送信に失敗しました。';
const _US_ACTVMAILOK = '%sさんへメールを送信しました。';

//%%%%%%		File Name userinfo.php 		%%%%%
const _US_SELECTNG = 'ユーザが選択されていません';
const _US_PM = 'PM';
const _US_ICQ = 'ICQ';
const _US_AIM = 'AIM';
const _US_YIM = 'YIM';
const _US_MSNM = 'Windows Live ID';
const _US_LOCATION = '居住地';
const _US_OCCUPATION = '職業';
const _US_INTEREST = '趣味';
const _US_SIGNATURE = '署名';
const _US_EXTRAINFO = 'その他';
const _US_EDITPROFILE = 'プロフィールの編集';
const _US_LOGOUT = 'ログアウト';
const _US_INBOX = '受信箱';
const _US_MEMBERSINCE = '登録日';
const _US_RANK = 'ランク';
const _US_POSTS = '投稿数';
const _US_LASTLOGIN = '最終ログイン日時';
const _US_ALLABOUT = '%sさんの基本情報';
const _US_STATISTICS = '統計情報';
const _US_MYINFO = '個人情報';//My Info';
const _US_BASICINFO = '基本情報';
const _US_MOREABOUT = '個人情報詳細';//More About Me';
const _US_SHOWALL = 'すべて表示';


//%%%%%%		File Name edituser.php 		%%%%%
const _US_PROFILE = 'プロフィール';
const _US_REALNAME = '本名';
const _US_SHOWSIG = '投稿に署名を必ず追加する';
const _US_CDISPLAYMODE = 'コメント表示モード';
const _US_CSORTORDER = 'コメントの並び順';
const _US_PASSWORD = 'パスワード';
const _US_TYPEPASSTWICE = '（パスワードを変更する場合のみ記入してください）';
const _US_SAVECHANGES = '変更を保存';
const _US_NOEDITRIGHT = 'このユーザ情報を変更する権限がありません。';
const _US_PASSNOTSAME = 'パスワードが正しくありません。同じパスワードを二度入力してください。';
const _US_PWDTOOSHORT = 'パスワードは半角<b>%s</b>文字以上にしてください。';
const _US_PROFUPDATED = 'プロフィールを更新しました。';
const _US_USECOOKIE = 'ユーザ名を１年間クッキーに保存する';
const _US_NO = 'いいえ';
const _US_DELACCOUNT = 'アカウントを削除する';
const _US_MYAVATAR = 'アップロード済みアバター';
const _US_UPLOADMYAVATAR = 'アバターをアップロードする';
const _US_MAXPIXEL = '最大ピクセル数';
const _US_MAXIMGSZ = '最大ファイルサイズ';
const _US_SELFILE = 'ファイル選択';
const _US_OLDDELETED = '古いアバター画像は上書きされます。';
const _US_CHOOSEAVT = 'アバターを一覧から選択してください。';
const _US_PRESSLOGIN = '下記ボタンをクリックしてログインしてください。';
const _US_ADMINNO = '管理者グループに属するユーザは削除できません';
const _US_GROUPS = '所属グループ';
