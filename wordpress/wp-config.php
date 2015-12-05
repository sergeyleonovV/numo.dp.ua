<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'WordPress');

/** Имя пользователя MySQL */
define('DB_USER', 'admin');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'admin');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'BRCq2U~<(#c0o.Hk6#6_9nW5>v+9yd7]QdE`|-)*AiF,b{Cs?>b*Z7r1|yg>2hqh');
define('SECURE_AUTH_KEY',  'oVPtnsppv [ikx(|?Z]w Nf1T;M/h[`H6-z~btd(.|OFvlY{ jCv!;3t&HFg9y)+');
define('LOGGED_IN_KEY',    'w6(tJQS{8YX:)[fxNTO-V7)$-t_|l{;Tspf3QB <F`^d{iAj8.=Z!^.hi)sF;HT[');
define('NONCE_KEY',        'Q{8&wRSlcf4|PUe6OkedT1ULP*1+i*{/a%#~xN!=~]r3Hm9eG#0d]!*N^w1)s~)=');
define('AUTH_SALT',        's&V~{KY_^6v9l1-%&eCAWB6xM/HMo]LH]w^K$X]FEr^|NCp3p_2B>q+ -F)XS0O*');
define('SECURE_AUTH_SALT', 'gB,zcNCMOcwL2fNviq% keQzdlo[zNrqKfun/xr~:dD3I8Z1>oD+x{~Z+g>P[GBh');
define('LOGGED_IN_SALT',   'zmmn#)for9:#tITo1cw+& xg3B*U5p(a--<]jLZg>o!H<,I0mjZwQw|ABF}w+Q0@');
define('NONCE_SALT',       'UeY~cdB5J+jklr$3:t|cjku7E:mpN83$O`Q91?4}|,piJ69,bCQ4V|@<43j,~cIv');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
