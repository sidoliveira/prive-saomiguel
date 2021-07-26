<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa user o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações
// com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'bd_prive');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'prive16');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '16prive321');

/** Nome do host do MySQL */
define('DB_HOST', 'mysql427.umbler.com');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '?C1PAU;9J81#l:Yus6m,*0kTw,|HF$ilvXzJ]$pa06wOulqEHPSF&}BVP@|St.=i');
define('SECURE_AUTH_KEY',  '3qXZjcn}R!]_D056@2:b;F:aRS:aG-k&|+k.nVTZ{j{Y_[W3Jhv$2I}rCsHIf UI');
define('LOGGED_IN_KEY',    'Soy}=/fF3[)olnacVaSD>?-i1$X$mhzo+3&cC#HLZxjX%|`=Lc;06z?}p4(vGNS]');
define('NONCE_KEY',        '*?s,s9[#0)cLiB{;7B_r)IOVK3A5ek:tzX/E+~-;F,5YJ9xd^wR4oF.-!l/)6Hi]');
define('AUTH_SALT',        'GPX|}Qkk1BM##ehh5dAE7I.HP(eU-e<VL)@v&7C[v;OKd6!-}HFY|a<A9@J`F]wu');
define('SECURE_AUTH_SALT', 'W}@~I#L0LXE#QB ,QgYg>#`cd#ZZO]!prV&G}z2pX:9t]Ht#.U!aH=PFS 2=tG>O');
define('LOGGED_IN_SALT',   'Ct]/0~=iDb XJPfy|IbtpO0-kS6g9t-OAjZs341!i7dL|RN`GyAM.mu*SF?fg-5O');
define('NONCE_SALT',       'Whp$!GG_Mn&jrX94z.>KEjC2dZBV.T>qo5<62Jw]X`C[QiHgvj5.OpMdbf)o7o8|');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * para cada um um único prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
