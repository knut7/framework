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

namespace Ballybran\Helpers;

use function var_dump;

class System
{

    private const OS_UNKNOWN = "NÃO ENCONTRADO";
    private const OS_WIN = "WIN";
    private const OS_LINUX = "LINUX";
    private const OS_OSX = "MAC OSX";

    /**
     * @return int
     */
    static public function getOS(): string {
        switch (true) {
            case stristr(PHP_OS, 'DAR'): return self::OS_OSX;
            case stristr(PHP_OS, 'WIN'): return self::OS_WIN;
            case stristr(PHP_OS, 'LINUX'): return self::OS_LINUX;
            default : return self::OS_UNKNOWN;
        }
    }
    static function microtime_float()
    {
        $time = explode(" ", microtime());
        foreach ($time as $item => $value) {
            return ((float)$item + (float)$value);
        }
//
    }

    public static function time_start() : string
    {

        $time_start = self::microtime_float();

        // Sleep for a while
        usleep(100);

        $time_end = self::microtime_float();
        $time = $time_end - $time_start;

        return "Loaded in $time seconds\n";

    }

}