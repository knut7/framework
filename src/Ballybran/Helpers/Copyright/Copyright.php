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

namespace Ballybran\Helpers\Copyright;
use Ballybran\Helpers\Copyright\interfaceCopyright;
class Copyright implements interfaceCopyright {

    private static $date;

    /**
     *
     */
    public static function copyright(int $data_last = 2015, string $name = "knut7 FRAMWORK") {

        self::$date = date('y');
        return "Copyright (c)\n" . $data_last . "\n-" . self::$date . "\n" . $name . "\n" . "All Rights Reserved";
    }

}
