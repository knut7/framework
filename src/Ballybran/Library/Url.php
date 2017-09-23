<?php

/**
 * knut7 Framework (http://framework.artphoweb.com/)
 * knut7 FW(tm) : Rapid Development Framework (http://framework.artphoweb.com/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link      http://github.com/zebedeu/artphoweb for the canonical source repository
 * Copyright (c) 2017.  knut7  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.0
 */

namespace Ballybran\Library;

class Url {

    private static $url;
    private static $ssl;
    private static $secure;
    private static $rewrite = array();

    public function __construct($ssl = false, $secure= false) {
        self::$ssl = $ssl;
        self::$secure = $secure;
    }

    public static function rewrite($rewrite) {
        self::$rewrite[] = $rewrite;
    }

    public static function link($route, $args = "", $secure = false) {
        if (self::$ssl && $secure) {
            $url = 'https://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/.\\') . '/' . $route;
        } else {
            $url = 'http://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/.\\') . '/' . $route;
        }

        if ($args) {
            if (is_array($args)) {
                $url .= '&amp;' . http_build_query($args);
            } else {
                $url .= str_replace('&', '&amp;', '&' . ltrim($args, '&'));
            }
        }
        foreach (self::$rewrite as $value) {
            $url = $value::rewrite($url);
        }


        return $url;
    }

    public static function setUrl() {
        if (self::$secure == true) {
            return self::$url = 'https://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/.\\') . DS;
        } else {
            return self::$url = 'http://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/.\\') . '/';
        }


        return self::$url;
    }

    public static function getUrl(){
        return self::$url;
    }

}
