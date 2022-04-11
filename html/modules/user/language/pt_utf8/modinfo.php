<?php
// // Syntax replace define with const v2.3.0 2021/05/15 @gigamaster XCL-PHP7
// ## XOOPS Cube Legacy - Versão em Português
// ## Por............: Mikhail Miguel
// ## E-mail.........: mikhail.miguel@gmail.com
// License http://creativecommons.org/licenses/by/2.5/br/

const _MI_USER_ADMENU_AVATAR_MANAGE = "Avatares";
const _MI_USER_ADMENU_GROUP_LIST = "Grupos e permissões";
const _MI_USER_ADMENU_LIST = "Listar associados";
const _MI_USER_ADMENU_MAIL = "Contatar associados";
const _MI_USER_ADMENU_MAILJOB_MANAGE = "Mala direta"; // só para não esquecer: 1) confirmar se utilizam esse termo em Portugal; 2) não tem hífen http://pt.wikipedia.org/wiki/Hífen
const _MI_USER_ADMENU_RANK_LIST = "Graduações";
const _MI_USER_ADMENU_USER_DATA_CSVUPLOAD = "Importar dados";
const _MI_USER_ADMENU_USER_DATA_DOWNLOAD = "Exportar dados";
const _MI_USER_ADMENU_USER_SEARCH = "Localizar associado"; // singular mesmo
const _MI_USER_BLOCK_LOGIN_DESC = "Mostra o formulário de entrada"; // não encontrei descrição melhor :-)
const _MI_USER_BLOCK_LOGIN_NAME = "Entrada"; // melhor que login, putz... que ódio que tenho do tal 'lojin'
const _MI_USER_BLOCK_NEWUSERS_DESC = "Mostra uma lista com os últimos visitantes cadastrados"; // tá, dá pra melhorar
const _MI_USER_BLOCK_NEWUSERS_NAME = "Novos associados"; // ficou estranho
const _MI_USER_BLOCK_ONLINE_DESC = "Mostra os visitantes anônimos e cadastrados presentes"; // ficou muito estranho
const _MI_USER_BLOCK_ONLINE_NAME = "Quem nos visita"; // achei que ficou legal. Ou pelo menos melhor do que as outras opções que apareceram...
const _MI_USER_BLOCK_TOPUSERS_DESC = "Lista os associados mais participativos, com mais postagens, comentários, etc."; // Pena que nem sempre é possível atualizar esse valor corretamente. Devo colocar isso aqui?
const _MI_USER_BLOCK_TOPUSERS_NAME = "Mais participativos";
const _MI_USER_CONF_ACTV_ADMIN = "Ativação manual pelos administradores";
const _MI_USER_CONF_ACTV_AUTO = "Ativação automática"; // Dica: experimentem utilizar esta opção em um serviço de hospedagem gratuita. Keyword para o Google: TAZ.
const _MI_USER_CONF_ACTV_GROUP = "Escolha um grupo para o qual o pedido de associação será enviado"; // talvez formal demais...
const _MI_USER_CONF_ACTV_GROUP_DESC = "Válido somente quando a ativação manual pelos administradores estiver habilitada.";
const _MI_USER_CONF_ACTV_TYPE = "Escolha o tipo de ativação dos cadastros";
const _MI_USER_CONF_ACTV_USER = "Requer ativação pelo visitante";
const _MI_USER_CONF_ALLOW_REGISTER = "Permitir que novos visitantes se cadastrem?";
const _MI_USER_CONF_ALW_RG_DESC = "Escolha NÃO para bloquear o cadastro de novos associados.";
const _MI_USER_CONF_AVATAR_HEIGHT = "Altura máxima dos avatares (em <em>pixels</em>)";
const _MI_USER_CONF_AVATAR_MAXSIZE = "Tamanho máximo dos avatares (em <em>bytes</em>)";
const _MI_USER_CONF_AVATAR_MINPOSTS = "Mínimo de contribuições necessárias";
const _MI_USER_CONF_AVATAR_WIDTH = "Largura máxima dos avatares (em <em>pixels</em>)";
const _MI_USER_CONF_AVT_MIN_DESC = "Escreva o número mínimo de contribuições necessário para que o associado possa enviar o seu próprio avatar.";
const _MI_USER_CONF_AVTR_ALLOW_UP = "Permitir o envio de avatares personalizados?";
const _MI_USER_CONF_BAD_EMAILS = "Escreva os tipos de <i>e-mail</i> que não poderão ser utilizados no cadastro dos visitantes";
const _MI_USER_CONF_BAD_EMAILS_DESC = "Separe cada um com uma barra vertical ( | ). Caixa-alta ou caixa-baixa, tanto faz. Sistema REGEX habilitado.";
const _MI_USER_CONF_BAD_UNAMES = "Escreva os tipos de <i>e-mail</i> que NÃO poderão ser utilizados no cadastro dos visitantes";
const _MI_USER_CONF_BAD_UNAMES_DESC = "Separe cada um com uma barra vertical ( | ). Caixa-alta ou caixa-baixa, tanto faz. Sistema REGEX habilitado.";
const _MI_USER_CONF_CHGMAIL = "Permitir que os utilizadores alterem os seus próprios endereços de e-mail?";
const _MI_USER_CONF_DISCLAIMER = "CADASTRO - REGRAS DO PORTAL";
const _MI_USER_CONF_DISCLAIMER_DESC = "Escreva os tipos de <i>e-mail</i> que não poderão ser utilizados no cadastro dos visitantes.";
const _MI_USER_CONF_DISCLAIMER_DESC_DEFAULT = "Apesar dos administradores e moderadores deste portal tentarem editar ou remover todo o conteúdo questionável o mais depressa possível, é impossível rever todas as mensagens antes de serem publicadas. Desta forma, todas as mensagens publicadas neste portal são de exclusiva responsabilidade de seus respectivos autores, não sendo os administradores e moderadores responsáveis pelo seu conteúdo. Você compromete-se a não publicar conteúdo abusivo, obsceno, vulgar, difamatório, ameaçador, sexual, ódio ou qualquer conteúdo que viole as leis vigentes. Se o fizer, corre o risco de ser permanentenmente banido do <i>site</i> (com uma notificação feita ao seu fornecedor de acesso à internet). O número IP de todas as mensagens publicadas é guardado para ajudar a implementar estas normas. Criar vários perfis é proibido. Você concorda que o administrador ou moderador tem o direito de remover, editar, mover ou fechar qualquer tópico que ele ache próprio. Como associado, concorda que qualquer informação introduzida no <i>site</i> será guardada em um banco de dados. Apesar dessa informação não ser distribuída a terceiros sem o seu consentimento, os administradores não podem ser responsabilizados por qualquer ataque informático que comprometa esses dados. Este portal utiliza a tecnologia de Cookies para guardar informações em seu computador, os cookies não contêm nenhuma informação introduzida por si, são usados apenas para melhorar a qualidade de sua estadia no site. O seu endereço de <i>e-mail</i> é apenas usado para confirmar a sua senha (e no caso de se esquecer dela). Ao se cadastrar, você estará concordando com este termo de responsabilidade.";
const _MI_USER_CONF_DISPDSCLMR = "Mostrar termos de responsabilidade?";
const _MI_USER_CONF_DISPDSCLMR_DESC = "Escolha SIM para mostrar as regras do portal no momento do cadastro";
const _MI_USER_CONF_MAXUNAME = "Comprimento máximo dos codinomes";
const _MI_USER_CONF_MINPASS = "Comprimento mínimo necessário das senhas";
const _MI_USER_CONF_MINUNAME = "Comprimento mínimo necessário dos codinomes";
const _MI_USER_CONF_NEW_NTF_GROUP = "Escolha um grupo ao qual uma notificação sobre os novos cadastros será enviada.";
const _MI_USER_CONF_NEW_USER_NOTIFY = "Notificar por carta-eletrônica quando um novo visitante se cadastrar?";
const _MI_USER_CONF_SELF_DELETE = "Permitir que os associados removam os seus próprios perfis?";
const _MI_USER_CONF_SELF_DELETE_CONF = "Mensagem de confirmação";
const _MI_USER_CONF_SELF_DELETE_CONFIRM_DEFAULT = "Tem certeza de que deseja remover o seu cadastro? Isto irá remover todas as suas informações de nosso banco de dados.";
const _MI_USER_CONF_SSLLOGINLINK = "Endereço URL para a conexão SSL";
const _MI_USER_CONF_SSLPOST_NAME = "Nome da variável do SSL";
const _MI_USER_CONF_UNAME_TEST_LEVEL = "Escolha o quão rigorosa será a filtragem dos codinomes escolhidos";
const _MI_USER_CONF_UNAME_TEST_LEVEL_NORMAL = "Médio (permite alguns caracteres especiais)";
const _MI_USER_CONF_UNAME_TEST_LEVEL_STRONG = "Restritivo (apenas letras e números)";
const _MI_USER_CONF_UNAME_TEST_LEVEL_WEAK = "Permissivo (permite caracteres de 2 bytes)";
const _MI_USER_CONF_USE_SSL = "Utilizar conexão segura via SSL na entrada?";
const _MI_USER_CONF_USERCOOKIE = "Nome para os <em>cookies</em> dos associados.";
const _MI_USER_CONF_USERCOOKIE_DESC = "Este <em>cookie</em> apenas contém o codinome e é guardado no computador do associado por um ano (se o utilizador desejar). Com isto, o codinome será inserido automaticamente no formulário de entrada.";
const _MI_USER_KEYWORD_AVATAR_MANAGE = "avatar personalizado sistema lista editar alterar remover";
const _MI_USER_KEYWORD_CREATE_AVATAR = "Enviar avatar";
const _MI_USER_KEYWORD_CREATE_GROUP = "Adicionar grupo";
const _MI_USER_KEYWORD_CREATE_RANK = "Adicionar graduação";
const _MI_USER_KEYWORD_CREATE_USER = "Adicionar utilisador";
const _MI_USER_KEYWORD_GROUP_LIST = "listar adicionar criar editar modificar remover utilizador membro conta ranque permissão acrescentar remover associado";
const _MI_USER_KEYWORD_MAILJOB_LINK_LIST = "Mailjob lista de links";
const _MI_USER_KEYWORD_MAILJOB_MANAGE = "Gestor de mala-direta";
const _MI_USER_KEYWORD_USER_LIST = "Listar associados";
const _MI_USER_KEYWORD_USER_SEARCH = "Localizar associado";
const _MI_USER_LANG_MAILJOB_LINK_LIST = "Lista de links Mailjob ";
const _MI_USER_MENU_CREATE_AVATAR = "Acrescentar avatar";
const _MI_USER_MENU_CREATE_GROUP = "Novo grupo";
const _MI_USER_MENU_CREATE_RANK = "Nova graduação";
const _MI_USER_MENU_CREATE_USER = "Novo utilisaor";
const _MI_USER_NAME = "Utilisadores";
const _MI_USER_NAME_DESC = "Módulo de gerenciamento de utilisadores.";
