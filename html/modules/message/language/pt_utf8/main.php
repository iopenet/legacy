<?php
// Syntax replace define with const v2.3.0 2021/05/15 @gigamaster XCL-PHP7
// $Id$
// License http://creativecommons.org/licenses/by/2.5/br/
// ############################################################### //
// ## XOOPS Cube Legacy - Versão em Português
// ############################################################### //
// ## Por............: Mikhail Miguel
// ## Website........: http://xoops.net.br
// ## E-mail.........: mikhail.miguel@gmail.com
// ## Yahoo!.........: mikhailmiguel@yahoo.com
// ## MSN01..........: mikhailmiguel@msn.com
// ## MSN02..........: mikhailmiguel@hotmail.com
// ## AOL............: mikhailmiguel
// ## Skype..........: mikhailmiguel
// ## Orkut..........: 15440532260129226492
// ## Plus...........: http://card.ly/mikhail
// ############################################################### //
// *************************************************************** //
const _MD_MESSAGE_ACTIONMSG1 = "A mensagem não existe.";
const _MD_MESSAGE_ACTIONMSG2 = "Lamento, você ainda não tem as permissões necessárias.";
const _MD_MESSAGE_ACTIONMSG3 = "A mensagem foi corretamente removida.";
const _MD_MESSAGE_ACTIONMSG4 = "Falha na remoção.";
const _MD_MESSAGE_ACTIONMSG5 = "A mensagem não pôde ser enviada.";
const _MD_MESSAGE_ACTIONMSG6 = "Falha ao deixar uma cópia na caixa de saída.";
const _MD_MESSAGE_ACTIONMSG7 = "A mensagem foi enviada corretamente.";
const _MD_MESSAGE_ACTIONMSG8 = "Lamento, você ainda não tem as permissões necessárias.";
const _MD_MESSAGE_ACTIONMSG9 = "O remetente não existe.";
const _MD_MESSAGE_ADDBLACKLIST = "Este associado foi acrescentado à lista de ignorados.";
const _MD_MESSAGE_ADDFAVORITES = "Acrescentar aos favoritos";
const _MD_MESSAGE_DELETEMSG1 = "O parâmetro é considerado ilegal.";
const _MD_MESSAGE_DELETEMSG2 = "Não está selecionado.";
const _MD_MESSAGE_FAVORITES0 = "Nenhum associado foi selecionado para ser acrescentado.";
const _MD_MESSAGE_FAVORITES1 = "Houve uma falha ao acrescentar.";
const _MD_MESSAGE_FAVORITES2 = "Acrescentar";
const _MD_MESSAGE_FAVORITES3 = "Falha ao atualizar.";
const _MD_MESSAGE_FAVORITES4 = "Atualizar";
const _MD_MESSAGE_FAVORITES5 = "Remover";
const _MD_MESSAGE_FORMERROR1 = "O nome é um valor obrigatório.";
const _MD_MESSAGE_FORMERROR2 = "O nome de entrada, com um máximo de trinta caracteres.";
const _MD_MESSAGE_FORMERROR3 = "O título é um valor necessário.";
const _MD_MESSAGE_FORMERROR4 = "O título deve ter no máximo cem caracteres.";
const _MD_MESSAGE_FORMERROR5 = "É necessário escrever algo no corpo da mensagem.";
const _MD_MESSAGE_FORMERROR6 = "Ocorreu um erro: o associado selecionado aparentemente não existe.";
const _MD_MESSAGE_MAILBODY = "{0} - identique-se, por favor.";
const _MD_MESSAGE_MAILSUBJECT = "Você tem uma nova mensagem";
const _MD_MESSAGE_NEWMESSAGE = "Você tem {0} mensagens.";
const _MD_MESSAGE_SEARCH = "Pesquisar";
const _MD_MESSAGE_SETTINGS = "Configurações ";
const _MD_MESSAGE_SETTINGS_MSG1 = "Mensagens internas";
const _MD_MESSAGE_SETTINGS_MSG10 = "Lista de ignorados";
const _MD_MESSAGE_SETTINGS_MSG11 = "Separe cada número de cadastro dos destinatários com uma vírgula.";
const _MD_MESSAGE_SETTINGS_MSG12 = "{0} foi incluído à sua lista de ignorados.";
const _MD_MESSAGE_SETTINGS_MSG13 = "Falha ao incluir {0} à sua lista de ignorados.";
const _MD_MESSAGE_SETTINGS_MSG14 = "{0} já existe.";
const _MD_MESSAGE_SETTINGS_MSG15 = "Lista de ignorados";
const _MD_MESSAGE_SETTINGS_MSG16 = "O associado foi removido corretamente.";
const _MD_MESSAGE_SETTINGS_MSG17 = "Falha na remoção do associado.";
const _MD_MESSAGE_SETTINGS_MSG18 = "Detalhes";
const _MD_MESSAGE_SETTINGS_MSG19 = "O associado não existe.";
const _MD_MESSAGE_SETTINGS_MSG2 = "Enviar uma cópia por correio eletrônico";
const _MD_MESSAGE_SETTINGS_MSG3 = "Alterar configurações";
const _MD_MESSAGE_SETTINGS_MSG4 = "Falha ao atualizar.";
const _MD_MESSAGE_SETTINGS_MSG5 = "Você não pode utilizar o recurso de mensagens privadas. Por favor, verifique as suas configurações.";
const _MD_MESSAGE_SETTINGS_MSG6 = "O associado selecionado não pôde receber a sua mensagem.";
const _MD_MESSAGE_SETTINGS_MSG7 = "A mensagem é mostrada no email.";
const _MD_MESSAGE_SETTINGS_MSG8 = "Número de mensagens mostradas por página";
const _MD_MESSAGE_SETTINGS_MSG9 = "Utiliza a configuração padrão do módulo caso o valor for igual a zero.";
const _MD_MESSAGE_TEMPLATE1 = "Enviar mensagem";
const _MD_MESSAGE_TEMPLATE10 = "Data";
const _MD_MESSAGE_TEMPLATE11 = "Mensagem";
const _MD_MESSAGE_TEMPLATE12 = "Remetente";
const _MD_MESSAGE_TEMPLATE13 = "Responder";
const _MD_MESSAGE_TEMPLATE14 = "Remover";
const _MD_MESSAGE_TEMPLATE15 = "Caixa-de-entrada";
const _MD_MESSAGE_TEMPLATE16 = "Não lidas";
const _MD_MESSAGE_TEMPLATE17 = "Lidas";
const _MD_MESSAGE_TEMPLATE18 = "Ordem";
const _MD_MESSAGE_TEMPLATE19 = "Bloquear";
const _MD_MESSAGE_TEMPLATE2 = "Codinome";
const _MD_MESSAGE_TEMPLATE20 = "Desbloquear";
const _MD_MESSAGE_TEMPLATE21 = "Enviar e-mail";
const _MD_MESSAGE_TEMPLATE22 = "Situação";
const _MD_MESSAGE_TEMPLATE3 = "Assunto";
const _MD_MESSAGE_TEMPLATE4 = "Mensagem";
const _MD_MESSAGE_TEMPLATE5 = "Mostrar";
const _MD_MESSAGE_TEMPLATE6 = "Enviar";
const _MD_MESSAGE_TEMPLATE7 = "Mensagens enviadas";
const _MD_MESSAGE_TEMPLATE8 = "Nova mensagem";
const _MD_MESSAGE_TEMPLATE9 = "Destinatário";

if (!defined('LEGACY_MAIL_LANG')) {
    define('LEGACY_MAIL_LANG','pt');
    define('LEGACY_MAIL_CHAR','UTF-8');
    define('LEGACY_MAIL_ENCO','7bit'); // "8bit";
}
