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
 * @copyright (c) 2016.  knut7  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.0
 */

namespace Ballybran\Helpers\Utility;

class Assets {

    protected static $templates = array(
        'js' => '<script src="%s" type="text/javascript"></script>',
        'css' => '<link href="%s" rel="stylesheet" type="text/css">'
    );

    protected static function resource($files, $template) {

        $template = self::$templates[$template];

        if (is_array($files)) {
            foreach ($files as $file) {
                echo sprintf($template, $file) . "\n";
            }
        } else {
            echo sprintf($template, $files) . "\n";
        }
    }

    public static function js(Array $files) {
        if (is_array($files)) {
            foreach ($files as $key => $value) {
                static::resource($value, 'js');
                break;
            }
        }
         static::resource($files, 'js');
    }

    public static function css(Array $files) {
        if (is_array($files)) {
            foreach ($files as $key => $value) {
               static::resource($value, 'css');
            }
        }
         static::resource($files, 'css');
    }

}
