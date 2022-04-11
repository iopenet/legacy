<?php
// Syntax replace define with const v2.3.0 2021/05/15 @gigamaster XCL-PHP7
const _TOKEN_ERROR = "Attention ! A fin d'éviter une erreur dans la requête faite au serveur, la validation du formulaire requiert une confirmation!";
const _SYSTEM_MODULE_ERROR = "Les modules suivants sont requis.";
const _INSTALL = "Installer";
const _UNINSTALL = "Désinstaller";
const _SYS_MODULE_UNINSTALLED = "Requis (Non Installé)";
const _SYS_MODULE_DISABLED = "Requis (Désactivé)";
const _SYS_RECOMMENDED_MODULES = "Module Recommendé";
const _SYS_OPTION_MODULES = "Module Optionnel";
const _UNINSTALL_CONFIRM = "Voulez-vous désinstaller le module System?";

//%%%%%% File Name mainfile.php %%%%%
const _PLEASEWAIT = "Veuillez patienter";
const _FETCHING = "Chargement...";
const _TAKINGBACK = "Retour à là page précédente...";
const _LOGOUT = "Déconnexion";
const _SUBJECT = "Sujet";
const _MESSAGEICON = "Icône de message";
const _COMMENTS = "Commentaires";
const _POSTANON = "Poster en anonyme";
const _DISABLESMILEY = "Désactiver les émoticônes";
const _DISABLEHTML = "Désactiver le html";
const _PREVIEW = "Prévisualiser";

const _GO = "Ok !";
const _NESTED = "Emboîté";
const _NOCOMMENTS = "Sans commentaires";
const _FLAT = "A plat";
const _THREADED = "Par conversation";
const _OLDESTFIRST = "Les anciens en premier";
const _NEWESTFIRST = "Les récents en premier";
const _MORE = "plus...";
const _MULTIPAGE = "Pour avoir votre article sur des pages multiples, insérer le mot <span style='color:red'>[pagebreak]</span> (avec les crochets) dans l'article.";
const _IFNOTRELOAD = "Si la page ne se recharge pas automatiquement, merci de cliquer <a href=%s>ici</a>";
const _WARNINSTALL2 = "ATTENTION: Le repértoire %s existe sur votre serveur.<br>Ajoutez um mot-de-passe au fichier 'install/passwd.php' ou supprimez ce repértoire pour des raisons de sécurité.";
const _WARNINWRITEABLE = "ATTENTION : Veillez Changer les permissions du fichier %s pour des raisons de sécurité - sous Unix (444), sous Win32 (lecture seule)";
const _WARNPHPENV = "ATTENTION : paramètres php.ini \"%s\" est réglé \"%s\". %s";
const _WARNSECURITY = "(Ceci peut causer des problèmes de sécurité)";
const _WARN_INSTALL_TIP = "Activer la précharge - A des fins de développement uniquement!<br>Utilisez le 'preload' pour conserver le fichier 'mainfile'' et le répertoire d'installation.<br>Souvenez-vous de changer les permissions de 'mainfile' (lecture) et de supprimer '/install' pour des raisons de sécurité.";

//%%%%%% File Name themeuserpost.php %%%%%
const _PROFILE = "Profil";
const _POSTEDBY = "Posté par";
const _VISITWEBSITE = "Visiter le site Web";
const _SENDPMTO = "Envoyer un message privé à %s";
const _SENDEMAILTO = "Envoyer un E-mail à %s";
const _ADD = "Ajouter";
const _REPLY = "Répondre";
const _DATE = "Date";

//%%%%%% File Name admin_functions.php %%%%%
const _MAIN = "Principal";
const _MANUAL = "Manuel";
const _INFO = "Info";
const _CPHOME = "Panneau de contrôle";
const _YOURHOME = "Page d'accueil";

//%%%%%% File Name misc.php (who's-online popup) %%%%%
const _WHOSONLINE = "Qui est en ligne";
const _GUESTS = 'Invité(s)';
const _MEMBERS = 'Membre(s)';
const _ONLINEPHRASE = "<b>%s</b> utilisateur(s) en ligne";
const _ONLINEPHRASEX = "dont <b>%s</b> sur <b>%s</b>";
const _CLOSE = "Fermer"; // Close window

//%%%%%% File Name module.textsanitizer.php %%%%%
const _QUOTEC = "Citation :";

//%%%%%% File Name admin.php %%%%%
const _NOPERM = "Désolé, vous n'avez pas les droits d'accès à cette zone.";

