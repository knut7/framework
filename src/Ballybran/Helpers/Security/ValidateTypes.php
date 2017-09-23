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


use function is_array;
use function var_dump;

class ValidateTypes
{

    public function __construct()
    {

    }

    public static function getSQLValueString( $theValue , $theType, $theDefinedValue = "", $theNotDefinedValue = "")
    {
        if (PHP_VERSION < 7.1) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

//        $theValue = function_exists("htmlspecialchars") ? htmlspecialchars($theValues) : htmlspecialchars($theValues);



        switch ($theType) {
            case "text":
                if(! is_string($theValue)) {
                    return null;
                }
                return "$theValue";
                break;
            case "email":
                if(! is_string($theValue)) {
                    return null;
                }
            return filter_var($theValue, FILTER_VALIDATE_EMAIL);
            break;
            case "long":
            case "int":
                if(! is_numeric($theValue) ) {
                   return null;
                }
           return intval($theValue);
            break;
            case "double":
                if(! is_double($theValue)) {
                    return null;
                }
                return doubleval($theValue);
                break;
            case "date":

                $theValue = ($theValue != "") ? "'" . $theValue . "'" : null;
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }



}