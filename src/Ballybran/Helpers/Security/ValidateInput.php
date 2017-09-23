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

namespace Ballybran\Helpers\Security;


class ValidateInput
{


    /**
     * @param array $expected
     *   set up array of expected values and types
     * $expected = array( 'carModel'=>'string', 'year'=>'int','imageLocation'=>'filename' );
     */
    public static function getSQLValueSInputString(array $expected)
    {
        // check each input value for type and length

        foreach ($expected as $key => $type) {
            if (!empty($key)) {
                if (empty($_GET[$key])) {
                    ${$key} = NULL;
                    continue;
                }
            }
            switch ($type) {
                case 'string' :
                    if (is_string($_GET[$key]) && strlen($_GET[$key]) < 256) {
                      echo "ola mundo";
                    }
                    break;
                case 'int' :
                    if (is_int($_GET[$key])) {
                        ${$key} = $_GET[$key];
                    }
                    break;
                case "double":
                    if (is_double($_GET[$key])) {
                        ${$key} = $_GET[$key];
                        break;
                    }

                case "long":
                    if (is_long($_GET[$key])) {
                        ${$key} = $_GET[$key];
                        break;
                    }
                case 'filename' :
                    // limit filenames to 64 characters
                    if (is_string($_GET[$key]) && strlen($_GET[$key]) < 64) {
                        // escape any non-ASCII
                        ${$key} = str_replace('%', '_', rawurlencode($_GET[$key]));
                        // disallow double dots
                        if (strpos(${$key}, '..') === TRUE) {
                            ${$key} = NULL;
                        }
                    }
                    break;
            }
            if (!isset(${$key})) {
                ${$key} = NULL;
            }
        }

    }

    public function setSQLValueSInputString(array $expected)
    {
        $this->expected = $expected;

    }

}