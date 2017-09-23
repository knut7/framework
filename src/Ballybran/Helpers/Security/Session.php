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
 * Date: 2016/02/18
 * Time: 7:59 AM
 * Class session whtem init(), set, get, Destroy, unsetValue, exist
 */

namespace Ballybran\Helpers\Security;

use Ballybran\Helpers\Hook;

class Session {

    /**
     *  init Sessin our Session Start
     * É usado para ativar o incio de sassão do usuário.
     */
    public static function init() {
            @session_start();
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function set($key, $value) {
        return $_SESSION[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function get($key) {
        return $_SESSION[$key];
    }

    /**
     * funtion usado para destruir a sessao
     *  exxemplo de uso:: public function DestruirSessao(){ Session::Destroy() }
     */
    public static function Destroy() {
        session_destroy();
    }

    /**
     * @param $key
     */
    public static function unsetValue($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     *  Usa-se como condicao. Se o usuario existe ou se for maior que zero ( > 0 )
     * entao, isso significa que o usuario existe
     * mais se for menor q zero ( < 0 ) sigifica que o usuario nao existe.
     * exemplo de uso: Session::exist(){
     *  .. .. .. .. your code .. .. .. .
     * }
     * @return bool
     */
    public static function exist() {
        if (sizeof($_SESSION) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function handleLogin() {
        @session_start();
        Session::init();
        $logged = Session::get('U_NAME');
        $role = Session::get('role');
        if ($logged == false || $role != 'owner') {
            session_destroy();
            Hook::Header('login');
            exit;
        }
    }

}
