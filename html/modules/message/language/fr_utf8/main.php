<?php
// Syntax replace define with const v2.3.0 2021/05/15 @gigamaster XCL-PHP7

const _MD_MESSAGE_NEWMESSAGE = 'Vous avez {0} messages.';
const _MD_MESSAGE_FORMERROR1 = 'Le Nom du destinataire est requis.';
const _MD_MESSAGE_FORMERROR2 = 'Ajouter un nom avec un maximum de 30 caractères. ';
const _MD_MESSAGE_FORMERROR3 = 'Le Sujet du message est requis.';
const _MD_MESSAGE_FORMERROR4 = 'Ajouter un sujet avec un maximum de 100 caractères.';
const _MD_MESSAGE_FORMERROR5 = 'Message est requis.';
const _MD_MESSAGE_FORMERROR6 = 'L\'utilisateur spécifié n\'existe pas.';

const _MD_MESSAGE_ACTIONMSG1 = 'Le message n\'existe pas.';
const _MD_MESSAGE_ACTIONMSG2 = 'Vous n\'avez pas les permissions requises.';
const _MD_MESSAGE_ACTIONMSG3 = 'Le Message a été supprimé.';
const _MD_MESSAGE_ACTIONMSG4 = 'Échec de la suppression!';
const _MD_MESSAGE_ACTIONMSG5 = 'Le message n\'a pas pu être envoyé.';
const _MD_MESSAGE_ACTIONMSG6 = 'Échec de l\'ajout aux messages envoyés.';
const _MD_MESSAGE_ACTIONMSG7 = 'Le Message a été envoyé.';
const _MD_MESSAGE_ACTIONMSG8 = 'Vous n\'avez pas les permissions requises. ';
const _MD_MESSAGE_ACTIONMSG9 = 'Le destinataire du message n\'existe pas.';

const _MD_MESSAGE_TEMPLATE1 = 'Envoyer le message';
const _MD_MESSAGE_TEMPLATE2 = 'Nom d\'Utilisateur';
const _MD_MESSAGE_TEMPLATE3 = 'Sujet';
const _MD_MESSAGE_TEMPLATE4 = 'Message';
const _MD_MESSAGE_TEMPLATE5 = 'Aperçu';
const _MD_MESSAGE_TEMPLATE6 = 'Envoyer';
const _MD_MESSAGE_TEMPLATE7 = 'Boite d\'envoi';
const _MD_MESSAGE_TEMPLATE8 = 'Nouveau message';
const _MD_MESSAGE_TEMPLATE9 = 'À';
const _MD_MESSAGE_TEMPLATE10 = 'Date';
const _MD_MESSAGE_TEMPLATE11 = 'Message';
const _MD_MESSAGE_TEMPLATE12 = 'De';
const _MD_MESSAGE_TEMPLATE13 = 'Répondre';
const _MD_MESSAGE_TEMPLATE14 = 'Supprimer';
const _MD_MESSAGE_TEMPLATE15 = 'Boite de réception';
const _MD_MESSAGE_TEMPLATE16 = 'Non lus';
const _MD_MESSAGE_TEMPLATE17 = 'Lu';
const _MD_MESSAGE_TEMPLATE18 = 'Ordre';
const _MD_MESSAGE_TEMPLATE19 = 'Verrouiller';
const _MD_MESSAGE_TEMPLATE20 = 'déverrouiller';
const _MD_MESSAGE_TEMPLATE21 = 'Envoyer un email';
const _MD_MESSAGE_TEMPLATE22 = 'Statut';
const _MD_MESSAGE_ADDFAVORITES = 'Ajouter aux favoris';
const _MD_MESSAGE_FAVORITES0 = 'Sélectionner un utilisateur à ajouter';
const _MD_MESSAGE_FAVORITES1 = 'Échec de l\'ajout !';
const _MD_MESSAGE_FAVORITES2 = 'Ajouter';
const _MD_MESSAGE_FAVORITES3 = 'Échec de la mise à jour !';
const _MD_MESSAGE_FAVORITES4 = 'Mettre à jour';
const _MD_MESSAGE_FAVORITES5 = 'Supprimer';

const _MD_MESSAGE_SETTINGS = 'Réglages des messages privés';
const _MD_MESSAGE_SETTINGS_MSG1 = 'Utiliser la messagerie privée';
const _MD_MESSAGE_SETTINGS_MSG2 = 'Faire suivre par email';
const _MD_MESSAGE_SETTINGS_MSG3 = 'changer les réglages';
const _MD_MESSAGE_SETTINGS_MSG4 = 'Échec de la mise à jour !';
const _MD_MESSAGE_SETTINGS_MSG5 = 'Impossible d\'utiliser les messages privés. Modifiez les paramètres.';
const _MD_MESSAGE_SETTINGS_MSG6 = 'L\'utilisateur sélectionné ne peut pas recevoir le message.';
const _MD_MESSAGE_SETTINGS_MSG7 = 'Le message est affiché dans le mail.';
const _MD_MESSAGE_SETTINGS_MSG8 = 'Nombre de messages affichés par page.';
const _MD_MESSAGE_SETTINGS_MSG9 = 'Utiliser les réglages par défaut du module si la valeur est 0.';
const _MD_MESSAGE_SETTINGS_MSG10 = 'Bloqués';
const _MD_MESSAGE_SETTINGS_MSG11 = 'Séparez les IDs des utilisateurs par des virgules.';
const _MD_MESSAGE_SETTINGS_MSG12 = '{0} a été ajouté aux contacts bloqués.';
const _MD_MESSAGE_SETTINGS_MSG13 = '{0} n\'a pu être ajouté aux contacts bloqués.';
const _MD_MESSAGE_SETTINGS_MSG14 = '{0} existe déjà.';
const _MD_MESSAGE_SETTINGS_MSG15 = 'Gérer les contacts bloqués';
const _MD_MESSAGE_SETTINGS_MSG16 = 'L\'utilisateur a été retiré.';
const _MD_MESSAGE_SETTINGS_MSG17 = 'Échec du retrait de l\'utilisateur.';
const _MD_MESSAGE_SETTINGS_MSG18 = 'Détails';
const _MD_MESSAGE_SETTINGS_MSG19 = 'L\'utilisateur n\'existe pas.';

const _MD_MESSAGE_MAILSUBJECT = 'Vous avez un nouveau message privé.';
const _MD_MESSAGE_MAILBODY = '{0} connectez-vous.';

const _MD_MESSAGE_ADDBLACKLIST = 'Cet utilisateur a été ajouté aux contacts bloqués.';

const _MD_MESSAGE_DELETEMSG1 = 'Le paramètre est invalide.';
const _MD_MESSAGE_DELETEMSG2 = 'Sélection manquante';

const _MD_MESSAGE_SEARCH = 'Rechercher';

if (!defined('LEGACY_MAIL_LANG')) {
define('LEGACY_MAIL_LANG','fr');
define('LEGACY_MAIL_CHAR','UTF-8');
define('LEGACY_MAIL_ENCO','7bit');
}
