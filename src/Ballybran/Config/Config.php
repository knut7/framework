<?php

/**
 *
 * knut7 Framework (http://framework.artphoweb.com/)
 * knut7 FW(tm) : Rapid Development Framework (http://framework.artphoweb.com/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link      http://github.com/zebedeu/artphoweb for the canonical source repository
 * @copyright (c) 2016.  knut7  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.0
 */

/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 2016/02/14
 * Time: 11:02 AM
 */
/**
 *
 * The sitewide hashkey, do not change this because its used for passwords!
 * This is for other hash keys... Not sure yet
 *
 */
namespace Ballybran\Config;
require './Config/Config.module.php';

define('AUTH_KEY', ' Xakm<o xQy rw4EMsLKM-?!T+,PFF})H4lzcW57AF0U@N@< >M%G4Yt>f`z]MON');
define('SECURE_AUTH_KEY', 'LzJ}op]mr|6+![P}Ak:uNdJCJZd>(Hx.-Mh#Tz)pCIU#uGEnfFz|f ;;eU%/U^O~');
define('LOGGED_IN_KEY', '|i|Ux`9<p-h$aFf(qnT:sDO:D1P^wZ$$/Ra@miTJi9G;ddp_<q}6H1)o|a +&JCM');
define('NONCE_KEY', '%:R{[P|,s.KuMltH5}cI;/k<Gx~j!f0I)m_sIyu+&NJZ)-iO>z7X>QYR0Z_XnZ@|');
define('AUTH_SALT', 'eZyT)-Naw]F8CwA*VaW#q*|.)g@o}||wf~@C-YSt}(dh_r6EbI#A,y|nU2{B#JBW');
define('SECURE_AUTH_SALT', '!=oLUTXh,QW=H `}`L|9/^4-3 STz},T(w}W<I`.JjPi)<Bmf1v,HpGe}T1:Xt7n');
define('LOGGED_IN_SALT', '+XSqHc;@Q*K_b|Z?NC[3H!!EONbh.n<+=uKR:>*c(u`g~EJBf#8u#R{mUEZrozmm');
define('NONCE_SALT', 'h`GXHhD>SLWVfg1(1(N{;.V!MoE(SfbA_ksP@&`+AycHcAV$+?@3q+rxV{%^VyKT');

/**
 * prefix to cache
 */
define("Ballybran_CACHE", "cache_");
/**
 *
 * This is for database passwords only
 *
 */
define('HASH_KEY', '?j)o@LHX~E!SqxRwzm%Jy^Dyo<cEjL<j1:}!cpuleU9~}f8/M@n L[4XwMkaRog=');

/**
 *
 *
 */
define('ALGO', 'md5');



// DIR
define('DS', DIRECTORY_SEPARATOR);
/**
 *
 * Faça alteração aqui caso seja necessrio e saiba o que esta a fazer.
 *
 */
// require_once PV . 'Config/config_module.php';

define('PV', 'Module' . DS);

/**
 * APP é a costante responsavel pela criacao da tua applicação.
 * Por padradao o nome da tua applicacao é Applications.
 * Você pode renomear o nome da tua applicacao aqui alterando o seu nome.
 * OBS Se alterar o nome da Applicaçao aqui, terá que criar uma pasta com o novo nome.
 */

   global $MY_PROJECT_NAME;
if (!empty($MY_PROJECT_NAME)) {
    define('APP', $MY_PROJECT_NAME);
} else {
    define('APP', 'Applications');
}
global $HEADER_TITLE;
	if (!empty($HEADER_TITLE)) {
    define('HEADER_TITLE', $HEADER_TITLE);
} else {
    define('HEADER_TITLE', 'knut7');
}
global $HEADER_DESCRIPTION;
	if (!empty($HEADER_DESCRIPTION)) {
    define('HEADER_DESCRIPTION', $HEADER_DESCRIPTION);
} else {
    define('HEADER_DESCRIPTION', 'knut7');
}

global $code;

if (!empty($code)) {
    define('LANGUAGE_CODE', $code);
} else {
    define('LANGUAGE_CODE', 'en');
}


/**
 *
 *  O URL base do sistema
 */
define('URL', 'http://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/.\\') . DS);

// define('URL', dirname( '__DIR__' ) . '/');
define('HTTPS', 'https://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF'])) . DIRECTORY_SEPARATOR);


/**
 *
 *
 */
//define('DIR_Ballybran', URL . PV . APP . DS);


/**
 *   Module/YourProject/
 */
define('DIR_FILE', PV . APP . DS);

// define('DIR_FILES', PV . APP . '/class/');

define('DIR_LANGUAGE', 'Ballybran/Core/Language/language/');

define('DIR_LOGS', 'Ballybran/storage/');



/**
 *
 * Faça alteração aqui caso seja necessrio e saiba o que esta a fazer.
 * Esta constante é a constante resposnavel pela nossa View ( Arquivo de visualização).
 *
 */
define('VIEW', PV . APP . DS . 'View' . DS);


class Config {

    public static $project = "apweb";
}