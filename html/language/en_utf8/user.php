<?php
// $Id: user.php, Syntax replace define with const v2.3.0 2021/05/15 @gigamaster XCL-PHP7

//%%%%%%		File Name user.php 		%%%%%
const _US_NOTREGISTERED = 'Not registered?  Click <a href="register.php">here</a>.';
const _US_LOSTPASSWORD = 'Lost your Password?';
const _US_NOPROBLEM = 'No problem. Simply enter the e-mail address we have on file for your account.';
const _US_YOUREMAIL = 'Your Email: ';
const _US_SENDPASSWORD = 'Send Password';
const _US_LOGGEDOUT = 'You are now logged out';
const _US_THANKYOUFORVISIT = 'Thank you for your visit to our site!';
const _US_INCORRECTLOGIN = 'Incorrect Login!';
const _US_LOGGINGU = 'Thank you for logging in, %s.';

// 2001-11-17 ADD
const _US_NOACTTPADM = 'The selected user has been deactivated or has not been activated yet.<br>Please contact the administrator for details.';
const _US_ACTKEYNOT = 'Activation key not correct!';
const _US_ACONTACT = 'Selected account is already activated!';
const _US_ACTLOGIN = 'Your account has been activated. Please login with the registered password.';
const _US_NOPERMISS = 'Sorry, you dont have the permission to perform this action!';
const _US_SURETODEL = 'Are you sure you want to delete your account?';
const _US_REMOVEINFO = 'This will remove all your info from our database.';
const _US_BEENDELED = 'Your account has been deleted.';
//

//%%%%%%		File Name register.php 		%%%%%
const _US_USERREG = 'User Registration';
const _US_NICKNAME = 'Username';
const _US_EMAIL = 'Email';
const _US_ALLOWVIEWEMAIL = 'Allow other users to view my email address';
const _US_WEBSITE = 'Website';
const _US_TIMEZONE = 'Time Zone';
const _US_AVATAR = 'Avatar';
const _US_VERIFYPASS = 'Verify Password';
const _US_SUBMIT = 'Submit';
const _US_USERNAME = 'Username';
const _US_FINISH = 'Finish';
const _US_REGISTERNG = 'Could not register new user.';
const _US_MAILOK = 'Receive occasional email notices <br>from administrators and moderators?';
const _US_DISCLAIMER = 'Disclaimer';
const _US_IAGREE = 'I agree to the above';
const _US_UNEEDAGREE = 'Sorry, you have to agree to our disclaimer to get registered.';
const _US_NOREGISTER = 'Sorry, we are currently closed for new user registrations';


// %s is username. This is a subject for email
const _US_USERKEYFOR = 'User activation key for %s';

const _US_YOURREGISTERED = 'You are now registered. An email containing an user activation key has been sent to the email account you provided. Please follow the instructions in the mail to activate your account. ';
const _US_YOURREGMAILNG = 'You are now registered. However, we were unable to send the activation mail to your email account due to an internal error that had occurred on our server. We are sorry for the inconvenience, please send the webmaster an email notifying him/her of the situation.';
const _US_YOURREGISTERED2 = 'You are now registered.  Please wait for your account to be activated by the adminstrators.  You will receive an email once you are activated.  This could take a while so please be patient.';

// %s is your site name
const _US_NEWUSERREGAT = 'New user registration at %s';
// %s is a username
const _US_HASJUSTREG = '%s has just registered!';

const _US_INVALIDMAIL = 'ERROR: Invalid email';
const _US_EMAILNOSPACES = 'ERROR: Email addresses do not contain spaces.';
const _US_INVALIDNICKNAME = 'ERROR: Invalid Username';
const _US_NICKNAMETOOLONG = 'Username is too long. It must be less than %s characters.';
const _US_NICKNAMETOOSHORT = 'Username is too short. It must be more than %s characters.';
const _US_NAMERESERVED = 'ERROR: Name is reserved.';
const _US_NICKNAMENOSPACES = 'There cannot be any spaces in the Username.';
const _US_NICKNAMETAKEN = 'ERROR: Username taken.';
const _US_EMAILTAKEN = 'ERROR: Email address already registered.';
const _US_ENTERPWD = 'ERROR: You must provide a password.';
const _US_SORRYNOTFOUND = 'Sorry, no corresponding user info was found.';


// %s is your site name
const _US_NEWPWDREQ = 'New Password Request at %s';
const _US_YOURACCOUNT = 'Your account at %s';

const _US_MAILPWDNG = 'mail_password: could not update user entry. Contact the Administrator';

// %s is a username
const _US_PWDMAILED = 'Password for %s mailed.';
const _US_CONFMAIL = 'Confirmation Mail for %s mailed.';
const _US_ACTVMAILNG = 'Failed sending notification mail to %s';
const _US_ACTVMAILOK = 'Notification mail to %s sent.';

//%%%%%%		File Name userinfo.php 		%%%%%
const _US_SELECTNG = 'No User Selected! Please go back and try again.';
const _US_PM = 'PM';
const _US_ICQ = 'ICQ';
const _US_AIM = 'AIM';
const _US_YIM = 'YIM';
const _US_MSNM = 'Windows Live ID';
const _US_LOCATION = 'Location';
const _US_OCCUPATION = 'Occupation';
const _US_INTEREST = 'Interest';
const _US_SIGNATURE = 'Signature';
const _US_EXTRAINFO = 'Resume';
const _US_EDITPROFILE = 'Edit Profile';
const _US_LOGOUT = 'Logout';
const _US_INBOX = 'Inbox';
const _US_MEMBERSINCE = 'Member Since';
const _US_RANK = 'Rank';
const _US_POSTS = 'Comments/Posts';
const _US_LASTLOGIN = 'Last Login';
const _US_ALLABOUT = 'All about %s';
const _US_STATISTICS = 'Statistics';
const _US_MYINFO = 'My Info';
const _US_BASICINFO = 'Basic information';
const _US_MOREABOUT = 'More About Me';
const _US_SHOWALL = 'Show All';

//%%%%%%		File Name edituser.php 		%%%%%
const _US_PROFILE = 'Profile';
const _US_REALNAME = 'Real Name';
const _US_SHOWSIG = 'Always attach my signature';
const _US_CDISPLAYMODE = 'Comments Display Mode';
const _US_CSORTORDER = 'Comments Sort Order';
const _US_PASSWORD = 'Password';
const _US_TYPEPASSTWICE = '(type a new password twice to change it)';
const _US_SAVECHANGES = 'Save Changes';
const _US_NOEDITRIGHT = "Sorry, you don't have the right to edit this user's info.";
const _US_PASSNOTSAME = 'Both passwords are different. They must be identical.';
const _US_PWDTOOSHORT = 'Sorry, your password must be at least <b>%s</b> characters long.';
const _US_PROFUPDATED = 'Your Profile Updated!';
const _US_USECOOKIE = 'Store my user name in a cookie for 1 year';
const _US_NO = 'No';
const _US_DELACCOUNT = 'Delete Account';
const _US_MYAVATAR = 'My Avatar';
const _US_UPLOADMYAVATAR = 'Upload Avatar';
const _US_MAXPIXEL = 'Max Pixels';
const _US_MAXIMGSZ = 'Max Image Size (Bytes)';
const _US_SELFILE = 'Select file';
const _US_OLDDELETED = 'Your old avatar will be deleted!';
const _US_CHOOSEAVT = 'Choose avatar from the available list';

const _US_PRESSLOGIN = 'Press the button below to login';

const _US_ADMINNO = 'User in the webmasters group cannot be removed';
const _US_GROUPS = 'User\'s Groups';