//%%%%% Common Phrases %%%%%
const _NO = "Non";
const _YES = "Oui";
const _EDIT = "Editer";
const _DELETE = "Effacer";
const _VIEW = "Visualiser";
const _SUBMIT = "Valider";
const _MODULENOEXIST = "Le module sélectionné n'existe pas !";
const _ALIGN = "Alignement";
const _LEFT = "Gauche";
const _CENTER = "Centre";
const _RIGHT = "Droite";
const _FORM_ENTER = "Merci d'entrer %s";
// %s represents file name
const _MUSTWABLE = "Le fichier %s doit être accessible en écriture sur le serveur !";
// Module info
const _PREFERENCES = 'Préférences';
const _VERSION = "Version";
const _DESCRIPTION = "Description";
const _ERRORS = "Erreurs";
const _NONE = "Aucun";
const _ON = 'le';
const _READS = 'lectures';
const _WELCOMETO = 'Bienvenue sur %s';
const _SEARCH = 'Chercher';
const _ALL = 'Tous';
const _TITLE = 'Titre';
const _OPTIONS = 'Options';
const _QUOTE = 'Citation';
const _LIST = 'Liste';
const _LOGIN = 'Connexion';
const _USERNAME = 'Pseudo : ';
const _PASSWORD = 'Mot de passe : ';
const _SELECT = "Sélectionner";
const _IMAGE = "Image";
const _SEND = "Envoyer";
const _CANCEL = "Annuler";
const _ASCENDING = "Ordre ascendant";
const _DESCENDING = "Ordre déscendant";
const _BACK = 'Retour';
const _NOTITLE = 'Aucun titre';
const _RETURN_TOP = 'Retour haut de la page';
/* Image manager */
const _IMGMANAGER = "Gestionnaire d'images";
const _NUMIMAGES = '%s images';
const _ADDIMAGE = 'Ajouter un fichier image';
const _IMAGENAME = 'Nom :';
const _IMGMAXSIZE = 'Taille maxi autorisée (ko) :';
const _IMGMAXWIDTH = 'Largeur maxi autorisée (pixels) :';
const _IMGMAXHEIGHT = 'Hauteur maxi autorisée (pixels) :';
const _IMAGECAT = 'Catégorie :';
const _IMAGEFILE = 'Fichier image ';
const _IMGWEIGHT = "Ordre d'affichage dans le gestionnaire d'images :";
const _IMGDISPLAY = 'Afficher cette image ?';
const _IMAGEMIME = 'Type MIME :';
const _FAILFETCHIMG = "Impossible de télécherger le fichier %s";
const _FAILSAVEIMG = "Impossible de stocker l'image %s dans la base de données";
const _NOCACHE = 'Pas de Cache';
const _CLONE = 'Cloner';

//%%%%% File Name class/xoopsform/formmatchoption.php %%%%%
const _STARTSWITH = "Commençant par";
const _ENDSWITH = "Finissant par";
const _MATCHES = "Correspondant à";
const _CONTAINS = "Contenant";

//%%%%%% File Name commentform.php %%%%%
const _REGISTER = "Enregistrement";

//%%%%%% File Name xoopscodes.php %%%%%
const _SIZE = "TAILLE"; // font size
const _FONT = "POLICE"; // font family
const _COLOR = "COULEUR"; // font color
const _EXAMPLE = "EXEMPLE";
const _ENTERURL = "Entrez l'URL du lien que vous voulez ajouter :";
const _ENTERWEBTITLE = "Entrez le titre du site web :";
const _ENTERIMGURL = "Entrez l'URL de l'image que vous voulez ajouter.";
const _ENTERIMGPOS = "Maintenant, entrez l'alignement de l'image.";
const _IMGPOSRORL = "'R' ou 'r' pour droite, 'L' ou 'l' pour gauche, ou laisser vide.";
const _ERRORIMGPOS = "ERREUR ! Entrez l'alignement de l'image.";
const _ENTEREMAIL = "Entrez l'adresse e-mail que vous voulez ajouter.";
const _ENTERCODE = "Entrez les codes que vous voulez ajouter.";
const _ENTERQUOTE = "Entrez le texte que vous voulez citer.";
const _ENTERTEXTBOX = "Merci de saisir le texte dans la boîte.";
const _ALLOWEDCHAR = "Longueur maximum de caractères autorisés : ";
const _CURRCHAR = "Longueur de caractères actuelle : ";
const _PLZCOMPLETE = "Merci de compléter le sujet et le champ message.";
const _MESSAGETOOLONG = "Votre message est trop long.";

//%%%%% TIME FORMAT SETTINGS %%%%%
const _SECOND = '1 seconde';
const _SECONDS = '%s secondes';
const _MINUTE = '1 minute';
const _MINUTES = '%s minutes';
const _HOUR = '1 heure';
const _HOURS = '%s heures';
const _DAY = '1 jour';
const _DAYS = '%s jours';
const _WEEK = '1 semaine';
const _MONTH = '1 mois';

const _HELP = "Aide";
// Added interface Enum

//%%%%%		   %%%%%
const _CATEGORY = 'Category';
const _TAG = 'Tag';
const _STATUS = 'Status';
const _STATUS_DELETED = 'Deleted';
const _STATUS_REJECTED = 'Rejected';
const _STATUS_POSTED = 'Posted';
const _STATUS_PUBLISHED = 'Published';

//%%%%% Group %%%%%
const _GROUP = 'Group';
const _MEMBER = 'Member';
const _GROUP_RANK_GUEST = 'Guest';
const _GROUP_RANK_ASSOCIATE = 'Associate';
const _GROUP_RANK_REGULAR = 'Regular';
const _GROUP_RANK_STAFF = 'Staff';
const _GROUP_RANK_OWNER = 'Owner';

//%%%%% System %%%%%
const _DEBUG_MODE = 'Debug';
const _DEBUG_MODE_PHP = 'PHP';
const _DEBUG_MODE_SQL = 'SQL';
const _DEBUG_MODE_SMARTY = 'Smarty';
const _DEBUG_MODE_DESC = 'Disable debug mode in production. Admin > Settings > Debug mode [Off].';
