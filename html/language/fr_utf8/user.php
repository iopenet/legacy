<?php
// Syntax replace define with const v2.3.0 2021/05/15 @gigamaster XCL-PHP7

//%%%%%% File Name user.php %%%%%
const _US_NOTREGISTERED = 'Pas encore membre ? Cliquez <a href=register.php>ici</a>.';
const _US_LOSTPASSWORD = 'Perdu votre mot de passe ?';
const _US_NOPROBLEM = "Pas de problème. Entrez simplement l'adresse e-mail que vous avez fournie pour votre compte.";
const _US_YOUREMAIL = 'Votre E-mail : ';
const _US_SENDPASSWORD = 'Envoyer le mot de passe';
const _US_LOGGEDOUT = 'Vous êtes maintenant déconnecté(e)';
const _US_THANKYOUFORVISIT = "Merci de votre visite sur notre site !";
const _US_INCORRECTLOGIN = 'Indentifiant incorrect !';
const _US_LOGGINGU = 'Merci pour votre connexion, %s.';

const _US_NOACTTPADM = "L'utilisateur sélectionné a été désactivé ou n'a pas encore été activé.<br>Merci de contacter l'administrateur pour des détails.";
const _US_ACTKEYNOT = "Clé d'activation incorrecte !";
const _US_ACONTACT = 'Le compte sélectionné est déjà activé !';
const _US_ACTLOGIN = 'Votre compte a été activé. Merci de vous connecter avec le mot de passe enregistré.';
const _US_NOPERMISS = "Désolé, vous n'avez pas la permission de faire cette action !";
const _US_SURETODEL = 'Etes-vous sûr de vouloir supprimer votre compte ?';
const _US_REMOVEINFO = 'Ceci va supprimer toutes vos informations de notre base de données.';
const _US_BEENDELED = 'Votre compte a été supprimé.';
//
//%%%%%% File Name register.php %%%%%
const _US_USERREG = 'Enregistrement Membre';
const _US_NICKNAME = 'Pseudo';
const _US_EMAIL = 'E-mail';
const _US_ALLOWVIEWEMAIL = 'Autoriser les autres utilisateurs à voir mon adresse e-mail';
const _US_WEBSITE = 'Site Web';
const _US_TIMEZONE = 'Fuseau horaire';
const _US_AVATAR = 'Avatar';
const _US_VERIFYPASS = 'Vérifier le mot de passe';
const _US_SUBMIT = 'Valider';
const _US_USERNAME = 'Pseudo';
const _US_FINISH = 'Terminer';
const _US_REGISTERNG = "Impossible d'enregistrer un nouveau membre.";
const _US_MAILOK = "Autoriser les administrateurs du site et<br> les modérateurs à m'envoyer occasionnellement des avis par e-mail ?";
const _US_DISCLAIMER = 'Mise en garde';
const _US_IAGREE = "J'accepte la mise en garde ci-dessus";
const _US_UNEEDAGREE = "Désolé, vous n'avez pas accepté notre mise en garde pour l'inscription.";
const _US_NOREGISTER = 'Désolé, nous avons actuellement fermé les nouvelles inscriptions';
// %s is username. This is a subject for email
const _US_USERKEYFOR = "Clé d'activation membre pour %s"; // mail
const _US_YOURREGISTERED = "Vous êtes maintenant enregistré. Un e-mail contenant une clé d'activation de votre compte a été envoyé à l'adresse e-mail que vous avez fournie. Merci de suivre les instructions de ce mail pour activer votre compte. ";
const _US_YOURREGMAILNG = "Vous êtes maintenant enregistré. Cependant, nous sommes dans l'incapacité d'envoyer le mail d'activation à votre adresse e-mail en raison d'une erreur interne survenue sur notre serveur. Nous sommes désolés pour cet inconvénient, merci d'envoyer un e-mail de notification au(x) webmestre(s) du site.";
const _US_YOURREGISTERED2 = "Vous êtes maintenant enregistré. Merci de patienter afin que votre compte soit activé par un des administrateurs. Vous recevrez un e-mail lorsqu'il aura été activé. Ceci peut prendre quelques jours, merci d'être patient.";
// %s is your site name
const _US_NEWUSERREGAT = 'Nouveau membre inscrit sur %s';
// %s is a username
const _US_HASJUSTREG = "%s vient juste de s'inscrire !";
const _US_INVALIDMAIL = 'ERREUR : E-mail Invalide';
const _US_EMAILNOSPACES = "ERREUR : L'adresse e-mail ne doit pas contenir d'espaces.";
const _US_INVALIDNICKNAME = 'ERREUR : Pseudo invalide';
const _US_NICKNAMETOOLONG = 'Le Pseudo est trop long. Il doit faire moins de %s caractères.';
const _US_NICKNAMETOOSHORT = 'Le Pseudo est trop court. Il doit faire plus de %s caractères.';
const _US_NAMERESERVED = 'ERREUR : Ce Pseudo est réservé.';
const _US_NICKNAMENOSPACES = "Il ne doit pas y avoir d'espaces dans le Pseudo.";
const _US_NICKNAMETAKEN = 'ERREUR : Ce Pseudo est déjà utilisé.';
const _US_EMAILTAKEN = 'ERREUR : Adresse e-mail déjà enregistrée.';
const _US_ENTERPWD = 'ERREUR: Vous devez fournir un mot de passe.';
const _US_SORRYNOTFOUND = "Désolé, aucune info membre correspondante n'a été trouvée.";
// %s is your site name
const _US_NEWPWDREQ = 'Demande de nouveau mot de passe sur %s';
const _US_YOURACCOUNT = 'Votre compte sur %s';
const _US_MAILPWDNG = "mail_password : Impossible de mettre à jour l'entrée utilisateur. Contactez l'Administrateur";
// %s is a username
const _US_PWDMAILED = 'Mot de passe pour %s envoyé.';
const _US_CONFMAIL = 'Mail de confirmation pour %s envoyé.';
const _US_ACTVMAILNG = "Echec d'envoi du mail de notification à %s";
const _US_ACTVMAILOK = 'Mail de notification à %s envoyé.';
//%%%%%% File Name userinfo.php %%%%%
const _US_SELECTNG = "Pas d'utilisateur sélectionné ! Merci de revenir en arrière et de recommencer.";
const _US_PM = 'PM';
const _US_ICQ = 'ICQ';
const _US_AIM = 'AIM';
const _US_YIM = 'YIM';
const _US_MSNM = 'Windows Live ID';
const _US_LOCATION = 'Résidence';
const _US_OCCUPATION = 'Profession';
const _US_INTEREST = "Centres d'intérêts";
const _US_SIGNATURE = 'Signature';
const _US_EXTRAINFO = 'Infos complémentaires';
const _US_EDITPROFILE = 'Editer le profil';
const _US_LOGOUT = 'Déconnexion';
const _US_INBOX = 'En attente';
const _US_MEMBERSINCE = 'Membre depuis';
const _US_RANK = 'Classement';
const _US_POSTS = 'Commentaires/Envois';
const _US_LASTLOGIN = 'Dernière connexion';
const _US_ALLABOUT = 'Tout à propos de %s';
const _US_STATISTICS = 'Statistiques';
const _US_MYINFO = 'Mes infos';
const _US_BASICINFO = 'Informations de base';
const _US_MOREABOUT = 'Plus à propos de moi';
const _US_SHOWALL = 'Afficher tout';
//%%%%%% File Name edituser.php %%%%%
const _US_PROFILE = 'Profil';
const _US_REALNAME = 'Nom Réel';
const _US_SHOWSIG = 'Toujours attacher ma signature';
const _US_CDISPLAYMODE = "Mode d'affichage des commentaires";
const _US_CSORTORDER = 'Ordre des commentaires';
const _US_PASSWORD = 'Mot de passe';
const _US_TYPEPASSTWICE = '(Saisissez deux fois un nouveau mot de passe pour le changer)';
const _US_SAVECHANGES = 'Sauver les changements';
const _US_NOEDITRIGHT = "Désolé, vous n'avez pas le droit d'éditer les infos de ce membre.";
const _US_PASSNOTSAME = 'Les 2 mots de passe sont différents. Ils doivent être identiques.';
const _US_PWDTOOSHORT = 'Désolé, votre mot de passe doit avoir au moins <b>%s</b> caractères de long.';
const _US_PROFUPDATED = 'Votre profil a été mis à jour !';
const _US_USECOOKIE = 'Conserver mon pseudo dans un cookie pour 1 an';
const _US_NO = 'Non';
const _US_DELACCOUNT = 'Supprimer le compte';
const _US_MYAVATAR = 'Mon avatar';
const _US_UPLOADMYAVATAR = 'Envoyer mon avatar';
const _US_MAXPIXEL = 'Nbre maxi de Pixels';
const _US_MAXIMGSZ = "Taille maxi de l'image (Octets)";
const _US_SELFILE = 'Sélectionnez un fichier';
const _US_OLDDELETED = 'Votre ancien avatar va être effacé !';
const _US_CHOOSEAVT = 'Choisir un avatar dans la liste disponible';
const _US_PRESSLOGIN = 'Pressez le bouton ci-dessous pour vous connecter';
const _US_ADMINNO = 'Les utilisateurs du groupe webmestres ne peuvent être enlevés';
const _US_GROUPS = 'Groupes de l\'utilisateur';
