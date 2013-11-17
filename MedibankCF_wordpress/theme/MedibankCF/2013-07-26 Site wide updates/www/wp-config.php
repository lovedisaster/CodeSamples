<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

define('WP_HOME', 'http://localhost/medibankcf');
define('WP_SITEURL', 'http://localhost/medibankcf');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'medibankcf');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'password123$');

/** MySQL hostname */
define('DB_HOST', 'now-mysql');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** Indicates how many months later the blogs is going to be put archive **/
define('ARCHIVE_CAP','0');

/** Indicates max posts displayed for news and real story blogs **/
define('BLOG_CAP','6');

/** Indicates max posts displayed for related news under programs and events tab  **/
define('RELATED_NEWS_CAP','3');

/** Indicates max posts displayed for related news under programs and events tab  **/
define('ARCHIVE_INDICATOR_STOIRES','Blogs');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '%yMm&T}Jg8h&R[$srvKM(H?B75/IuC+=Hm2fA+GkTwwLya4Rjw@[l`:n}<I#SZ61');
define('SECURE_AUTH_KEY',  'aHZhps+e/X3zz,f*~#H3zb>[tN+KQ8#jHBI1:dUlWiz.VYqB*&,$lEy`}/;B&1&i');
define('LOGGED_IN_KEY',    'k98lH>HNbLFUt3BYn`q(qDtrx9;Eu(bB!!+8/aBf8-k x~uc:(yju9$>buMZnr@-');
define('NONCE_KEY',        ' %3QKgRj=V@_BVR^|ecmRcHhhBj0,6bv:Nnvqx=W-BGz~p531x]-Ti}84rTBs+T9');
define('AUTH_SALT',        '`g)&(P#{5pw5}ERUvX`B`{0&m22-s}IH#(lSE?wMq5!K*2X,PU&-)N.)XyX:rRcP');
define('SECURE_AUTH_SALT', 'vr(*KnNLf`Wr(O0@w6@lRR pD>Rk{Vt:;*HN}M`6w3v{UCK5!t D^,}4L0#5c1,&');
define('LOGGED_IN_SALT',   'P9n!OY<zWw6pgFEir<vj+$bp2c:48Ge$Wt-V#z|QZ6^FSaaBR;H{<KOlm$+CnTTq');
define('NONCE_SALT',       '>7QiA.Dn^,n&dIGNt6~y4Rzb&R`+ Ryy|aph+E5a>qRS=/Jr9En~5{n6d<jE2f<o');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
